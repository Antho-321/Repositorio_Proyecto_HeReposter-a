/**
 * Prueba del espaciado entre letras del titular (.titulo-navbar) con Playwright.
 *
 * Comprueba que la variable --titulo-navbar-tracking-aumento se comporta como
 * un porcentaje de separacion EXTRA:
 *   - con 0  el titular queda exactamente como antes de existir la variable,
 *     es decir con `letter-spacing: 0` (mismo ancho de texto, al pixel);
 *   - con 20 (el valor por defecto) la separacion es .2em, o sea el 20% del
 *     tamaño de letra de cada elemento.
 *
 * Guarda ademas una captura del titular con 20% y con 0% en tests/screenshots.
 *
 * Uso: node tests/tracking-titulo.spec.js
 */

const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const URL_OBJETIVO = 'https://pankey.live/';
const DIR_CAPTURAS = path.join(__dirname, 'screenshots');
const RUTA_20 = path.join(DIR_CAPTURAS, 'titular-tracking-20.png');
const RUTA_0 = path.join(DIR_CAPTURAS, 'titular-tracking-0.png');
const TIEMPO_MAXIMO = 60000;

// Los dos textos que usan el estilo: "Productos destacados" (el span) y
// "Selecciona una imagen" (el parrafo).
const SELECTOR_TITULO = '.titulo-navbar';
const SELECTORES_TEXTO = ['.titulo-navbar span', '#txt_sel_img'];

// Tolerancia al comparar anchos de texto: el layout devuelve subpixeles.
const TOLERANCIA_PX = 0.05;

// En este servidor (Oracle Linux 9, aarch64) usamos el Chromium del sistema:
// los binarios que descarga Playwright se compilan contra una glibc más nueva.
const CHROMIUM_DEL_SISTEMA = '/usr/bin/chromium-browser';

const fallos = [];

function comprobar(condicion, mensaje) {
    console.log(`${condicion ? 'OK  ' : 'FALLO'} ${mensaje}`);
    if (!condicion) {
        fallos.push(mensaje);
    }
}

/** Lee tamaño de letra, letter-spacing y ancho del texto de cada selector. */
function medir(pagina, selectores) {
    return pagina.evaluate((lista) => {
        return lista.map((selector) => {
            const elemento = document.querySelector(selector);
            if (!elemento) {
                return { selector, existe: false };
            }
            const estilo = getComputedStyle(elemento);
            // El rango cubre solo el texto, no la caja del bloque: asi el ancho
            // refleja el espaciado entre letras y no el ancho del contenedor.
            const rango = document.createRange();
            rango.selectNodeContents(elemento);

            return {
                selector,
                existe: true,
                fontSize: parseFloat(estilo.fontSize),
                // `letter-spacing: 0` y `calc(0 * 1em / 100)` computan "0px";
                // "normal" solo aparece si no hay ninguna regla aplicada.
                letterSpacing: estilo.letterSpacing,
                anchoTexto: rango.getBoundingClientRect().width,
            };
        });
    }, selectores);
}

/** Fija el porcentaje de aumento en :root, como si se editara el CSS. */
function fijarAumento(pagina, porcentaje) {
    return pagina.evaluate((valor) => {
        document.documentElement.style.setProperty(
            '--titulo-navbar-tracking-aumento',
            String(valor)
        );
    }, porcentaje);
}

