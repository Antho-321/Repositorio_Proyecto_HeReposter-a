/**
 * Prueba de humo con Playwright.
 *
 * Abre https://pankey.live/, espera a que la página termine de cargarse por
 * completo (evento `load` + red inactiva) y guarda una captura en
 * tests/e2e/screenshots.
 *
 * Uso: node tests/e2e/pankey.spec.js
 */

const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const URL_OBJETIVO = 'https://pankey.live/';
const DIR_CAPTURAS = path.join(__dirname, 'screenshots');
const RUTA_CAPTURA = path.join(DIR_CAPTURAS, 'pankey-home.png');
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
    const contexto = await navegador.newContext({
        viewport: { width: 1440, height: 900 },
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

        await pagina.screenshot({ path: RUTA_CAPTURA, fullPage: true });

        console.log(`URL final : ${pagina.url()}`);
        console.log(`Estado    : ${respuesta.status()}`);
        console.log(`Título    : ${titulo}`);
        console.log(`Captura   : ${RUTA_CAPTURA}`);
    } finally {
        await contexto.close();
        await navegador.close();
    }
}

main().catch((error) => {
    console.error(`La prueba falló: ${error.message}`);
    process.exitCode = 1;
});
