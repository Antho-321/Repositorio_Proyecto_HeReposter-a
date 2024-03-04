let num_productos, cantidad_producto_carr, img, id_imagen, direccion_producto,
    dedicatoria, cuadros_dedicatoria, opciones, id_producto, precio_producto,
    descripción_adicional, porciones, masa, cobertura, sabor, relleno, reqAdicional,
    fecha_valida, dia_mañana, hora_valida, add_carrito, registro;
let html_aux1 = "";
let html_aux2 = "";
let productos = [];
let lupa = document.getElementById("lupa");
let cuadro_búsqueda = document.getElementById("búsqueda");
let contenido_categorías = document.getElementById("Menu_Catalogo");
let contenido_principal = document.getElementById("contenido_principal");
let seccion_productos = document.getElementById("seccion_productos");
let estilo = document.getElementById("estilo");
let estilo_aux_CategoríaSel = document.createElement("style");
let estilo_búsqueda = document.createElement("style");
let estilo_aux_EnvíoACarrito = document.createElement("style");
let estilo_carritoSinProductos = document.createElement("style");
let estilo_ver_categorías = document.createElement("style");
let btn_ingreso = document.getElementById("Ingreso");

let ubicación_página = window.location.href;
let actualizar_pastel = document.getElementById("actualizar_pastel");
var currentView = document.querySelector('meta[name="current-view"]').getAttribute('content');
import { estilo_Ingreso_Registro, salto, divVentana, CerrarVentana } from './funciones_reutilizables.js';

