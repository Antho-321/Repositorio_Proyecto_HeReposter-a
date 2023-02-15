
window.onload = AgregarContenido("");

function AgregarContenido(CategoríaSeleccionada) {
    seccion_productos = document.getElementById("seccion_productos");
    //let div, imagen, h3, a;
    //let div_aux = document.createElement("div");
    if (CategoríaSeleccionada == "") {
        num_productos = 12;
    } else {
        /* 
        ---------------------------------------------------------------------------------------------
            num_productos sería el resultado de la consulta:
        ---------------------------------------------------------------------------------------------
            SELECT COUNT(*) FROM producto WHERE Categoría=CategoríaSeleccionada;
        ---------------------------------------------------------------------------------------------
            EL SIGUIENTE CÓDIGO ES SOLO DE PRUEBA:        
        */
        num_productos = 4;
    }

    //for (let i = 1; i <= num_productos; i++) {

    //div = document.createElement("div");
    //imagen = document.createElement("img");
    //h3 = document.createElement("h3");
    //a = 15.0;
    //x = document.body.getBoundingClientRect().width;
    if (CategoríaSeleccionada == "") {

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
                SELECT Codigo INTO result
                FROM venta
                ORDER BY Cantidad DESC
                LIMIT N, 1;
                RETURN result;
            END$$
            DELIMITER ;
        ---------------------------------------------------------------------------------------------
            EL valor de la variable direccion_producto sería el resultado de la consulta:
        ---------------------------------------------------------------------------------------------
            SELECT `Img` FROM producto WHERE `Codigo`=enésimo_producto_más_repetido(i);
        ---------------------------------------------------------------------------------------------
            EL SIGUIENTE CÓDIGO ES SOLO DE PRUEBA:    
        */

        //LA CONSULTA SE ENCUENTRA EN EL ARCHIVO runQuery.php
        //PARA ENVIAR UNA VARIABLE SOLO AGREGAMOS A "../php/runQuery.php LA LÍNEA: ?variable="+variable

        //direccion_producto = "../imagenes/21.png";
    } else {
        /* 
        ---------------------------------------------------------------------------------------------
            EL valor de la variable direccion_producto sería el resultado de la consulta:
        ---------------------------------------------------------------------------------------------
            direccion_producto=SELECT Ruta_Imagen FROM producto WHERE Categoría=CategoríaSeleccionada LIMIT i-1, 1;
            NOTA: PARA LA CONSULTA, ALADO DE LIMIT DEBE ESTAR UN NÚMERO ESPECÍFICO, ES DECIR, EL RESULTADO DE i-1
        ---------------------------------------------------------------------------------------------
            EL SIGUIENTE CÓDIGO ES SOLO DE PRUEBA:     
        */
        if (CategoríaSeleccionada == "Cumpleaños") {
            direccion_producto = "https://d320djwtwnl5uo.cloudfront.net/recetas/share/share_fsr8al91ct_confeti.jpg";
        } else {
            direccion_producto = "https://cdn0.bodas.com.mx/article-real-wedding/799/3_2/1280/jpg/1466243.webp";
        }
    }

    let myData = myAsyncFunction();

    myData.then(result => {
        console.log(result);
        
        let div_aux = document.createElement("div");
        //console.log(Object.keys(result).length);
        for (let i = 0; i < Object.keys(result).length; i++) {
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

    )
}
function myAsyncFunction() {
    let num=2;
    return new Promise((resolve, reject) => {
        fetch("../php/Consulta_EliminaciónDeProductos.php")
            .then(response => response.json())
            .then(data => { //archivo json       
                resolve(data);
            })
            .catch(error => reject(error));
    });
}
function ProductoSeleccionado(event) {
    let div = document.getElementsByTagName("div");
    producto_seleccionado = true;
    estilo = document.getElementById("estilo");
    estilo.href = "../styles/estilo_ProductoSeleccionado.css";
    img = event.target.nextSibling;
    
    //-------------LO QUE SE VA A OBTENER DE LA BASE DE DATOS A PARTIR DEL LINK DE LA IMAGEN SELECCIONADA-----------
    id_producto = 1;
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
                        <input class="col" type="text" value="Feliz Cumpleaños..." id="dedicatoria">
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
function colorTextoANegro(event) {
    let entrada_texto = event.target;
    entrada_texto.style.color = "black";
    console.log(entrada_texto.value);
    if (entrada_texto.value == "Ingresar enlace") {
      entrada_texto.value = "";
    }
  }
  