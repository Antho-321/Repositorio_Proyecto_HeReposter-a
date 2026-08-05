/**
 * Prueba visual del menú móvil con Playwright.
 *
 * Abre https://pankey.live/ con un viewport de teléfono, espera a que la
 * página termine de cargarse por completo (evento `load` + red inactiva),
 * pulsa el botón hamburguesa de la esquina superior izquierda y guarda una
 * captura antes y después de abrirlo en tests/e2e/screenshots.
 *
 * Uso: node tests/e2e/menu-movil.spec.js
 */

const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const URL_OBJETIVO = 'https://pankey.live/';
const DIR_CAPTURAS = path.join(__dirname, 'screenshots');
const RUTA_CERRADO = path.join(DIR_CAPTURAS, 'menu-movil-cerrado.png');
const RUTA_ABIERTO = path.join(DIR_CAPTURAS, 'menu-movil-abierto.png');
const TIEMPO_MAXIMO = 60000;

// El botón hamburguesa de RD Navbar: al pulsarlo se añade la clase `active`
// tanto al botón como al panel indicado en `data-rd-navbar-toggle`.
const SELECTOR_HAMBURGUESA = 'button.rd-navbar-toggle:visible';
const SELECTOR_PANEL = '.rd-navbar-nav-wrap';

// En este servidor (Oracle Linux 9, aarch64) usamos el Chromium del sistema:
// los binarios que descarga Playwright se compilan contra una glibc más nueva.
const CHROMIUM_DEL_SISTEMA = '/usr/bin/chromium-browser';

async function main() {
    fs.mkdirSync(DIR_CAPTURAS, { recursive: true });

    const opciones = { args: ['--no-sandbox', '--disable-dev-shm-usage'] };

    if (fs.existsSync(CHROMIUM_DEL_SISTEMA)) {
        opciones.executablePath = CHROMIUM_DEL_SISTEMA;
    }

    const navegador = await chromium.launch(opciones);
    // Viewport tipo iPhone 12/13: fuerza el layout `rd-navbar-fixed` (móvil).
    const contexto = await navegador.newContext({
        viewport: { width: 390, height: 844 },
        deviceScaleFactor: 3,
        isMobile: true,
        hasTouch: true,
    });
    const pagina = await contexto.newPage();

    try {
        const respuesta = await pagina.goto(URL_OBJETIVO, {
            waitUntil: 'load',
            timeout: TIEMPO_MAXIMO,
        });

        // Además del evento `load`, esperamos a que no queden peticiones en
        // curso para que la captura incluya lo que carga el JavaScript.
        await pagina.waitForLoadState('networkidle', { timeout: TIEMPO_MAXIMO });

        if (!respuesta || !respuesta.ok()) {
            throw new Error(
                `La página respondió con estado ${respuesta ? respuesta.status() : 'desconocido'}`
            );
        }

        // El botón se duplica (original + clon del navbar fijo); nos quedamos
        // con el que realmente se ve en pantalla.
        const hamburguesa = pagina.locator(SELECTOR_HAMBURGUESA).first();
        await hamburguesa.waitFor({ state: 'visible', timeout: TIEMPO_MAXIMO });

        const caja = await hamburguesa.boundingBox();

        if (!caja) {
            throw new Error('El botón hamburguesa no tiene área visible');
        }

        // Estado inicial: el menú debe estar cerrado.
        await pagina.screenshot({ path: RUTA_CERRADO });

        await hamburguesa.click();

        // La clase `active` marca el menú abierto; después esperamos a que
        // termine la animación de despliegue antes de capturar.
        const panel = pagina.locator(`${SELECTOR_PANEL}.active`).first();
        await panel.waitFor({ state: 'visible', timeout: TIEMPO_MAXIMO });
        await pagina.waitForTimeout(800);

        const enlaces = await pagina
            .locator('.rd-navbar-nav-wrap.active .rd-navbar-nav > li > a')
            .allInnerTexts();

        if (enlaces.length === 0) {
            throw new Error('El menú se abrió sin enlaces visibles');
        }

        await pagina.screenshot({ path: RUTA_ABIERTO });

        console.log(`URL final     : ${pagina.url()}`);
        console.log(`Estado        : ${respuesta.status()}`);
        console.log(
            `Hamburguesa   : x=${Math.round(caja.x)} y=${Math.round(caja.y)} ` +
                `${Math.round(caja.width)}x${Math.round(caja.height)}`
        );
        console.log(`Enlaces menú  : ${enlaces.map((t) => t.trim()).join(' | ')}`);
        console.log(`Captura menú cerrado : ${RUTA_CERRADO}`);
        console.log(`Captura menú abierto : ${RUTA_ABIERTO}`);
    } finally {
        await contexto.close();
        await navegador.close();
    }
}

main().catch((error) => {
    console.error(`La prueba falló: ${error.message}`);
    process.exitCode = 1;
});
