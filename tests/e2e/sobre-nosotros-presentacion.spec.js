/**
 * Prueba de presentación del bloque "Nuestra historia" con Playwright.
 *
 * El texto pasó de un párrafo único a tres, y el CSS de la página estaba
 * escrito para uno solo:
 *   - `p { margin: 0px }` deja los tres párrafos pegados, sin aire entre ellos.
 *   - `#contenido_principal { height: 69.9vh }` es una altura fija: con más
 *     texto, lo que sobra se sale de la caja en lugar de empujarla.
 *   - `#texto { text-align: center }` centra un texto corrido largo, que es
 *     justo donde el centrado más cuesta de leer (cada línea empieza en una
 *     sangría distinta).
 *
 * Por eso aquí no se mide tipografía (eso ya lo cubre
 * sobre-nosotros-parrafo.spec.js) sino la maquetación: cuántos párrafos hay,
 * cuánto aire los separa, si el contenido cabe en su contenedor y cuántos
 * caracteres entran por línea.
 *
 * Dos cautelas aprendidas midiendo esta página:
 *   - Hay un preloader animado a pantalla completa (.preloader). Si se mide o
 *     se captura antes de que se vaya, sale la página velada tras la animación.
 *   - Las capturas `fullPage` NO sirven aquí: Chromium agranda el viewport para
 *     hacerlas, y esta maqueta depende de `vh` (#contenido_principal: 69.9vh),
 *     así que la propia captura cambia lo que retrata. Se captura el viewport.
 *
 * Guarda capturas en tests/e2e/screenshots, en escritorio y en móvil.
 *
 * Uso: node tests/e2e/sobre-nosotros-presentacion.spec.js
 */

const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const URL_OBJETIVO = 'https://pankey.live/cliente.sobre_nosotros';
const DIR_CAPTURAS = path.join(__dirname, 'screenshots');
const TIEMPO_MAXIMO = 60000;

const SELECTOR_TEXTO = '#texto';
const SELECTOR_PARRAFOS = '#texto p';
const SELECTOR_CONTENEDOR = '#contenido_principal';
const SELECTOR_PRELOADER = '.preloader';

const PARRAFOS_ESPERADOS = 3;

// Aire mínimo entre párrafos. Por debajo de ~12px el ojo no separa los bloques
// y los tres se leen como un muro.
const SEPARACION_MINIMA_PX = 12;

// Cuánto puede estirarse el espacio más forzado respecto al natural antes de
// que el hueco se lea como un río blanco bajando por el párrafo. TeX razona
// igual (badness = cuánto hay que estirar), sólo que él puede rehacer el
// párrafo entero para evitarlo y aquí sólo se puede medir el resultado.
//
// 2,2 y no 2,0 porque este Chromium NO trae los diccionarios de guionado
// (se comprobó: la altura del párrafo no cambia al quitar hyphens), así que lo
// que mide la prueba es el peor caso, sin poder partir palabras. En un
// navegador con diccionario español el forzado es menor que el de aquí.
const ESTIRAMIENTO_MAXIMO = 2.2;

// Aire por debajo de la última línea, antes del pie negro de la página.
const COLCHON_INFERIOR_MINIMO_PX = 20;

// Medida de legibilidad de toda la vida: entre 45 y 75 caracteres por línea.
// Se cuenta de verdad (caracteres del párrafo entre líneas que ocupa), no se
// estima a partir del ancho.
const CARACTERES_POR_LINEA_MAXIMO = 75;

// En este servidor (Oracle Linux 9, aarch64) usamos el Chromium del sistema:
// los binarios que descarga Playwright se compilan contra una glibc más nueva.
const CHROMIUM_DEL_SISTEMA = '/usr/bin/chromium-browser';

// `justificado` es lo que se espera en cada vista: la página justifica sólo
// donde la línea es larga; en móvil el texto va en bandera a la derecha.
const VISTAS = [
    { nombre: 'escritorio', viewport: { width: 1440, height: 900 }, justificado: true },
    {
        nombre: 'movil',
        viewport: { width: 390, height: 844 },
        esMovil: true,
        justificado: false,
    },
];

const fallos = [];

function comprobar(condicion, mensaje) {
    console.log(`${condicion ? 'OK  ' : 'FALLO'} ${mensaje}`);
    if (!condicion) {
        fallos.push(mensaje);
    }
}

/**
 * Mide la calidad del justificado, palabra a palabra.
 *
 * El navegador justifica línea a línea (first-fit): cuando una línea se queda
 * corta de palabras, estira sus espacios sin poder devolver una palabra a la
 * línea anterior, y salen los "ríos" blancos. Knuth-Plass evita eso ajustando
 * el párrafo entero, pero no está al alcance de CSS; lo que sí se puede es
 * medir el resultado con su misma vara: cuánto se ha tenido que estirar el
 * espacio más forzado respecto al espacio natural de esa fuente.
 *
 * Para medirlo se clona el párrafo con cada palabra envuelta en un <span>, se
 * le da el ancho real y se leen las posiciones. La referencia de "espacio
 * natural" es la última línea, que es la única que no se justifica.
 */
