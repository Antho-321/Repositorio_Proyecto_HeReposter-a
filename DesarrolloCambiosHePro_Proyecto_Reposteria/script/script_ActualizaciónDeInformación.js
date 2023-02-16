
window.onload = AgregarContenido("");
function enlaceIngresado() {
    document.querySelector("label[for='ingreso_enlace']").remove();
    document.getElementById("file-input").remove();
  }
  function archivoIngresado() {
    document.querySelector("label[for='ingreso_enlace']").remove();
    document.getElementById("ingreso_enlace").remove();
  }
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
    estilo = document.getElementById("estilo");
    estilo.href = "../styles/estilo_IngresoDeProductos.css";
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

    document.getElementsByTagName("body")[0].innerHTML = `
    <h1 align="center">Ingreso de productos</h1>
    <form id="form" method='POST' enctype="multipart/form-data" action="../php/php_IngresoDeProductos.php">
        <section id="seccion_principal">
            <div id="seccion__Izq">
                <div>
                    <div class="fila">
                        <label class="col" for="lista_categoría">Categoría:</label>
                        <select name="lista_categoría" id="lista_categoría" class="col">
                            <option value="Bodas">Bodas</option>
                            <option value="Bautizos">Bautizos</option>
                            <option value="XV_años">XV años</option>
                            <option value="Cumpleaños">Cumpleaños</option>
                            <option value="Baby_Shower">Baby Shower</option>
                            <option value="San_Valentin">San Valentin</option>
                            <option value="Vísperas_de_Santos">Vísperas de Santos</option>
                            <option value="Navidad">Navidad</option>
                        </select>
                    </div>

                    <div class="fila">
                        <label class="col" for="ingresoArchivo">Imagen:</label>
                        <input class="col" type="file" id="file-input" name="archivo">
                        <label class="col" for="ingreso_enlace">o</label>
                        <input class="col" type="url" value="Ingresar enlace" id="ingreso_enlace" onchange="enlaceIngresado()">
                    </div>

                </div>
                <div class="tabla_info">
                    <div class="fila">
                        <p class="col">Forma:</p>
                        <div class="col">
                            <input class="col" type="radio" id="red" onchange="opcionesPastel(event)" name="forma">
                            <label for="red">Redonda</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="cuad" onchange="opcionesPastel(event)" name="forma">
                            <label for="cuad">Cuadrada</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="rec" onchange="opcionesPastel(event)" name="forma">
                            <label for="rec">Rectangular</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="per" onchange="opcionesPastel(event)" name="forma">
                            <label for="per">Personalizada</label>
                        </div>
                    </div>                   
                </div>
                
            </div>
            <div id="seccion__Der">
                <h2>Previsualización de producto:</h2>
                <img alt="Imagen de pastel" id="image-preview" src=`+img.src+`>
            </div>
        </section>
        <input type="hidden" name='formulario'>
        <div id="seccion_btn">
            <input type="submit" value="Añadir producto">
        </div>
    </form>

            `;
    if (descripción_adicional == "") {
        document.getElementById("infoAdicional").remove();
    }
}
function colorTextoANegro(event) {
    let entrada_texto = event.target;
    entrada_texto.style.color = "black";
    console.log(entrada_texto.value);
    if (entrada_texto.value == "Ingresar enlace") {
      entrada_texto.value = "";
    }
  }
  