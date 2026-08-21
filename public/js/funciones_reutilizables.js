export let estilo_Ingreso_Registro = document.createElement("style");
export let divVentana = document.createElement("div");
export let salto = document.getElementById("Salto");
divVentana.id = "VentanaForm";
estilo_Ingreso_Registro.innerHTML = `
  #Contenido_Cabecera, #contenido_principal, footer{
    opacity: 0.5;
  }
  #Salto{
    background: #0000007a;
    font-family:Sanseriffic;
    letter-spacing: 1.4px;
    transition: initial;
  }
#VentanaForm{
    width: 98.3vw;
    display: flex;
    justify-content: center;
    height: 75vh;
    align-items: center;
}
#VentanaForm *{
    color: black;
}
#Ventana, .Ventana{
    background-color: aliceblue !important;  
    width: 550px;
    height: 75vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-radius: 40px;
    z-index: 1;
}
.Mensaje{
    height: auto !important;
}
.Recuperación{
    height: 58vh !important;
}
#Ventana>*, .Ventana>*{
    background-color: transparent !important; 
}
label{
    padding: 0px 10px;
}
#SinCuenta{
    display: flex;
    align-items: center;
}
#ingresar, #sin_cuenta{
    padding: 10px;
}
.btnHaciaDerecha{
    display: flex;
    width: 100%;
    justify-content: flex-end;
}
#Ventana>input, .Ventana>input, #SinCuenta>input, .btnHaciaDerecha>input, #Ventana>button, .Ventana>button {
    border: 1px solid;
    border-color: black;   
    width: auto;
}
#contraseña_olvidada{
    border-color: transparent;
    text-decoration: underline;
}
.entrada_texto{
    width: 20vw !important;
    cursor: auto !important;
}
#btn_salir{
    border-color: transparent;
    font-size: 30px;
    padding: 0px;
}
h3{
    visibility: hidden;
}
.Mensaje p{
    margin: 0px;
    padding: 22px 0px;
}
.Mensaje h2{
    margin: 0px;
    padding: 10px 0px;
}
.Recuperación h2{
    margin: 0px;
}
`;
estilo_Ingreso_Registro.id="est_ingreso_registro";
export function MostrarMensaje(mensaje) {
    document.head.appendChild(estilo_Ingreso_Registro);
    salto.innerHTML = "";
    divVentana.innerHTML = `
    <form class="Mensaje" id="Ventana">
        <div class="btnHaciaDerecha">
            <input class="boton" type="button" value="✕" id="btn_salir">
        </div>  
        <h2 id="titulo">Estimado usuario</h2>
        <p>`+ mensaje + `</p>
    </form>
    `;
    salto.appendChild(divVentana);
    document.getElementById("btn_salir").addEventListener('click',CerrarVentana);
    divVentana.insertAdjacentHTML("beforebegin", `
    <div class="modal-backdrop" style="display: none;"></div>`);
    var backdrop = document.querySelector('.modal-backdrop');
    backdrop.style.display = backdrop.style.display === 'block' ? 'none' : 'block';
    var style = document.createElement('style');
    style.type = 'text/css';
    style.id = "estilo_rd-nav-link";
    var cssRule = `.rd-nav-link::before { opacity: 0 !important; }`; // Set your desired opacity value here
    if (style.styleSheet) {
        style.styleSheet.cssText = cssRule;
    } else {
        style.appendChild(document.createTextNode(cssRule));
    }
    document.head.appendChild(style);
    document.getElementById("menu").style="z-index: 10 !important";
}
export function CerrarVentana() {
    let estilo_aux = document.getElementById("aux_cont_principal");
    // Use Array.from to convert NodeList to Array for using filter, forEach
    Array.from(salto.children).forEach(function(child) {
        // Skip elements with specific IDs or names
        if (child.id !== 'registro') {
            salto.removeChild(child);
        }
    });

    if (estilo_aux != null || estilo_aux != undefined) {
        estilo_aux.remove();
    } else {
        document.getElementById("est_ingreso_registro").remove();
    }
    let opera_bug = document.getElementById("operaUserStyle");
    if (opera_bug != null && opera_bug != undefined) {
        opera_bug.remove();
    }
    document.querySelector(".rd-nav-link").removeAttribute("style");
    if (document.getElementById("estilo_rd-nav-link")!=null) {
        document.getElementById("estilo_rd-nav-link").remove();
    }
    document.getElementById("menu").removeAttribute("style");
}

/* ─── Fondo blanco para las fotos recortadas ──────────────────────────────
   Un .cuadro-foto rellena el hueco que le sobra con la propia foto ampliada y
   desenfocada (css/estilos_reutilizables.css). Eso funciona con una fotografía,
   que es opaca y tapa el relleno; pero una foto recortada —un PNG con canal
   alfa, como Crosant.png, Rollo de canela.png o CupCake.png— deja pasar el
   relleno por dentro del producto y lo ensucia.

   Saber si una imagen tiene transparencia no se puede desde el CSS, así que hay
   que mirarla: se pinta en un lienzo pequeño y se lee el canal alfa. A la que la
   tiene se le pone la clase .cuadro-foto--transparente, que quita el relleno y
   deja el cuadro en blanco puro. */

/* Ya mirados, para no repetir el trabajo si se vuelve a llamar (la rejilla de
   productos se reconstruye cada vez que se elige una categoría). */
