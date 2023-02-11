let cantidadInput, precio_producto, num_productos, img, descripción_adicional, porciones, masa, cobertura, sabor, relleno, id_producto, cantidad_producto_carr;
let left = 0;
let productos = [];
let lupa = document.getElementById("lupa");
let cuadro_búsqueda = document.getElementById("búsqueda");
let contenido_categorías = document.querySelector(".Menu_Catalogo");
let contenido_principal = document.getElementById("contenido_principal");
let seccion_productos = document.getElementById("seccion_productos");
let estilo = document.getElementById("estilo");
let estilo_Ingreso_Registro=document.createElement("style");
let productos_ingresados=true;
let divVentanaIngreso = document.createElement("div");
let divVentanaRegistro = document.createElement("div");
let salto = document.getElementById("Salto");
divVentanaRegistro.id="VentanaDeRegistro";
divVentanaIngreso.id="VentanaDeIngreso";
estilo_Ingreso_Registro.innerHTML=`
body {
    opacity: 0.77 !important;
  }
  header *{
    opacity: 0.77 !important;
  }
#VentanaDeIngreso, #VentanaDeRegistro{
    opacity: 1 !important;
    width: 100%;
    
    display: flex;
    justify-content: center;

    position: absolute;
    
    z-index: 5;
}
#VentanaDeIngreso *, #VentanaDeRegistro *{
    opacity: 1 !important;
    z-index: 5;
    color: black;
}
#Ventana{
    opacity: 1 !important;
    background-color: aliceblue !important;  
    width: 50vw;
    height: 75vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-radius: 7%;
}
#Ventana>*{
    opacity: 1 !important;
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
if (seccion_productos!=null) {
    window.onload = AgregarContenido("");
}
if (contenido_categorías!=null) {
    let tamaño = contenido_categorías.children.length;
    for (let i = 0; i < tamaño; i++) {
        contenido_categorías.children[i].firstChild.addEventListener("click", funcCategoríaSeleccionada);
    }
}
function AgregarContenido(CategoríaSeleccionada) {
    seccion_productos = document.getElementById("seccion_productos");
    let direccion_producto, div, imagen, h3, a;    
    let div_aux = document.createElement("div");
    if (CategoríaSeleccionada=="") {
        num_productos = 12;
    }else{
        /* 
        ---------------------------------------------------------------------------------------------
            num_productos sería el resultado de la consulta:
        ---------------------------------------------------------------------------------------------
            SELECT COUNT(*) FROM producto WHERE Categoría=CategoríaSeleccionada;
        ---------------------------------------------------------------------------------------------
            EL SIGUIENTE CÓDIGO ES SOLO DE PRUEBA:        
        */
        num_productos=4;
    }
    
    for (let i = 1; i <= num_productos; i++) {
        div = document.createElement("div");
        imagen = document.createElement("img");
        h3 = document.createElement("h3");
        a = 15.0;
        x = document.body.getBoundingClientRect().width;
        if (CategoríaSeleccionada=="") {

            /*
            ---------------------------------------------------------------------------------------------
                EN PRIMER LUGAR, EN PHPMYADMIN HABRÍA QUE DECLARAR LA FUNCIÓN:
            ---------------------------------------------------------------------------------------------
                DELIMITER $$
                CREATE FUNCTION enésimo_producto_más_repetido(N INT)
                RETURNS INT
                BEGIN
                    DECLARE result INT;
                    SET N = N - 1;
                    SELECT ID_Producto INTO result
                    FROM venta
                    ORDER BY Cantidad DESC
                    LIMIT N, 1;
                    RETURN result;
                END$$
                DELIMITER ;
            ---------------------------------------------------------------------------------------------
                EL valor de la variable direccion_producto sería el resultado de la consulta:
            ---------------------------------------------------------------------------------------------
                SELECT Ruta_Imagen FROM producto WHERE ID_Producto=enésimo_producto_más_repetido(i);
            ---------------------------------------------------------------------------------------------
                EL SIGUIENTE CÓDIGO ES SOLO DE PRUEBA:    
            */
            direccion_producto = "../imagenes/Key.png";
        }else{
            /* 
            ---------------------------------------------------------------------------------------------
                EL valor de la variable direccion_producto sería el resultado de la consulta:
            ---------------------------------------------------------------------------------------------
                SELECT Ruta_Imagen FROM producto WHERE Categoría=CategoríaSeleccionada LIMIT i-1, 1;
                NOTA: PARA LA CONSULTA, ALADO DE LIMIT DEBE ESTAR UN NÚMERO ESPECÍFICO, ES DECIR, EL RESULTADO DE i-1
            ---------------------------------------------------------------------------------------------
                EL SIGUIENTE CÓDIGO ES SOLO DE PRUEBA:     
            */
            if (CategoríaSeleccionada=="Cumpleaños") {
                direccion_producto = "https://d320djwtwnl5uo.cloudfront.net/recetas/share/share_fsr8al91ct_confeti.jpg";
            }else{
                direccion_producto = "https://cdn0.bodas.com.mx/article-real-wedding/799/3_2/1280/jpg/1466243.webp";
            } 
        }      
        imagen.src = direccion_producto;
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
function colorTextoANegro() {
    let entrada_texto = document.querySelector("input[value='Feliz Cumpleaños...']");
    entrada_texto.style.color = "black";
    if (entrada_texto.value == "Feliz Cumpleaños...") {
        entrada_texto.value = "";
    }
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
function mostrarBúsqueda(lupa) {
    console.log(lupa.nextElementSibling);
    let width = 0;
    cuadro_búsqueda.type = "search";
    cuadro_búsqueda.style.width = "0px";    
    const intervalId = setInterval(function () {
        if(width==0){
            lupa.nextElementSibling.style.display="initial";
        }
        width += 1;
        cuadro_búsqueda.style.width = width + "px";
        if (width >= 120) {
            clearInterval(intervalId);
        }
    }, 0.01);
}
function ProductoSeleccionado(event) {
    let div = document.getElementsByTagName("div");
    VerificaciónCuadroDeBúsqueda();
    estilo = document.getElementById("estilo");
    estilo.href = "../styles/estilo_ProductoSeleccionado.css";
    img = event.target.nextSibling;
    //-------------LO QUE SE VA A OBTENER DE LA BASE DE DATOS A PARTIR DEL LINK DE LA IMAGEN SELECCIONADA-----------
    id_producto=1;
    precio_producto = 20;
    descripción_adicional = "Descripción adicional (en caso de existir)";
    porciones = "10-12";
    masa = "Bizcochuelo";
    cobertura = "Crema";
    sabor = "Naranja";
    relleno = "Mermelada de mora";
    //------------------------------------------------------------------

    if (div[3].id != "Salto") {
        div[3].remove();
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
                        <input class="col" type="text" value="Feliz Cumpleaños..." onclick="colorTextoANegro()">
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
            if (descripción_adicional==""){
                document.getElementById("infoAdicional").remove();
            }
}
function funcCategoríaSeleccionada(event) {
    VerificaciónCuadroDeBúsqueda();
    let título = event.target.innerHTML;
    let h1 = document.getElementsByTagName("h1")[0];
    let destacado_principal = document.getElementById("DestacadoPrincipal");
    seccion_productos = document.getElementById("seccion_productos");
    if (destacado_principal!=null) {
        destacado_principal.remove();
    }   
    if (seccion_productos!=null) {
        document.querySelector("#seccion_productos>div").remove();
    }else{
        contenido_principal.innerHTML=`
        <h1 align="center">Bodas</h1>
        <section id="seccion_productos"></section>
        `;
        document.getElementById("estilo").href="../styles/estilo_Index.css";;
    }
    if (h1==undefined) {
        h1 = document.getElementsByTagName("h1")[0];
    }
    h1.innerHTML = título;
    h1.align="center";
    AgregarContenido(título);
}
function VerificaciónCuadroDeBúsqueda(){
    let seccion_busqueda=document.getElementById("seccion_busqueda");
    if (seccion_busqueda.style.display!="none"){
        seccion_busqueda.style.display="none";
    }
}
if (productos_ingresados==false) {
    let contenido_principal = document.getElementById("contenido_principal");
    let seccionIzq = document.getElementById("Productos");
    let seccionDer = document.getElementById("Info_adicional");
    let cabecera = document.getElementById("Cabecera");
    salto = document.getElementById("Salto");
    let estilo = document.createElement("style");
    let footer = document.getElementsByTagName("footer")[0];
    estilo.innerHTML=`
    #contenido_principal {
        height: calc(100vh - `+cabecera.offsetHeight+`px - `+salto.offsetHeight+`px - `+footer.offsetHeight+`px);
        align-items: center;
        justify-content: center;
    }
    /*
    MÁS ESTILO
    */
    `;
    seccionIzq.remove();
    seccionDer.remove();
    contenido_principal.innerHTML=`
    <h1>No se ha ingresado productos</h1>
    `;
    document.head.appendChild(estilo);
}
function añadirBtnPago() {
    let scripts = document.getElementsByTagName("script");
    let btnFinPedido = document.getElementById("fin_pedido");
    let script = document.createElement("script");
    let contenedorBtnPaypal = document.createElement("div");
    contenedorBtnPaypal.id="paypal-button-container";
    contenedorBtnPaypal.style.width="25vw";
    script.src="../script/script_FinalizaciónDePedido.js";
    btnFinPedido.insertAdjacentElement("afterend",contenedorBtnPaypal);
    contenedorBtnPaypal.insertAdjacentElement("afterend",script);
    btnFinPedido.remove();
    scripts[scripts.length-1].remove();
}
function enviarInfoACarrito(){ 
    cantidad_producto_carr=document.getElementById("cantidad").value;
    //LA INFORMACIÓN QUE TENEMOS LA ENVIAMOS AL CARRITO
    console.log("id: "+id_producto+"\n cantidad: "+cantidad_producto_carr+"\n img: "+img.src+"\n precio del producto: "+precio_producto+"\n descripción adicional: "+descripción_adicional+"\n porciones: "+porciones+"\n masa: "+masa+"\n cobertura: "+cobertura+"\n sabor: "+sabor+"\n relleno: "+relleno);
    /*
    INSERT INTO carrito (id_carrito, id_producto, id_usuario, Cantidad, Subtotal)
    SELECT id_producto, id_usuario, cantidad_producto_carr
    */
}
//AQUI EMPIEZA LA VENTANA DE INGRESO 
function MostrarVentanaDeIngreso(){  
    if (event.target.id == "Ingreso"){
        if(divVentanaIngreso.style.display=="none"){
            divVentanaIngreso.style.display="";
        }
        document.head.appendChild(estilo_Ingreso_Registro);
    divVentanaIngreso.innerHTML=`
            <form action="../php/Login.php" method="POST" class="Formulario_Ingreso" id="Ventana">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir" onclick="CerrarVentanaIngreso()">
                </div>
                <form action="" id="Ventana">
                    <h2>Ingresar</h2>
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="Correo" class="entrada_texto">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="Contraseña" class="entrada_texto">
                    <div class="btnHaciaDerecha">
                        <input type="button" id="contraseña_olvidada" value="¿Olvidaste tu contraseña?">
                    </div>
                    <button>Ingresar</button>
                    <div id="SinCuenta">
                        <label for="contraseña">¿No tienes una cuenta?</label>
                        <input type="button" id="sin_cuenta" value="Registrarse" onclick="MostrarVentanaDeRegistro()">
                    </div>
                </form>
            </div>
    `;
    salto.appendChild(divVentanaIngreso);
    }
    
}
//AQUI EMPIEZA LA VENTANA DE REGISTRO
function MostrarVentanaDeRegistro(){
    document.getElementById("VentanaDeIngreso").remove();  
    divVentanaRegistro.innerHTML=`
    <div id="Ventana">
    <div class="btnHaciaDerecha">
        <input type="button" value="✕" id="btn_salir" onclick="CerrarVentanaRegistro()">
    </div>
    <!-- Esta parte está modificada por que debía estar metido esto dentro de un form para usar un POST -->
    <form action="../html/2daVentanaDeRegistro.php" method="POST" class="Formulario_Registro" id="Ventana">
        <h2>Registrarse</h2>
        <div class="campos_adicionales">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="Cedula">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="Nombre">
        </div>
        <div class="campos_adicionales">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="Apellido">
            <label for="dirección">Dirección:</label>
            <input type="text" id="dirección" name="Direccion">
        </div>
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="Correo" class="entrada_texto">
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="Contraseña" class="entrada_texto">
        <label for="rep_contraseña">Repita la contraseña:</label>
        <input type="password" id="rep_contraseña" name="Rep_contraseña" class="entrada_texto">
        <!------LA FUNCIÓN runQuery está en el archivo script_Registro.js------>
        <!--PARA QUE FUNCIONE BIEN DEBES INICIAR EL MAMP E INGRESAR COMO LOCALHOST-->
        <button id="registro">Registrarse</button>
        <script src="../script/script_Registro.js"></script>
    </form>