function medirJustificado(pagina, selector) {
    return pagina.evaluate((sel) => {
        function envolverPalabras(nodo) {
            const textos = [];
            const paseador = document.createTreeWalker(nodo, NodeFilter.SHOW_TEXT);
            while (paseador.nextNode()) {
                textos.push(paseador.currentNode);
            }

            textos.forEach((texto) => {
                const trozos = texto.textContent.split(/(\s+)/);
                const fragmento = document.createDocumentFragment();

                trozos.forEach((trozo) => {
                    if (trozo === '') {
                        return;
                    }
                    if (/^\s+$/.test(trozo)) {
                        fragmento.appendChild(document.createTextNode(trozo));
                        return;
                    }
                    const span = document.createElement('span');
                    span.dataset.palabra = '1';
                    span.textContent = trozo;
                    fragmento.appendChild(span);
                });

                texto.parentNode.replaceChild(fragmento, texto);
            });
        }

        return Array.from(document.querySelectorAll(sel)).map((parrafo) => {
            const ancho = parrafo.getBoundingClientRect().width;
            const clon = parrafo.cloneNode(true);

            envolverPalabras(clon);
            // Fuera del flujo para no mover nada, pero con el ancho real: el
            // reparto de espacios depende por completo de ese ancho.
            clon.style.position = 'absolute';
            clon.style.visibility = 'hidden';
            clon.style.width = `${ancho}px`;
            clon.style.maxWidth = 'none';
            parrafo.parentNode.appendChild(clon);

            const palabras = Array.from(clon.querySelectorAll('span[data-palabra]')).map((s) => {
                const r = s.getBoundingClientRect();
                return { izquierda: r.left, derecha: r.right, arriba: Math.round(r.top) };
            });

            // Agrupar por línea: misma coordenada superior redondeada.
            const lineas = [];
            palabras.forEach((palabra) => {
                const ultima = lineas[lineas.length - 1];
                if (ultima && ultima.arriba === palabra.arriba) {
                    ultima.palabras.push(palabra);
                } else {
                    lineas.push({ arriba: palabra.arriba, palabras: [palabra] });
                }
            });

            const huecosDe = (linea) => {
                const huecos = [];
                for (let i = 1; i < linea.palabras.length; i += 1) {
                    huecos.push(linea.palabras[i].izquierda - linea.palabras[i - 1].derecha);
                }
                return huecos.filter((h) => h > 0);
            };

            const ultimaLinea = lineas[lineas.length - 1];
            const huecosUltima = huecosDe(ultimaLinea);
            const todosLosHuecos = lineas.flatMap(huecosDe);

            // Espacio natural: el de la última línea (no se justifica). Si la
            // última línea es una sola palabra, el más estrecho del párrafo.
            const natural =
                huecosUltima.length > 0
                    ? huecosUltima.reduce((a, b) => a + b, 0) / huecosUltima.length
                    : Math.min(...todosLosHuecos);

            const maximo = Math.max(...todosLosHuecos);

            clon.remove();

            return {
                lineas: lineas.length,
                espacioNatural: natural,
                espacioMaximo: maximo,
                // La vara: cuánto se estira el espacio más forzado del párrafo.
                estiramiento: maximo / natural,
                palabrasUltimaLinea: ultimaLinea.palabras.length,
            };
        });
    }, selector);
}

/**
 * Mide la maquetación del bloque de texto: geometría de cada párrafo, hueco
 * real entre ellos y si el contenedor de altura fija se queda corto.
 */