estilo_búsqueda.id = "estilo_búsqueda";
estilo_aux_EnvíoACarrito.id = "est_EnvíoACarrito";
estilo_ver_categorías.id = "est_ver_categorías";
estilo_aux_CategoríaSel.id = "est_CategoríaSel";
estilo_ver_categorías.innerHTML = "#Catalogo:hover #Menu_Catalogo {visibility: visible;}";
estilo_aux_EnvíoACarrito.innerHTML = `
#seccion_envio p{
    opacity: 1;
}
`;
estilo_búsqueda.innerHTML = `
#búsqueda{
    width: 0px;
    border-color: black;
}
#seccion_busqueda{
    position: initial;
    z-index: 0;
}
`;
estilo_aux_CategoríaSel.innerHTML = `
#seccion_productos{
    padding-bottom: calc(70px - 2.5%);
}
`;
estilo_carritoSinProductos.innerHTML = `
#contenido_principal {
    height: 69.9%;
    padding-bottom: 0px;
    align-items: center;
    justify-content: center;
}
`;
estilo_carritoSinProductos.id = "aux_cont_principal";
add_carrito = document.getElementById("add_carrito");
if (btn_ingreso != null) {
    btn_ingreso.addEventListener('click', MostrarVentanaDeIngreso);
}
if (seccion_productos != null) {
    window.onload = AgregarContenido("");
}
if (actualizar_pastel != null) {
    cantidadInput = document.getElementById("cantidad");
    window.onload = verificarDedicatorias(cantidadInput);
}
if (add_carrito != null) {
    add_carrito.addEventListener('click', MostrarMensajev2);
}
if (currentView == "detalles_pedido.update" || currentView == "detalles_pedido.destroy" || currentView == "cliente.carrito") {
    AgregarContenidoCarrito();
    var btnFinPedido = document.getElementById("fin_pedido");
    var fecha_entrega = document.getElementById("fecha_entrega");
    var error_message = document.getElementById("error-message");
    var error_message2 = document.getElementById("error-message2");
    var error_message3 = document.getElementById("error-message3");
    var hora_entrega = document.getElementById("hora_entrega");
    var inputTime, currentDate;
    if (fecha_entrega != null) {
        fecha_entrega.addEventListener('change', function (event) {
            var dateComponents = event.target.value.split('-');
            var year = parseInt(dateComponents[0], 10);
            var month = parseInt(dateComponents[1], 10) - 1; // Los meses en JavaScript empiezan en 0
            var day = parseInt(dateComponents[2], 10) + 1;
            var inputDate = new Date(Date.UTC(year, month, day));
            if (year < 100) {
                inputDate.setFullYear(inputDate.getFullYear() - 1900);
            }
            currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            inputDate.setHours(0, 0, 0, 0);


            // create a new timeout and store its id
            if (inputDate <= currentDate) {
                error_message3.style.display = "none"; // hide the error message
                error_message.style.display = "block"; // show the error message
                fecha_valida = false;
                btnFinPedido.className = "fin_pedido";
                dia_mañana = false;
            } else {

                fecha_valida = true;
                error_message2.style.display = "none"; // hide the error message
                error_message3.style.display = "none"; // hide the error message
                error_message.style.display = "none"; // hide the error message
                let aux_currentDate = new Date();
                aux_currentDate.setHours(0, 0, 0, 0);
                aux_currentDate.setDate(aux_currentDate.getDate() + 1);

                if (inputDate.getTime() == aux_currentDate.getTime()) {
                    dia_mañana = true;
                } else {
                    dia_mañana = false;
                }
                comprobacionHora();
            }
        });
        hora_entrega.addEventListener('input', function (event) {
            comprobacionHora();
            setTimeout(function () {
                hora_entrega.blur();
            }, 1010);

        });
    }
    if (btnFinPedido != null) {
        btnFinPedido.addEventListener('click', finalizarPedido);
    }
}
function comprobacionHora() {
    currentDate = new Date();
    inputTime = hora_entrega.value + "";
    let [hours, mins] = inputTime.split(":");
    var inputDate = new Date();
    inputDate.setHours(hours);
    inputDate.setMinutes(mins);
    hora_entrega.value = hours + ":" + mins;
    if (inputDate == "Invalid Date") {
        hora_valida = false;
    } else {
        if (dia_mañana == true) {
            if (inputDate.getTime() < currentDate.getTime()) {
                error_message2.style.display = "block"; // show the error message
                btnFinPedido.className = "fin_pedido";
                hora_valida = false;
            } else {
                error_message2.style.display = "none"; // hide the error message
                btnFinPedido.removeAttribute("class");
                hora_valida = true;
            }
        } else {
            hora_valida = true;
            if (fecha_valida == true) {
                btnFinPedido.removeAttribute("class");
                error_message2.style.display = "none"; // hide the error message
            } else {
                error_message3.style.display = "block"; // show the error message  
            }
        }
    }
}
if (contenido_categorías != null) {
    let tamaño = contenido_categorías.children.length;
    for (let i = 0; i < tamaño; i++) {
        contenido_categorías.children[i].addEventListener("click", funcCategoríaSeleccionada);
    }
}
function AgregarContenido(CategoríaSeleccionada) {
    seccion_productos = document.getElementById("seccion_productos");
    if (CategoríaSeleccionada == "") {
        let input = document.getElementById("pasteles");
        let value = input.value;
        let array = JSON.parse(value);
        let div_aux = document.createElement("div");
        div_aux.className = "contenedor_imagenes";
        for (let i = 0; i < array.length; i++) {
            let div = document.createElement("div");
            div.className = "imagen";
            let imagen = document.createElement("img");
            let h3 = document.createElement("button");
            imagen.src = array[i].img;
            imagen.style = "height: 300px !important; width: 300px !important; border-radius: 10px;";
            h3.innerHTML = "Mostrar más información";
            h3.className = "mostrar_informacion";
            div.appendChild(h3);
            h3.addEventListener("click", ProductoSeleccionado);
            div.appendChild(imagen);
            div_aux.appendChild(div);
        }
        seccion_productos.appendChild(div_aux);

    } else {
        if (CategoríaSeleccionada == " Navidad") {
            CategoríaSeleccionada = CategoríaSeleccionada.substring(1);
        }
        let myData = myAsyncFunction(CategoríaSeleccionada);
        myData.then(result => {
            let div_aux = document.createElement("div");
            for (let i = 0; i < result.length; i++) {
                let div = document.createElement("div");
                let imagen = document.createElement("img");
                let h3 = document.createElement("h3");
                imagen.src = result[i].img;
                h3.innerHTML = "Mostrar más información";
                div.appendChild(h3);
                h3.addEventListener("click", ProductoSeleccionado);
                div.appendChild(imagen);
                div_aux.appendChild(div);
            }
            seccion_productos.appendChild(div_aux);
        }
        );
    }
}
function myAsyncFunction(imagen) {
    let encodedImagen;
    encodedImagen = imagen;
    if (imagen != undefined) {
        if (imagen.includes("http")) {
            encodedImagen = encodeURIComponent(imagen);
        }
    }
    return new Promise((resolve, reject) => {

        fetch("../php/ConsultaProductoSeleccionado.php?imagen=" + encodedImagen)
            .then(response => response.json())
            .then(data => {
                resolve(data);
            })
            .catch(error => {
                // mostrar el mensaje y la pila del error
                console.error("MENSAJE DE ERROR: " + error.message + " | stack: " + error.stack);
                // o mostrar el error completo
                console.error(error);
            });
    });
}