async function main() {
    fs.mkdirSync(DIR_CAPTURAS, { recursive: true });

    const opciones = { args: ['--no-sandbox', '--disable-dev-shm-usage'] };

    if (fs.existsSync(CHROMIUM_DEL_SISTEMA)) {
        opciones.executablePath = CHROMIUM_DEL_SISTEMA;
    }

    const navegador = await chromium.launch(opciones);
    const contexto = await navegador.newContext({
        viewport: { width: 1440, height: 900 },
    });
    const pagina = await contexto.newPage();

    try {
        const respuesta = await pagina.goto(URL_OBJETIVO, {
            waitUntil: 'load',
            timeout: TIEMPO_MAXIMO,
        });

        await pagina.waitForLoadState('networkidle', { timeout: TIEMPO_MAXIMO });

        if (!respuesta || !respuesta.ok()) {
            throw new Error(
                `La página respondió con estado ${respuesta ? respuesta.status() : 'desconocido'}`
            );
        }

        const titulo = pagina.locator(SELECTOR_TITULO).first();
        await titulo.waitFor({ state: 'visible', timeout: TIEMPO_MAXIMO });
        await titulo.scrollIntoViewIfNeeded();

        // 1) Valor por defecto: 20% => .2em en cada elemento.
        const conDefecto = await medir(pagina, SELECTORES_TEXTO);
        await titulo.screenshot({ path: RUTA_20 });

        for (const medida of conDefecto) {
            comprobar(medida.existe, `${medida.selector} existe en la página`);
            if (!medida.existe) continue;

            const esperado = medida.fontSize * 0.2;
            const real = parseFloat(medida.letterSpacing);
            comprobar(
                Math.abs(real - esperado) < TOLERANCIA_PX,
                `${medida.selector} con 20%: letter-spacing ${medida.letterSpacing} ` +
                    `≈ .2em (${esperado.toFixed(2)}px sobre ${medida.fontSize}px)`
            );
        }

        // 2) Estado inicial de referencia: `letter-spacing: 0`, que es lo que
        //    tenía la regla antes de introducirse la variable.
        await pagina.addStyleTag({
            content: `.titulo-navbar, .titulo-navbar span, .titulo-navbar p {
                letter-spacing: 0 !important;
            }`,
        });
        const referenciaInicial = await medir(pagina, SELECTORES_TEXTO);

        // Quitamos el estilo de referencia y dejamos que mande la variable.
        await pagina.evaluate(() => {
            const ultima = document.head.querySelectorAll('style');
            ultima[ultima.length - 1].remove();
        });

        // 3) La variable a 0 tiene que reproducir ese estado inicial.
        await fijarAumento(pagina, 0);
        const conCero = await medir(pagina, SELECTORES_TEXTO);
        await titulo.screenshot({ path: RUTA_0 });

        conCero.forEach((medida, i) => {
            if (!medida.existe) return;
            const inicial = referenciaInicial[i];

            comprobar(
                medida.letterSpacing === inicial.letterSpacing,
                `${medida.selector} con 0%: letter-spacing ${medida.letterSpacing} ` +
                    `= el inicial ${inicial.letterSpacing}`
            );
            comprobar(
                Math.abs(medida.anchoTexto - inicial.anchoTexto) < TOLERANCIA_PX,
                `${medida.selector} con 0%: ancho del texto ` +
                    `${medida.anchoTexto.toFixed(2)}px = el inicial ` +
                    `${inicial.anchoTexto.toFixed(2)}px`
            );
        });

        // 4) Y 20% tiene que ser visiblemente más ancho que 0%: si no, la
        //    variable no estaría llegando a la regla.
        conDefecto.forEach((medida, i) => {
            if (!medida.existe) return;
            comprobar(
                medida.anchoTexto > conCero[i].anchoTexto,
                `${medida.selector}: 20% (${medida.anchoTexto.toFixed(2)}px) ` +
                    `es más ancho que 0% (${conCero[i].anchoTexto.toFixed(2)}px)`
            );
        });

        console.log(`Captura 20% : ${RUTA_20}`);
        console.log(`Captura 0%  : ${RUTA_0}`);
    } finally {
        await contexto.close();
        await navegador.close();
    }

    if (fallos.length > 0) {
        throw new Error(`${fallos.length} comprobación(es) fallaron`);
    }
}

main().catch((error) => {
    console.error(`La prueba falló: ${error.message}`);
    process.exitCode = 1;
});