function medirPresentacion(pagina, selectores) {
    return pagina.evaluate(({ texto, parrafos, contenedor }) => {
        const bloque = document.querySelector(texto);
        const caja = document.querySelector(contenedor);
        const lista = Array.from(document.querySelectorAll(parrafos));

        if (!bloque || !caja || lista.length === 0) {
            return { existe: false, parrafos: lista.length };
        }

        const medidos = lista.map((p) => {
            const rect = p.getBoundingClientRect();
            const estilo = getComputedStyle(p);

            return {
                arriba: rect.top,
                abajo: rect.bottom,
                ancho: rect.width,
                alto: rect.height,
                fontSize: parseFloat(estilo.fontSize),
                lineHeight: parseFloat(estilo.lineHeight) || 0,
                marginTop: parseFloat(estilo.marginTop),
                marginBottom: parseFloat(estilo.marginBottom),
                caracteres: p.textContent.trim().length,
                textAlign: estilo.textAlign,
            };
        });

        // Hueco visible: distancia entre el final de un párrafo y el inicio del
        // siguiente. Es lo que ve el lector, ya colapsados los márgenes.
        const separaciones = [];
        for (let i = 1; i < medidos.length; i += 1) {
            separaciones.push(medidos[i].arriba - medidos[i - 1].abajo);
        }

        // Solape entre el titular y la foto: en móvil el h1 estaba fuera del
        // flujo (position:absolute) y con el texto más largo acabó encima de
        // la imagen. Las cajas no deben pisarse ni en vertical ni en horizontal.
        const titulo = document.querySelector('#texto h1');
        const foto = document.querySelector('#DestacadoPrincipal img');
        let solape = 0;

        if (titulo && foto) {
            const a = titulo.getBoundingClientRect();
            const b = foto.getBoundingClientRect();
            const alto = Math.min(a.bottom, b.bottom) - Math.max(a.top, b.top);
            const ancho = Math.min(a.right, b.right) - Math.max(a.left, b.left);
            solape = alto > 0 && ancho > 0 ? alto : 0;
        }

        return {
            existe: true,
            solapeTituloFoto: solape,
            parrafos: medidos,
            separaciones,
            // La del párrafo, no la del contenedor: el titular sigue centrado
            // por #texto, y lo que se juzga aquí es el texto corrido.
            alineacion: medidos[0].textAlign,
            contenedor: {
                alturaVisible: caja.clientHeight,
                alturaContenido: caja.scrollHeight,
                overflowY: getComputedStyle(caja).overflowY,
            },
            // Lo que sobresale del contenedor por abajo: si el último párrafo
            // termina más allá del borde inferior, se está saliendo de la caja.
            desborde:
                medidos[medidos.length - 1].abajo -
                (caja.getBoundingClientRect().top + caja.clientHeight),
        };
    }, selectores);
}

