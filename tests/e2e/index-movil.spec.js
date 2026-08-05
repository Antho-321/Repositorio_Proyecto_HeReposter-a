/**
 * Prueba visual de la portada (index) en móvil con Playwright.
 *
 * Abre https://pankey.live/ con un viewport de teléfono, espera a que la
 * página termine de cargarse por completo (evento `load` + red inactiva) y
 * guarda dos capturas en tests/e2e/screenshots: la primera pantalla tal como
 * se ve al entrar (sin desplazarse) y la página completa de arriba abajo.
 *
 * Uso: node tests/e2e/index-movil.spec.js
 */

const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const URL_OBJETIVO = 'https://pankey.live/';
const DIR_CAPTURAS = path.join(__dirname, 'screenshots');
const RUTA_PRIMERA_PANTALLA = path.join(DIR_CAPTURAS, 'index-movil-primera-pantalla.png');
const RUTA_COMPLETA = path.join(DIR_CAPTURAS, 'index-movil-completa.png');
const TIEMPO_MAXIMO = 60000;

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

        const titulo = await pagina.title();

        if (titulo.trim() === '') {
            throw new Error('La página cargó sin título');
        }

        // Las animaciones de entrada (WOW/animate.css) tardan un momento en
        // asentarse; esperamos antes de capturar para no fotografiar bloques
        // a medio aparecer.
        await pagina.waitForTimeout(1200);

        // Primera pantalla: exactamente lo que ve el usuario al entrar, sin
        // desplazarse.
        await pagina.screenshot({ path: RUTA_PRIMERA_PANTALLA });

        // Página completa: útil para revisar el resto del index de una vez.
        await pagina.screenshot({ path: RUTA_COMPLETA, fullPage: true });

        // Alto total del documento frente al alto del viewport: indica cuántas
        // pantallas hay que desplazar para recorrer la portada.
        const alturas = await pagina.evaluate(() => ({
            documento: document.documentElement.scrollHeight,
            viewport: window.innerHeight,
        }));

        // Un desbordamiento horizontal en móvil casi siempre es un defecto de
        // maquetación, así que lo avisamos.
        const desbordaHorizontal = await pagina.evaluate(
            () => document.documentElement.scrollWidth > window.innerWidth
        );

        console.log(`URL final          : ${pagina.url()}`);
        console.log(`Estado             : ${respuesta.status()}`);
        console.log(`Título             : ${titulo}`);
        console.log(
            `Alto documento     : ${alturas.documento}px ` +
                `(${(alturas.documento / alturas.viewport).toFixed(1)} pantallas)`
        );
        console.log(`Scroll horizontal  : ${desbordaHorizontal ? 'SÍ (revisar)' : 'no'}`);
        console.log(`Captura 1ª pantalla: ${RUTA_PRIMERA_PANTALLA}`);
        console.log(`Captura completa   : ${RUTA_COMPLETA}`);
    } finally {
        await contexto.close();
        await navegador.close();
    }
}

main().catch((error) => {
    console.error(`La prueba falló: ${error.message}`);
    process.exitCode = 1;
});
