/**
 * Prueba de la tipografía del párrafo de "Sobre nosotros" con Playwright.
 *
 * Comprueba que el párrafo de la historia usa la MISMA familia que las
 * entradas del menú de navegación (Sanseriffic). Antes ese párrafo era la
 * única excepción de la página: el atajo `font` de la regla `p` en
 * estilo_Modificación_SobreNosotros.css lo dejaba en Century Gothic.
 *
 * No basta con leer `font-family` computado: eso devuelve la lista que pide el
 * CSS, no la que el navegador acaba pintando. Si el .woff no cargara, el texto
 * caería a Arial y el estilo computado seguiría diciendo "Sanseriffic". Por eso
 * la comprobación de fondo pregunta al motor qué fuente usó de verdad para cada
 * glifo (CDP: CSS.getPlatformFontsForNode).
 *
 * Guarda dos capturas en tests/e2e/screenshots: el párrafo de cerca y la
 * página completa.
 *
 * Uso: node tests/e2e/sobre-nosotros-parrafo.spec.js
 */

const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const URL_OBJETIVO = 'https://pankey.live/cliente.sobre_nosotros';
const DIR_CAPTURAS = path.join(__dirname, 'screenshots');
const RUTA_PARRAFO = path.join(DIR_CAPTURAS, 'sobre-nosotros-parrafo.png');
const RUTA_PAGINA = path.join(DIR_CAPTURAS, 'sobre-nosotros-completa.png');
const TIEMPO_MAXIMO = 60000;

const SELECTOR_PARRAFO = '#texto p';
// La referencia: una entrada del menú. Su familia la fija `.rd-nav-link` en
// style.css, que es la hoja compartida por todas las vistas.
const SELECTOR_NAVBAR = '.rd-navbar-static .rd-nav-link';

// Tamaño propio del texto corrido: la unificación era de familia, no de cuerpo,
// así que el párrafo no debe heredar los 19px del menú.
const TAMANO_ESPERADO_PX = 17;

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

/** Primera familia de la lista, sin comillas ni mayúsculas: la que se usa. */
function familiaPrincipal(fontFamily) {
    return fontFamily
        .split(',')[0]
        .trim()
        .replace(/^["']|["']$/g, '')
        .toLowerCase();
}

/** Lee familia, tamaño y texto de un selector. */
function medir(pagina, selector) {
    return pagina.evaluate((sel) => {
        const elemento = document.querySelector(sel);
        if (!elemento) {
            return { existe: false };
        }
        const estilo = getComputedStyle(elemento);

        return {
            existe: true,
            fontFamily: estilo.fontFamily,
            fontSize: parseFloat(estilo.fontSize),
            texto: elemento.textContent.trim(),
        };
    }, selector);
}

/**
 * Fuentes con las que el motor pintó realmente los glifos del elemento.
 * Devuelve [] si el protocolo no responde, para no dar por buena una prueba
 * que en realidad no se ha hecho.
 */
async function fuentesReales(contexto, pagina, selector) {
    const cdp = await contexto.newCDPSession(pagina);
    try {
        await cdp.send('DOM.enable');
        await cdp.send('CSS.enable');
        const { root } = await cdp.send('DOM.getDocument');
        const { nodeId } = await cdp.send('DOM.querySelector', {
            nodeId: root.nodeId,
            selector,
        });
        if (!nodeId) {
            return [];
        }
        const { fonts } = await cdp.send('CSS.getPlatformFontsForNode', { nodeId });
        return fonts || [];
    } finally {
        await cdp.detach();
    }
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

        // Las fuentes se descargan aparte del HTML: sin esperarlas, la primera
        // medida podría cogerse mientras el texto aún está en la de reserva.
        await pagina.evaluate(() => document.fonts.ready);

        const parrafo = pagina.locator(SELECTOR_PARRAFO).first();
        await parrafo.waitFor({ state: 'visible', timeout: TIEMPO_MAXIMO });
        await parrafo.scrollIntoViewIfNeeded();

        const medidaParrafo = await medir(pagina, SELECTOR_PARRAFO);
        const medidaNavbar = await medir(pagina, SELECTOR_NAVBAR);

        comprobar(medidaParrafo.existe, `${SELECTOR_PARRAFO} existe en la página`);
        comprobar(medidaNavbar.existe, `${SELECTOR_NAVBAR} existe en la página`);

        if (medidaParrafo.existe && medidaNavbar.existe) {
            comprobar(
                medidaParrafo.texto.length > 100,
                `el párrafo tiene texto (${medidaParrafo.texto.length} caracteres)`
            );

            const familiaParrafo = familiaPrincipal(medidaParrafo.fontFamily);
            const familiaNavbar = familiaPrincipal(medidaNavbar.fontFamily);

            comprobar(
                familiaParrafo === familiaNavbar,
                `misma familia que el menú: párrafo "${familiaParrafo}" = ` +
                    `menú "${familiaNavbar}"`
            );

            // La regresión concreta que se corrigió.
            comprobar(
                !medidaParrafo.fontFamily.toLowerCase().includes('century gothic'),
                'el párrafo ya no pide Century Gothic'
            );

            comprobar(
                medidaParrafo.fontSize === TAMANO_ESPERADO_PX,
                `el párrafo conserva su cuerpo de ${TAMANO_ESPERADO_PX}px ` +
                    `(${medidaParrafo.fontSize}px), no el ${medidaNavbar.fontSize}px del menú`
            );

            // Lo que se ve, no lo que se pide: si el .woff fallara, aquí
            // saldría la fuente de reserva del sistema.
            const fuentes = await fuentesReales(contexto, pagina, SELECTOR_PARRAFO);
            const resumen = fuentes
                .map((f) => `${f.familyName} (${f.glyphCount} glifos)`)
                .join(', ');

            comprobar(
                fuentes.length > 0,
                `el motor informa de la fuente usada: ${resumen || 'sin datos'}`
            );
            comprobar(
                fuentes.some(
                    (f) => familiaPrincipal(f.familyName) === familiaNavbar && f.glyphCount > 0
                ),
                `el texto se pinta de verdad con "${familiaNavbar}": ${resumen}`
            );

            console.log(`Familia párrafo : ${medidaParrafo.fontFamily}`);
            console.log(`Familia menú    : ${medidaNavbar.fontFamily}`);
            console.log(`Fuentes pintadas: ${resumen || 'sin datos'}`);
        }

        await parrafo.screenshot({ path: RUTA_PARRAFO });
        await pagina.screenshot({ path: RUTA_PAGINA, fullPage: true });

        console.log(`Captura párrafo : ${RUTA_PARRAFO}`);
        console.log(`Captura página  : ${RUTA_PAGINA}`);
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