async function revisarVista(navegador, vista) {
    const contexto = await navegador.newContext({
        viewport: vista.viewport,
        isMobile: Boolean(vista.esMovil),
        hasTouch: Boolean(vista.esMovil),
        deviceScaleFactor: vista.esMovil ? 2 : 1,
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

        // Las fuentes se descargan aparte del HTML: sin esperarlas, las alturas
        // medidas serían las de la fuente de reserva, no las reales.
        await pagina.evaluate(() => document.fonts.ready);

        // El preloader tapa la página mientras se reconstruye el logo: medir o
        // capturar antes de que termine retrata la animación, no la página.
        await pagina
            .locator(SELECTOR_PRELOADER)
            .waitFor({ state: 'hidden', timeout: TIEMPO_MAXIMO })
            .catch(() => {});

        const bloque = pagina.locator(SELECTOR_TEXTO);
        await bloque.waitFor({ state: 'visible', timeout: TIEMPO_MAXIMO });

        const medida = await medirPresentacion(pagina, {
            texto: SELECTOR_TEXTO,
            parrafos: SELECTOR_PARRAFOS,
            contenedor: SELECTOR_CONTENEDOR,
        });

        console.log(`\n--- ${vista.nombre} (${vista.viewport.width}x${vista.viewport.height}) ---`);

        comprobar(medida.existe, `[${vista.nombre}] el bloque de texto está en la página`);

        if (medida.existe) {
            comprobar(
                medida.parrafos.length === PARRAFOS_ESPERADOS,
                `[${vista.nombre}] hay ${PARRAFOS_ESPERADOS} párrafos ` +
                    `(encontrados: ${medida.parrafos.length})`
            );

            // Se mide aquí arriba porque de este análisis sale también el
            // número de líneas de cada párrafo, que usa la medida de lectura.
            const justificado = await medirJustificado(pagina, SELECTOR_PARRAFOS);

            const separacionMinima = Math.min(...medida.separaciones);
            comprobar(
                separacionMinima >= SEPARACION_MINIMA_PX,
                `[${vista.nombre}] los párrafos respiran: hueco mínimo ` +
                    `${separacionMinima.toFixed(1)}px (>= ${SEPARACION_MINIMA_PX}px). ` +
                    `Huecos: ${medida.separaciones.map((s) => s.toFixed(1)).join(', ')}`
            );

            // Con height fija, el navegador no avisa: simplemente recorta o
            // solapa. Comparar scrollHeight con clientHeight lo destapa.
            const { alturaVisible, alturaContenido } = medida.contenedor;
            comprobar(
                alturaContenido <= alturaVisible + 1,
                `[${vista.nombre}] el contenido cabe en #contenido_principal: ` +
                    `${alturaContenido}px de contenido en ${alturaVisible}px de caja`
            );
            // Negativo = margen que queda por debajo. Se pide algo de colchón:
            // a ras del borde, la última línea se lee pegada al pie negro.
            comprobar(
                medida.desborde <= -COLCHON_INFERIOR_MINIMO_PX,
                `[${vista.nombre}] el último párrafo no toca el pie ` +
                    `(quedan ${(-medida.desborde).toFixed(1)}px por debajo, ` +
                    `mínimo ${COLCHON_INFERIOR_MINIMO_PX}px)`
            );

            comprobar(
                medida.solapeTituloFoto === 0,
                `[${vista.nombre}] el titular no se monta sobre la foto ` +
                    `(solape: ${medida.solapeTituloFoto.toFixed(1)}px)`
            );

            // Caracteres por línea reales: texto entre líneas que ocupa. Antes
            // se estimaba como ancho / (0,5em), y en Sanseriffic esa regla se
            // equivocaba en un 25% (daba 85 donde hay 68).
            const anchoLinea = medida.parrafos[0].ancho;
            const caracteresPorLinea =
                medida.parrafos[0].caracteres / justificado[0].lineas;
            comprobar(
                caracteresPorLinea <= CARACTERES_POR_LINEA_MAXIMO,
                `[${vista.nombre}] línea legible: ~${caracteresPorLinea.toFixed(0)} caracteres ` +
                    `(<= ${CARACTERES_POR_LINEA_MAXIMO}), ancho ${anchoLinea.toFixed(0)}px`
            );

            const alineacionEsperada = vista.justificado ? 'justify' : 'left';
            comprobar(
                medida.alineacion === alineacionEsperada,
                `[${vista.nombre}] alineación ${alineacionEsperada} ` +
                    `(es: ${medida.alineacion})`
            );

            // El estiramiento sólo dice algo donde se justifica: en bandera los
            // espacios son todos el natural y la medida sería siempre 1,00×.
            if (vista.justificado) {
                justificado.forEach((p, i) => {
                    comprobar(
                        p.estiramiento <= ESTIRAMIENTO_MAXIMO,
                        `[${vista.nombre}] párrafo ${i + 1} sin ríos: el espacio más ` +
                            `forzado se estira ${p.estiramiento.toFixed(2)}× el natural ` +
                            `(<= ${ESTIRAMIENTO_MAXIMO}×; ${p.espacioNatural.toFixed(1)}px → ` +
                            `${p.espacioMaximo.toFixed(1)}px en ${p.lineas} líneas)`
                    );
                });
            }

            // Viuda: última línea de una sola palabra colgando bajo un bloque
            // justificado. Es el defecto que más canta al justificar.
            const viudas = justificado.filter((p) => p.palabrasUltimaLinea < 2).length;
            comprobar(
                viudas === 0,
                `[${vista.nombre}] ningún párrafo acaba en línea viuda ` +
                    `(${viudas} de ${justificado.length})`
            );

            console.log(`Alineación      : ${medida.alineacion}`);
            console.log(
                `Estiramiento    : ${justificado
                    .map((p) => `${p.estiramiento.toFixed(2)}×`)
                    .join(' · ')}`
            );
            console.log(
                `Márgenes p      : ${medida.parrafos
                    .map((p) => `${p.marginTop}/${p.marginBottom}`)
                    .join(' · ')}`
            );
            console.log(
                `Altura caja     : ${alturaVisible}px visible, ${alturaContenido}px de contenido`
            );
        }

        const rutaBloque = path.join(DIR_CAPTURAS, `sobre-nosotros-texto-${vista.nombre}.png`);
        const rutaPagina = path.join(DIR_CAPTURAS, `sobre-nosotros-presentacion-${vista.nombre}.png`);

        // La captura de página va primero: fotografiar un elemento lo desplaza
        // a la vista, y después la página saldría a media altura.
        // Sin fullPage: ver la nota de cabecera sobre `vh` y el viewport.
        await pagina.screenshot({ path: rutaPagina });
        await bloque.screenshot({ path: rutaBloque });

        console.log(`Captura bloque  : ${rutaBloque}`);
        console.log(`Captura página  : ${rutaPagina}`);
    } finally {
        await contexto.close();
    }
}

async function main() {
    fs.mkdirSync(DIR_CAPTURAS, { recursive: true });

    const opciones = { args: ['--no-sandbox', '--disable-dev-shm-usage'] };

    if (fs.existsSync(CHROMIUM_DEL_SISTEMA)) {
        opciones.executablePath = CHROMIUM_DEL_SISTEMA;
    }

    const navegador = await chromium.launch(opciones);

    try {
        for (const vista of VISTAS) {
            await revisarVista(navegador, vista);
        }
    } finally {
        await navegador.close();
    }

    if (fallos.length > 0) {
        throw new Error(`${fallos.length} comprobación(es) fallaron`);
    }
}

main().catch((error) => {
    console.error(`\nLa prueba falló: ${error.message}`);
    process.exitCode = 1;
});