function myAsyncFunction2(id, cantidad, dedicatoria, carritoInfo, reqAdicional) {
    return new Promise((resolve, reject) => {
        fetch("../php/ConsultaIngresoACarrito.php?&id=" + id + "&cantidad=" + cantidad + "&dedicatoria=" + dedicatoria + "&carritoInfo=" + carritoInfo + "&espAdicional=" + reqAdicional)
            .then(response => response.json())
            .then(data => {
                resolve(data);
            })
            .catch(error => reject(error));
    });
}

function myAsyncFunction3() {
    return new Promise((resolve, reject) => {
        fetch("../php/SacarDatosDeCarrito.php")
            .then(response => response.json())
            .then(data => {
                resolve(data);
            })
            .catch(error => reject(error));
    });
}

function quitarPlaceHolder(event) {
    let entrada_texto = event.target;
    entrada_texto.placeholder = "";
}
function disminuirCantidadProducto() {
    colSelect = document.getElementById("num_dedicatorias").parentElement;
    cantidadInput = document.getElementById("cantidad");
    if (cantidadInput.value >= 2) {
        cantidadInput.value = parseInt(cantidadInput.value) - 1;
    }
    Dedicatorias(cantidadInput);
    document.getElementById("cuadros_dedicatoria").innerHTML = `
    <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
    `;
    if (cantidadInput.value == 1) {
        texto_dedicatoria = document.getElementById("texto_dedicatoria");
        texto_dedicatoria.innerHTML = "<b>Dedicatoria para el pedido:</b>";
        colSelect.style = "display:none";
    }
}
function verificarDedicatorias(cantidadInput) {
    if (parseInt(cantidadInput.value) != 1) {
        Dedicatorias(cantidadInput);
        document.getElementById("cuadros_dedicatoria").innerHTML = `
    <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
    `;
        texto_dedicatoria = document.getElementById("texto_dedicatoria");
        texto_dedicatoria.innerHTML = "Cantidad de dedicatorias";
        colSelect = document.getElementById("num_dedicatorias").parentElement;
        colSelect.removeAttribute("style");
    }

}
function aumentarCantidadProducto() {
    cantidadInput = document.getElementById("cantidad");
    cantidadInput.value = parseInt(cantidadInput.value) + 1;
    verificarDedicatorias(cantidadInput);
}
function Dedicatorias(cantidadInput) {
    texto_dedicatoria = document.getElementById("texto_dedicatoria");
    opciones = document.getElementById("num_dedicatorias");
    html_aux1 = "";
    if (opciones != null && opciones != undefined) {
        opciones.remove();
    }
    for (let i = 0; i < cantidadInput.value; i++) {
        html_aux1 += '<option value="' + (i + 1) + '">' + (i + 1) + '</option>';
    }
    texto_dedicatoria.nextSibling.nextSibling.innerHTML = `
    <select id="num_dedicatorias" onchange="AgregarHermanosSelect()">
        `+ html_aux1 + `
    </select>`;
}
function AgregarHermanosSelect(arreglo_dedicatorias) {
    let límite;
    let dedicatoria = "";
    html_aux2 = "";
    dedicatorias = document.getElementsByName("dedicatoria");
    let select_dedicatorias = document.getElementById("num_dedicatorias");
    límite = select_dedicatorias.value - dedicatorias.length;
    if (select_dedicatorias.value - dedicatorias.length >= 1) {
        for (let i = 1; i <= límite; i++) {
            if (arreglo_dedicatorias == undefined) {
                html_aux2 += '<input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria">';
            } else {
                if (arreglo_dedicatorias[i] != "Sin dedicatoria") {
                    dedicatoria = arreglo_dedicatorias[i];
                } else {
                    dedicatoria = "";
                }
                html_aux2 += '<input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" value="' + dedicatoria + '">';
            }
        }
        dedicatorias[dedicatorias.length - 1].insertAdjacentHTML("afterend", html_aux2);
    } else {
        límite = límite * (-1);
        cuadros_dedicatoria = document.getElementById("cuadros_dedicatoria");
        for (let i = 1; i <= límite; i++) {
            cuadros_dedicatoria.children[cuadros_dedicatoria.children.length - 1].remove();
        }
    }
    for (let i = 0; i < dedicatorias.length; i++) {
        dedicatorias[i].addEventListener("click", quitarPlaceHolder);
    }
}
function mostrarBúsqueda() {
    let est_búsqueda = document.getElementById("estilo_búsqueda");
    let check1 = document.getElementById("check");
    let check = document.getElementById("check2");
    if (est_búsqueda != null) {
        check.checked = false;
        est_búsqueda.remove();
        cuadro_búsqueda.removeAttribute("style");
    } else {
        if (window.innerWidth <= 1013) {
            check1.checked = true;
        }
        check.checked = true;
        document.head.appendChild(estilo_búsqueda);
        let width = 0;
        const intervalId = setInterval(function () {
            if (width == 0) {
                cuadro_búsqueda.style.width = "0px";
            }
            width += 1;
            cuadro_búsqueda.style.width = width + "px";
            if (width >= 110) {
                clearInterval(intervalId);
            }
        }, 0.01);
    }

}
function ProductoSeleccionado(event, imagen, carritoInfo, cantidad_productos, arreglo_dedicatorias, req_Adicional) {
    let primer_dedicatoria = "";
    let myData;
    if (cantidad_productos == undefined) {
        cantidad_productos = "1";
    }
    if (arreglo_dedicatorias != undefined) {
        if (arreglo_dedicatorias[0] != "Sin dedicatoria") {
            primer_dedicatoria = arreglo_dedicatorias[0];
        }
    }
    if (carritoInfo == "si") {
        carritoInfo = "Actualizar información";
        //myData = myAsyncFunction(imagen);
        img = imagen;
    } else {
        const srcString = event.target.nextSibling.src;
        carritoInfo = "Añadir al carrito";
        req_Adicional = "";
        if (srcString.includes("imagenes")) {
            let dirImg;
            let num = srcString.indexOf("/imagenes");
            dirImg = ".." + srcString.substring(num);
            //myData = myAsyncFunction(dirImg);
        } else {
            //myData = myAsyncFunction(event.target.nextSibling.src);
        }
        img = event.target.nextSibling.src;
    }
    VerificaciónCuadroDeBúsqueda();
    estilo = document.getElementById("estilo");
    document.getElementById("enlace_pastel").value = img;

    //estilo.href = "/styles/estilo_Modificación_ProductoSeleccionado.css";

    // myData.then(result => {
    //     id_producto = result[0].codigo_producto;
    //     precio_producto = result[0].precio;
    //     descripción_adicional = result[0].descripcion;
    //     porciones = result[0].porciones;
    //     masa = result[0].masa;
    //     cobertura = result[0].cobertura;
    //     sabor = result[0].sabor;
    //     relleno = result[0].relleno;
    //     contenido_principal.innerHTML = `
    //         <div id="DestacadoPrincipal">
    //             <img src="`+ img + `" alt="imagenes">
    //             <p>$`+ precio_producto + `</p>
    //             <div id="seccion_cantidad">
    //                 <label for="cantidad" id="label_cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
    //                 <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
    //                 <input type="number" id="cantidad" name="cantidad" value="`+ cantidad_productos + `" readonly>
    //                 <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
    //             </div>
    //             <div id="seccion_envio">
    //                 <input type="button" value="`+ carritoInfo + `" onclick="enviarInfoACarrito('` + carritoInfo + `')">
    //                 <div>
    //                     <p>Producto/s ingresado/s</p>
    //                 </div>
    //             </div>
    //         </div>
    //         <div id="infoDetallada">
    //             <div>
    //             <p id="infoAdicional">`+ descripción_adicional + `</p>
    //             <div class="tabla_info">
    //                 <div class="fila">
    //                     <p class="col" id="texto_dedicatoria">Dedicatoria para el pedido:</p>
    //                     <div class="col">
    //                     </div>
    //                     <div class="col" id="cuadros_dedicatoria">
    //                         <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" value="`+ primer_dedicatoria + `">
    //                     </div>              
    //                 </div>
    //             </div>
    //             <div class="tabla_info">

    //                 <div class="fila">
    //                     <p class="col">Porciones:</p>
    //                     <p class="col">`+ porciones + `</p>
    //                 </div>
    //                 <div class="fila">
    //                     <p class="col">Tipo de pastel:</p>
    //                     <p class="col">`+ masa + `</p>
    //                     <p class="col">Cobertura:</p>
    //                     <p class="col">`+ cobertura + `</p>
    //                 </div>
    //                 <div class="fila">
    //                     <p class="col">Sabor:</p>
    //                     <p class="col">`+ sabor + `</p>
    //                     <p class="col">Relleno:</p>
    //                     <p class="col">`+ relleno + `</p>
    //                 </div>
    //                 <div class="fila">
    //                     <p class="col" id="txtadicional">Especificación adicional:</p>
    //                     <div class="col" id="adicional">
    //                         <textarea name="espAdicional" id="espAdicional" placeholder="(Opcional)">`+ req_Adicional + `</textarea>
    //                     </div>

    //                 </div>
    //             </div>
    //             </div>
    //         </div>
    //         `;
    //     if (descripción_adicional == "") {
    //         document.getElementById("infoAdicional").remove();
    //     }
    //     let dedicatorias = document.getElementsByName("dedicatoria");
    //     for (let i = 0; i < dedicatorias.length; i++) {
    //         dedicatorias[i].addEventListener("click", quitarPlaceHolder);
    //     }
    //     document.getElementById("espAdicional").addEventListener("click", quitarPlaceHolder);
    //     if (carritoInfo == "Actualizar información") {
    //         cantidadInput = document.getElementById("cantidad");
    //         Dedicatorias(cantidadInput);
    //         opciones = document.getElementById("num_dedicatorias");
    //         opciones.value = arreglo_dedicatorias.length;
    //         AgregarHermanosSelect(arreglo_dedicatorias)
    //     }
    // });
}
function funcCategoríaSeleccionada(event) {
    document.getElementById("nombre_categoria").value = event.target.innerHTML;
}
// document.getElementById("est_ver_categorías").remove();
// VerificaciónCuadroDeBúsqueda();
// let título = event.target.value;
// let h1 = document.getElementsByTagName("h1")[0];
// let destacado_principal = document.getElementById("DestacadoPrincipal");
// seccion_productos = document.getElementById("seccion_productos");
// if (document.getElementById("est_CategoríaSel") == null) {
//     document.head.appendChild(estilo_aux_CategoríaSel);
// }
// if (destacado_principal != null) {
//     destacado_principal.remove();
// }
// if (seccion_productos != null) {
//     document.querySelector("#seccion_productos>div").remove();
// } else {
//     contenido_principal.innerHTML = `
//     <h1 align="center">`+ título + `</h1>
//     <section id="seccion_productos"></section>
//     `;
//     document.getElementById("estilo").href = "../styles/estilo_Modificación_Index.css";;
// }
// if (h1 == undefined) {
//     h1 = document.getElementsByTagName("h1")[0];
// }
// h1.innerHTML = título;
// h1.align = "center";
// AgregarContenido(título);