</div>
    `;
    salto.appendChild(divVentanaRegistro);
}

function CerrarVentanaIngreso(){
    console.log(document.getElementsByTagName("style")[0]);
    let aux=document.getElementById("operaUserStyle");
    if (aux!=null&&aux!=undefined) {
        aux.remove();
    }
    document.getElementsByTagName("style")[0].remove();
    document.getElementById("VentanaDeIngreso").remove();
}
function CerrarVentanaRegistro(){
    document.getElementsByTagName("style")[0].remove();
    document.getElementById("VentanaDeRegistro").remove();
}

const nodemailer = require('nodemailer');

// Crear un transportador de Gmail
let transporter = nodemailer.createTransport({
    host: 'smtp.gmail.com',
    port: 465,
    secure: true,
    auth: {
        type: 'OAuth2',
        user: 'anthonyluisluna225@gmail.com',
        clientId: '584701648639-lkdkq6he7o3bg1df3eelk6iu7oujen08.apps.googleusercontent.com',
        clientSecret: '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',
        refreshToken: 'https://oauth2.googleapis.com/token'
    }
});

// Definir la información del correo electrónico
let mailOptions = {
    from: 'anthonyluisluna225@gmail.com',
    to: 'gvillotasarzona@gmail.com',
    subject: 'Prueba',
    text: 'Código 12345',
    html: '<p>Mensaje HTML</p>'
};

// Enviar el correo electrónico
transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
        console.log(error);
    } else {
        console.log('Correo electrónico enviado: ' + info.response);
    }
});