const cuadros_ya_mirados = new WeakSet();

/* Mirar la foto exige dos cosas seguidas, y en este orden.

   Primero esperar a que ESTÉ DESCARGADA: decode() llamado sobre una foto que
   todavía viene por el cable se rechaza en Chrome («The source image cannot be
   decoded»), y como el fallo se recoge sin ruido el cuadro se quedaba sin
   marcar. Pasaba sólo a veces, y siempre con las grandes —Crosant.png pesa lo
   suyo a 3402x3402— que son justo las que tardan: de tres cargas seguidas,
   fallaba en una.

   Y después esperar a que esté DESCODIFICADA: drawImage sobre una foto cuyo
   mapa de bits el navegador ya ha soltado —hace eso con las grandes en cuanto
   las ha sacado por pantalla— no pinta nada, y el lienzo sale transparente
   entero; es decir, la foto más opaca pasaría por recortada.

   Si decode() se rechaza pese a estar ya descargada, se sigue igual: drawImage
   la descodificará por su cuenta, y de una lectura mala protege la salvaguarda
   de fotoTieneTransparencia(). */
function fotoDescargada(imagen) {
    if (imagen.complete) {
        return imagen.naturalWidth > 0
            ? Promise.resolve()
            : Promise.reject(new Error("la foto no ha cargado"));
    }
    return new Promise(function (cumplir, fallar) {
        imagen.addEventListener("load", cumplir, { once: true });
        imagen.addEventListener("error", fallar, { once: true });
    });
}

function fotoLista(imagen) {
    return fotoDescargada(imagen).then(function () {
        if (typeof imagen.decode === "function") {
            return imagen.decode().catch(function () {});
        }
    });
}

function fotoTieneTransparencia(imagen) {
    /* 40x40 basta: sólo se quiere saber SI hay zonas transparentes, no dónde. A
       tamaño real habría que recorrer 11 millones de píxeles en el caso de
       Crosant.png. Al encoger, el navegador promedia, pero eso no confunde la
       cuenta: una foto opaca no tiene ningún alfa menor que 255 que promediar,
       así que sigue dando 255 en las 1600 muestras. Medido con estas cuatro:
       _7.png 0 %, CupCake.png 30 %, Rollo de canela.png 30 %, Crosant.png 86 %;
       a 100x100 salen los mismos porcentajes. */
    const lado = 40;
    const muestras = lado * lado;
    const lienzo = document.createElement("canvas");
    lienzo.width = lado;
    lienzo.height = lado;
    const pincel = lienzo.getContext("2d");
    pincel.drawImage(imagen, 0, 0, lado, lado);
    /* getImageData lanza SecurityError si la foto viene de otro dominio que no
       manda cabeceras CORS: el lienzo queda «contaminado» y el navegador no
       deja leerlo. Lo recoge el .catch() de abajo. */
    const datos = pincel.getImageData(0, 0, lado, lado).data;
    let transparentes = 0;
    /* El alfa es el cuarto byte de cada píxel (R, G, B, A). */
    for (let i = 3; i < datos.length; i += 4) {
        if (datos[i] < 250) {
            transparentes++;
        }
    }
    /* Salvaguarda: que salgan transparentes TODAS no significa que la foto sea
       invisible —eso no existe en un catálogo— sino que drawImage no ha pintado
       nada. Ante la duda, no se marca y se queda el relleno desenfocado. La
       recortada más extrema de las que hay, Crosant.png, lee un 88 %, así que
       el tope no le pilla. */
    if (transparentes === muestras) {
        return false;
    }
    /* Un 1 % de margen, por si alguna foto opaca trae un píxel suelto a medias.
       Sobra de largo: entre el 0 % de las opacas y el 30 % de la recortada más
       justa no hay nada. */
    return transparentes > muestras / 100;
}

export function marcarCuadrosTransparentes(raiz = document) {
    raiz.querySelectorAll(".cuadro-foto").forEach(function (cuadro) {
        if (cuadros_ya_mirados.has(cuadro)) {
            return;
        }
        cuadros_ya_mirados.add(cuadro);
        const imagen = cuadro.querySelector("img");
        if (imagen == null) {
            return;
        }
        fotoLista(imagen)
            .then(function () {
                if (fotoTieneTransparencia(imagen)) {
                    cuadro.classList.add("cuadro-foto--transparente");
                }
            })
            .catch(function () {
                /* Aquí caen los dos casos en que no se puede mirar la foto: que
                   esté rota (decode() rechaza) y que venga de otro dominio sin
                   cabeceras CORS (SecurityError al leer el lienzo). En los dos
                   se queda el relleno desenfocado, que para las fotos de fuera
                   que hay hoy es lo correcto: todas son JPEG, y el JPEG no
                   tiene canal alfa. Si alguna vez se enlaza un PNG recortado de
                   otro dominio, se le escribe a mano la clase
                   .cuadro-foto--transparente en la vista. */
            });
    });
}

/* Las que ya vienen en el HTML («Sobre nosotros», la ficha de producto). Los
   <script type="module"> van diferidos, así que aquí el HTML ya está montado.
   Las tarjetas que construye el JavaScript no están todavía: ésas las marca
   AgregarContenido() en script_InteracciónPrincipal.js, al terminar de
   montarlas. */
marcarCuadrosTransparentes();
