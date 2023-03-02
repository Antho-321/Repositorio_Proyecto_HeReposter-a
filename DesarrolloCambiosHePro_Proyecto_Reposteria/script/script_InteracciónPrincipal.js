let cantidadInput, precio_producto, num_productos, img, descripción_adicional, porciones, masa, cobertura, sabor, relleno, id_producto, cantidad_producto_carr, id_imagen, direccion_producto;
let left = 0;
let productos = [];
let lupa = document.getElementById("lupa");
let cuadro_búsqueda = document.getElementById("búsqueda");
let contenido_categorías = document.querySelector(".Menu_Catalogo");
let contenido_principal = document.getElementById("contenido_principal");
let seccion_productos = document.getElementById("seccion_productos");
let estilo = document.getElementById("estilo");
let estilo_Ingreso_Registro = document.createElement("style");
let estilo_aux_CategoríaSel = document.createElement("style");
let estilo_búsqueda = document.createElement("style");
let divVentana = document.createElement("div");
let salto = document.getElementById("Salto");
let ubicación_página=window.location.href;
let elemento;
divVentana.id = "VentanaForm";
estilo_búsqueda.id="estilo_búsqueda";
estilo_búsqueda.innerHTML=`
#búsqueda{
    width: 0px;
    border-color: black;
}
#seccion_busqueda{
    position: initial;
    z-index: 0;
}
`;
estilo_aux_CategoríaSel.innerHTML=`
#seccion_productos{
    padding-bottom: calc(70px - 2.5%);
}
`;
estilo_Ingreso_Registro.innerHTML = `
  #Contenido_Cabecera, #contenido_principal, footer{
    opacity: 0.5;
  }
  #Salto{
    background: #0000007a;
  }
#VentanaForm{
    width: 98.3vw;
    display: flex;
    justify-content: center;
}
#VentanaForm *{
    color: black;
}
#Ventana{
    background-color: aliceblue !important;  
    width: 550px;
    height: 75vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-radius: 7%;
}
#Ventana>*{
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
#Ventana>input, #SinCuenta>input, .btnHaciaDerecha>input {
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
`;
if (seccion_productos != null) {
    window.onload = AgregarContenido("");
}
console.log("PÁGINA EN LA QUE ME ENCUENTRO:"+ubicación_página);
console.log(ubicación_página.substring(ubicación_página.lastIndexOf("/")));
if (ubicación_página.substring(ubicación_página.lastIndexOf("/"))=="/CarritoDeCompras.php") {
    window.onload = AgregarContenidoCarrito();
}
if (contenido_categorías != null) {
    let tamaño = contenido_categorías.children.length;
    for (let i = 0; i < tamaño; i++) {
        contenido_categorías.children[i].addEventListener("click", funcCategoríaSeleccionada);
        //console.log(contenido_categorías.children[i]);
    }
}
function AgregarContenido(CategoríaSeleccionada) {
    seccion_productos = document.getElementById("seccion_productos");
    if (CategoríaSeleccionada == "") {
        let myData = myAsyncFunction("");

        myData.then(result => {
            console.log(result);

            let div_aux = document.createElement("div");
            for (let i = 0; i < result.length; i++) {
                let a = 15.0;
                let div = document.createElement("div");
                let imagen = document.createElement("img");
                let h3 = document.createElement("h3");
                imagen.src = result[i].Img;
                h3.innerHTML = "Mostrar más información";
                div.appendChild(h3);
                h3.addEventListener("click", ProductoSeleccionado);
                div.appendChild(imagen);
                div_aux.appendChild(div);
            }
            seccion_productos.appendChild(div_aux);
        }
        );
    } else {
        

if(CategoríaSeleccionada==" Navidad"){
CategoríaSeleccionada=CategoríaSeleccionada.substring(1);
}
let myData = myAsyncFunction(CategoríaSeleccionada);
        myData.then(result => {
            console.log(result);
            let div_aux = document.createElement("div");
            for (let i = 0; i < result.length; i++) {
                let a = 15.0;
                let div = document.createElement("div");
                let imagen = document.createElement("img");
                let h3 = document.createElement("h3");
                imagen.src = result[i].Img;
                imagen.style.paddingRight = a + "px";
                imagen.style.paddingTop = (a / 2) + "px";
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
    const encodedImagen = encodeURIComponent(imagen);
    return new Promise((resolve, reject) => {
        fetch("../php/ConsultaProductoSeleccionado.php?imagen=" + encodedImagen)
            .then(response => response.json())
            .then(data => { //archivo json       
                resolve(data);
            })
            .catch(error => reject(error));
    });
}
function myAsyncFunction2(id, cantidad) {
    return new Promise((resolve, reject) => {
        fetch("../php/ConsultaIngresoACarrito.php?&id="+id+"&cantidad="+cantidad)
        .then(data => { //archivo json       
            resolve(data);
        })
        .catch(error => reject(error));
    });
}

function myAsyncFunction3(id_usuario) {
    return new Promise((resolve, reject) => {
        fetch("../php/SacarDatosDeCarrito.php?id_usuario="+id_usuario)
            .then(response => response.json())
            .then(data => { //archivo json       
                resolve(data);
            })
            .catch(error => reject(error));
    });
}

function colorTextoANegro(event) {
    let entrada_texto = event.target;
    entrada_texto.style.color = "black";
    entrada_texto.placeholder="";
}
function disminuirCantidadProducto() {
    cantidadInput = document.getElementById("cantidad");
    if (cantidadInput.value >= 2) {
        cantidadInput.value = parseInt(cantidadInput.value) - 1;
    }
}
function aumentarCantidadProducto() {
    cantidadInput = document.getElementById("cantidad");
    cantidadInput.value = parseInt(cantidadInput.value) + 1;
}
function mostrarBúsqueda() {
    let est_búsqueda=document.getElementById("estilo_búsqueda");
    if (est_búsqueda!=null) {
        est_búsqueda.remove();
        cuadro_búsqueda.removeAttribute("style");
    }else{
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
function ProductoSeleccionado(event) {
    //console.log(event.target.nextSibling.src);
    let myData = myAsyncFunction(event.target.nextSibling.src);
    let div = document.getElementsByTagName("div");
    VerificaciónCuadroDeBúsqueda();
    estilo = document.getElementById("estilo");
    estilo.href = "../styles/estilo_Modificación_ProductoSeleccionado.css";
    img = event.target.nextSibling;
    myData.then(result => {
        console.log(result[0]);

        id_producto = result[0].Codigo;
        precio_producto = result[0].Precio;
        descripción_adicional = result[0].Descripción;
        porciones = result[0].Porciones;
        masa = result[0].Masa;
        cobertura = result[0].Cobertura;
        sabor = result[0].Sabor;
        relleno = result[0].Relleno;


        
        //------------------------------------------------------------------

        if (div[3].id != "Salto") {
            /*div[3].remove();*/
        }

        contenido_principal.innerHTML = `
            <div id="DestacadoPrincipal">
                <img src="`+ img.src + `" alt="imagenes">
                <p>$`+ precio_producto + `</p>
                <div id="seccion_cantidad">
                    <label for="cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
                    <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
                    <input type="number" id="cantidad" name="cantidad" value="1" readonly>
                    <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
                </div>
                <input type="button" value="Añadir al carrito" onclick="enviarInfoACarrito()">
            </div>
            <div id="infoDetallada">
                <p id="infoAdicional">`+ descripción_adicional + `</p>
                <div class="tabla_info">
                    <div class="fila">
                        <p class="col">Dedicatoria para el pedido:</p>
                        <input class="col" type="text" placeholder="Feliz Cumpleaños..." id="dedicatoria">
                    </div>
                    <div class="fila">
                        <p class="col">Porciones:</p>
                        <p class="col">`+ porciones + `</p>
                    </div>
                    <div class="fila">
                        <p class="col">Masa:</p>
                        <p class="col">`+ masa + `</p>
                        <p class="col">Cobertura:</p>
                        <p class="col">`+ cobertura + `</p>
                    </div>
                    <div class="fila">
                        <p class="col">Sabor:</p>
                        <p class="col">`+ sabor + `</p>
                        <p class="col">Relleno:</p>
                        <p class="col">`+ relleno + `</p>
                    </div>
                </div>
            </div>
            `;
        if (descripción_adicional == "") {
            document.getElementById("infoAdicional").remove();
        }
        document.getElementById("dedicatoria").addEventListener("click", colorTextoANegro);
    }
    );
}
function funcCategoríaSeleccionada(event) {
    VerificaciónCuadroDeBúsqueda();
    let título = event.target.value;
    let h1 = document.getElementsByTagName("h1")[0];
    let destacado_principal = document.getElementById("DestacadoPrincipal");
    seccion_productos = document.getElementById("seccion_productos");
    console.log("LO QUE SELECCIONÉ: "+event.target.value);
    document.head.appendChild(estilo_aux_CategoríaSel);
    if (destacado_principal != null) {
        destacado_principal.remove();
    }
    if (seccion_productos != null) {
        document.querySelector("#seccion_productos>div").remove();
    } else {
        contenido_principal.innerHTML = `
        <h1 align="center">`+título+`</h1>
        <section id="seccion_productos"></section>
        `;
        document.getElementById("estilo").href = "../styles/estilo_Modificación_Index.css";;
    }
    if (h1 == undefined) {
        h1 = document.getElementsByTagName("h1")[0];
    }
    h1.innerHTML = título;
    h1.align = "center";
    AgregarContenido(título);
}
function VerificaciónCuadroDeBúsqueda() {
    let est_búsqueda=document.getElementById("estilo_búsqueda");
    if (est_búsqueda!=null) {
        est_búsqueda.remove();
        cuadro_búsqueda.removeAttribute("style");
    }
}
function ProductosNoIngresados() {
    alert("NO SE HA INGRESADO PRODUCTOS");
}
function añadirBtnPago() {
    let scripts = document.getElementsByTagName("script");
    let btnFinPedido = document.getElementById("fin_pedido");
    let script = document.createElement("script");
    let contenedorBtnPaypal = document.createElement("div");
    contenedorBtnPaypal.id = "paypal-button-container";
    contenedorBtnPaypal.style.width = "25vw";
    script.src = "../script/script_FinalizaciónDePedido.js";
    btnFinPedido.insertAdjacentElement("afterend", contenedorBtnPaypal);
    contenedorBtnPaypal.insertAdjacentElement("afterend", script);
    btnFinPedido.remove();
    scripts[scripts.length - 1].remove();
}
function enviarInfoACarrito() {
    cantidad_producto_carr = document.getElementById("cantidad").value;
    //LA INFORMACIÓN QUE TENEMOS LA ENVIAMOS AL CARRITO
    //console.log("id: " + id_producto + "\n cantidad: " + cantidad_producto_carr + "\n img: " + img.src + "\n precio del producto: " + precio_producto + "\n descripción adicional: " + descripción_adicional + "\n porciones: " + porciones + "\n masa: " + masa + "\n cobertura: " + cobertura + "\n sabor: " + sabor + "\n relleno: " + relleno);
    let myData = myAsyncFunction2(id_producto,cantidad_producto_carr);
    myData.then(result => {
        console.log("Resultado: "+result[0]);
        //alert("teetetetst");
    });
}

//AQUI EMPIEZA LA VENTANA DE INGRESO 
function MostrarVentanaDeIngreso() {
    if (event.target.id != "RegresarAIngreso") {
        document.head.appendChild(estilo_Ingreso_Registro);
    }
    divVentana.innerHTML = `
            <form action="../php/Login.php" method="POST" class="Formulario_Ingreso" id="Ventana">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir" onclick="CerrarVentana()">
                </div>
                <form action="" id="Ventana">
                    <h2>Ingresar</h2>
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="Correo" class="entrada_texto">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="Contraseña" class="entrada_texto">
                    <div class="btnHaciaDerecha">
                        <input type="button" id="contraseña_olvidada" value="¿Olvidaste tu contraseña?" onclick="MostrarVentanaRecuperación_Correo()">
                    </div>
                    <button>Ingresar</button>
                    <div id="SinCuenta">
                        <label for="contraseña">¿No tienes una cuenta?</label>
                        <input type="button" id="sin_cuenta" value="Registrarse" onclick="MostrarVentanaDeRegistro()">
                    </div>
                </form>
            </div>
    `;
    salto.appendChild(divVentana);
}
//AQUI EMPIEZA LA VENTANA DE REGISTRO
function MostrarVentanaDeRegistro() {
    salto.innerHTML = "";
    divVentana.innerHTML = `
    <div id="Ventana">
    <div class="btnHaciaDerecha">
        <input type="button" value="✕" id="btn_salir" onclick="CerrarVentana()">
    </div>
    <!-- Esta parte está modificada por que debía estar metido esto dentro de un form para usar un POST -->
    <form action="../FINAL_TEST/enviar_correo.php" method="POST" class="Formulario_Registro" id="Ventana">
        <h2>Registrarse</h2>
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="Correo" class="entrada_texto">
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="Contraseña" class="entrada_texto">
        <label for="rep_contraseña">Repita la contraseña:</label>
        <input type="password" id="rep_contraseña" name="Rep_contraseña" class="entrada_texto">
        <!------LA FUNCIÓN runQuery está en el archivo script_Registro.js------>
        <!--PARA QUE FUNCIONE BIEN DEBES INICIAR EL MAMP E INGRESAR COMO LOCALHOST-->
        <button id="registro">Registrarse</button>
            <label for="RegresarAIngreso">¿Ya tienes una cuenta?</label>
            <input type="button" value="Ingresar" id="RegresarAIngreso" onclick="MostrarVentanaDeIngreso()">
        <script src="../script/script_Registro.js"></script>
    </form>
</div>
    `;
    salto.appendChild(divVentana);
}

function MostrarVentanaRecuperación_Correo() {
    salto.innerHTML = "";
    divVentana.innerHTML = `
    <form id="Ventana" action="../FINAL_TEST/confirmacion.php" method="POST" >
    <div class="btnHaciaDerecha">
        <input type="button" value="✕" id="btn_salir"  onclick="CerrarVentana(event)">
    </div>
    <h2>RECUPERACIÓN DE CUENTA</h2>
    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="Correo" class="entrada_texto">
    <button id="finalización_registro">Enviar contraseña al correo</button>
</form>
    `;
    salto.appendChild(divVentana);
}
function CerrarVentana() {
    let estilo_aux=document.getElementsByTagName("style")[1];
    salto.innerHTML = "";
    if (estilo_aux!=null || estilo_aux!=undefined) {
        estilo_aux.remove();
    }else{
        document.getElementsByTagName("style")[0].remove();
    }   
}
function AgregarContenidoCarrito() {
    let primera_fila=document.getElementById("primera_fila");
    let myData = myAsyncFunction3();
    myData.then(result => {
        console.log(result);
        console.log("longitud: "+result.length);
        if (result.length==0) {
            ProductosNoIngresados();
        }
        for(let i=0;i<result.length;i++){
            primera_fila.insertAdjacentHTML("afterend",`
        <form class="fila" action="../php/EliminarItemCarrito.php" method= "POST">
                        <div class="col" id="seccion_imagen">
                            <img src="`+result[i].Img+`" alt="Producto">
                        </div>            
                            <p class="col" name="masa">`+result[i].Masa+`</p>
                            <p class="col" name="sabor">`+result[i].Sabor+`</p>
                            <p class="col" name="relleno">`+result[i].Relleno+`</p>
                            <p class="col" name="cobertura">`+result[i].Cobertura+`</p>
                            <p class="col" name="precio">$`+result[i].Precio+`</p>
                            <p class="col" name="cantidad">`+result[i].Cantidad_Cliente+`</p>                   
                            <div class="col" id="seccion_eliminar">
                                <input type="hidden" name="id_canasta_item" value="`+result[i].Id_Canasta_item+`">
                                <button id="btn_eliminar" >◄</button>
                            </div>      
                    </form>
        `);
        }

    });
    
    

}