function VerificaciónCuadroDeBúsqueda() {
    let est_búsqueda = document.getElementById("estilo_búsqueda");
    if (est_búsqueda != null) {
        est_búsqueda.remove();
        cuadro_búsqueda.removeAttribute("style");
    }
}
function ProductosNoIngresados() {
    document.head.appendChild(estilo_carritoSinProductos);
    contenido_principal.innerHTML = `
    <h1>No se ha ingresado productos</h1>
    `;
}
function isPositiveNumberStartingFromZero(str) {
    const pattern = /^(0|[1-9]\d*)$/;
    return pattern.test(str);
  }
function finalizarPedido() {
    // MostrarMensaje("Por favor déjese de mamadas");
    if (fecha_valida == true && hora_valida == true) {
        fecha_entrega.disabled = true;
        hora_entrega.disabled = true;
        let tabla_info = document.getElementsByClassName("tabla_info")[1];
        let scripts = document.getElementsByTagName("script");
        let script = document.createElement("script");
        let contenedorBtnPaypal = document.createElement("div");
        contenedorBtnPaypal.id = "paypal-button-container";
        contenedorBtnPaypal.style.width = "25vw";
        script.src = "js/script_FinalizaciónDePedido.js";
        btnFinPedido.insertAdjacentElement("afterend", contenedorBtnPaypal);
        contenedorBtnPaypal.insertAdjacentElement("afterend", script);
        btnFinPedido.remove();
        scripts[scripts.length - 1].remove();
        tabla_info.insertAdjacentHTML("afterend", `
    <h2 class="txt_total">Datos para generación de comprobante:</h2>
    <label for="cedula">Cédula:</label>
    <input type="text" name="cedula" id="cedula" class="entrada_texto">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" class="entrada_texto">
    <label for="direccion">Dirección domiciliaria:</label>
    <input type="text" name="direccion" id="direccion" class="entrada_texto">
    <label for="telefono">Teléfono móvil:</label>
    <input type="tel" name="telefono" id="telefono" class="entrada_texto">
    <h2 class="txt_total">Información de pago:</h2>
    `);
    } else {
        alert("Datos inválidos");
    }
    document.getElementById("telefono").addEventListener("input",function(){
        let valor=document.getElementById("telefono").value;
        if (!isPositiveNumberStartingFromZero(valor[valor.length-1])) {
            document.getElementById("telefono").value=valor.substring(0,valor.length-1);
        }
        if (valor.length>10) {
            document.getElementById("telefono").value=valor.substring(0,10);
        }
    })
    document.getElementById("cedula").addEventListener("input",function(){
        let valor=document.getElementById("cedula").value;
        if (!isPositiveNumberStartingFromZero(valor[valor.length-1])) {
            document.getElementById("cedula").value=valor.substring(0,valor.length-1);
        }
        if (valor.length>10) {
            document.getElementById("cedula").value=valor.substring(0,10);
        }
    })
}
function enviarInfoACarrito(carritoInfo) {
    dedicatoria = "";
    reqAdicional = document.getElementById("espAdicional").value;
    dedicatorias = document.getElementsByName("dedicatoria");
    let i = 0
    for (; i < dedicatorias.length - 1; i++) {
        if (dedicatorias[i].value == "") {
            dedicatoria += "(Sin dedicatoria),";
        } else {
            dedicatoria += '(' + dedicatorias[i].value + '),';
        }
    }
    if (dedicatorias[i].value == "") {
        dedicatoria += "(Sin dedicatoria)";
    } else {
        dedicatoria += '(' + dedicatorias[i].value + ')';
    }
    cantidad_producto_carr = document.getElementById("cantidad").value;
    let myData = myAsyncFunction2(id_producto, cantidad_producto_carr, dedicatoria, carritoInfo, reqAdicional);
    myData.then(result => {
        if (result.usuario == "noIngresado") {
            MostrarMensaje("Por favor inicia sesión para poder ingresar productos al carrito");
        } else {
            if (carritoInfo == "Actualizar información") {
                window.location.href = "../vistas/CarritoDeCompras.php";
            } else {
                document.head.appendChild(estilo_aux_EnvíoACarrito);
                setTimeout(function () {
                    document.getElementById("est_EnvíoACarrito").remove();
                }, 2500);
            }
        }
    });
}
function MostrarVentanaDeIngreso() {
    const csrfToken = document.querySelector('meta[name="csrf-token1"]').getAttribute('content');
    const hiddenInput = document.createElement('input');
hiddenInput.type = 'hidden';
hiddenInput.name = '_token'; // Laravel expects the CSRF token to be sent in a "_token" POST parameter
hiddenInput.value = csrfToken;
salto.innerHTML = "";
salto.appendChild(hiddenInput);
    if (event.target.id != "RegresarAIngreso") {
        document.head.appendChild(estilo_Ingreso_Registro);
    }
    divVentana.innerHTML = `
    <div class="Formulario_Ingreso Ventana" id="VentanaFormulario">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir" class="boton">
                </div>
                <div action="" id="Ventana">
                    <h2 id="txt_ingreso">Ingresar</h2>
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="email" class="entrada_texto">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="clave" class="entrada_texto">
                    <div class="btnHaciaDerecha">
                        <input type="button" class="boton" id="contraseña_olvidada" value="¿Olvidaste tu contraseña?" onclick="MostrarVentanaRecuperación_Correo()">
                    </div>
                    <input type="hidden" name="registro" value="false" id="registro">
                    <button class="boton">Ingresar</button>
                    <div id="SinCuenta">
                        <label for="contraseña">¿No tienes una cuenta?</label>
                        <input type="button" class="boton" id="sin_cuenta" value="Registrarse">
                    </div>
                </div>
                </div>
    `;
    salto.appendChild(divVentana);
    divVentana.insertAdjacentHTML("beforebegin", `
    <div class="modal-backdrop" style="display: none;"></div>`);
    var backdrop = document.querySelector('.modal-backdrop');
    backdrop.style.display = backdrop.style.display === 'block' ? 'none' : 'block';
    document.querySelector(".rd-nav-link").style = "z-index: 0 !important;";
    document.getElementById("sin_cuenta").addEventListener('click', MostrarVentanaDeRegistro);
    document.getElementById("btn_salir").addEventListener('click', CerrarVentana);
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

//AQUI EMPIEZA LA VENTANA DE REGISTRO
function MostrarVentanaDeRegistro() {
    // Clear the innerHTML of the salto element
    const csrfToken = document.querySelector('meta[name="csrf-token1"]').getAttribute('content');
    const hiddenInput = document.createElement('input');
hiddenInput.type = 'hidden';
hiddenInput.name = '_token'; // Laravel expects the CSRF token to be sent in a "_token" POST parameter
hiddenInput.value = csrfToken;
salto.innerHTML = "";
salto.appendChild(hiddenInput);
    divVentana.innerHTML = `
    <div id="Ventana">
    <div class="btnHaciaDerecha">
        <input class="boton" type="button" value="✕" id="btn_salir">
    </div>
    <!-- Esta parte está modificada por que debía estar metido esto dentro de un form para usar un POST -->
    <div class="Formulario_Registro" id="Ventana">
        <h2>Registrarse</h2>
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="email" class="entrada_texto">
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="clave" class="entrada_texto">
        <label for="rep_contraseña">Repita la contraseña:</label>
        <input type="password" id="rep_contraseña" name="Rep_contraseña" class="entrada_texto">
        <!------LA FUNCIÓN runQuery está en el archivo script_Registro.js------>
        <input type="hidden" name="registro" value="false" id="registro">
        <button class="boton">Registrarse</button>
        <label for="RegresarAIngreso">¿Ya tienes una cuenta?</label>
        <input class="boton" type="button" value="Ingresar" id="RegresarAIngreso" onclick="MostrarVentanaDeIngreso()">
    </div>
</div>
    `;
    salto.appendChild(divVentana);
    // Reinsert the CSRF token back into the salto element
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
    document.getElementById("btn_salir").addEventListener('click', CerrarVentana);
    registro = document.getElementById("registro");
    registro.value = "true";
}

function MostrarVentanaRecuperación_Correo() {
    const csrfToken = document.querySelector('meta[name="csrf-token1"]').getAttribute('content');
    const hiddenInput = document.createElement('input');
hiddenInput.type = 'hidden';
hiddenInput.name = '_token'; // Laravel expects the CSRF token to be sent in a "_token" POST parameter
hiddenInput.value = csrfToken;
salto.innerHTML = "";
salto.appendChild(hiddenInput);
    divVentana.innerHTML = `
    <form id="Ventana" action="../php/confirmacion.php" method="POST" class="Recuperación">
        <div class="btnHaciaDerecha">
            <input type="button" value="✕" id="btn_salir"  onclick="CerrarVentana(event)">
        </div>
        <h2>RECUPERACIÓN DE CUENTA</h2>
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="Correo" class="entrada_texto">
        <button id="finalización_registro">Enviar código al correo</button>
        <div></div>
    </form>
    `;
    salto.appendChild(divVentana);
}

function MostrarMensajev2() {
    let mensaje = document.getElementById("mensaje").value;
    document.head.appendChild(estilo_Ingreso_Registro);
    salto.innerHTML = "";
    divVentana.innerHTML = `
    <form class="Mensaje" id="Ventana">
        <div class="btnHaciaDerecha">
            <input type="button" value="✕" id="btn_salir">
        </div>  
        <h2>Estimado usuario</h2>
        <p>`+ mensaje + `</p>
    </form>
    `;
    salto.appendChild(divVentana);
    document.getElementById("btn_salir").addEventListener('click', CerrarVentana);
}

function serializeElement(element) {
    const obj = {
        innerHTML: element.innerHTML,
        innerText: element.innerText,
        attributes: {}
    };
    for (let attr of element.attributes) {
        obj.attributes[attr.name] = attr.value;
    }
    return obj;
}

function storeElementsData(className) {
    const elements = document.getElementsByClassName(className);
    const dataToStore = Array.from(elements).map(element => serializeElement(element));
    const jsonString = JSON.stringify(dataToStore);
    localStorage.setItem("v1_datos_carrito", jsonString);
}
function convertDataFormat(oldData) {
    return oldData.map(item => {
        // Create a temporary DOM element to parse the HTML content
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = item.innerHTML;

        // Extracting data using querySelector and attribute values
        const imgSrc = tempDiv.querySelector('img')?.src || '';
        const masa = tempDiv.querySelector('p[name="masa"]')?.textContent.trim() || '';
        const sabor = tempDiv.querySelector('p[name="sabor"]')?.textContent.trim() || '';
        const relleno = tempDiv.querySelector('p[name="relleno"]')?.textContent.trim() || '';
        const cobertura = tempDiv.querySelector('p[name="cobertura"]')?.textContent.trim() || '';
        const precio = tempDiv.querySelector('p[name="precio"]')?.textContent.trim().replace('$', '') || '';
        const cantidad = tempDiv.querySelector('p[name="cantidad"]')?.textContent.trim() || '';
        const categoria = tempDiv.querySelector('input[name="categoria"]')?.value.trim() || '';
        // Constructing the new data format
        return {
            cantidad_cliente: cantidad,
            // Assuming default values for missing fields
            categoria: categoria,
            cobertura: cobertura,
            dedicatoria: null,
            especificacion_adicional: null,
            img: imgSrc,
            masa: masa,
            precio: precio,
            relleno: relleno,
            sabor: sabor
        };
    });
}

function AgregarContenidoCarrito() {
    storeElementsData("datos_carrito");
    let formato_correcto = JSON.stringify(convertDataFormat(JSON.parse(localStorage.getItem('v1_datos_carrito'))));
    localStorage.setItem("datos_carrito", formato_correcto);
}

function irAIndex() {
    window.location.href = "../vistas/Index.php";
}
function editarInfoProductoCarrito(event) {
    let enlaceImg = event.target.nextSibling.nextSibling.value;
    let string_dedicatorias = document.querySelector("p[name='dedicatoria']").innerHTML;
    const sin_parentesis_extremos = string_dedicatorias.replace(/^\(|\)$/g, "");
    const arreglo_dedicatorias = sin_parentesis_extremos.split("),(");
    reqAdicional = event.target.nextSibling.nextSibling.nextSibling.nextSibling.value;
    cantidadInput = document.querySelector("p[name='cantidad']").innerHTML;
    ProductoSeleccionado(event, enlaceImg, "si", cantidadInput, arreglo_dedicatorias, reqAdicional);
}
