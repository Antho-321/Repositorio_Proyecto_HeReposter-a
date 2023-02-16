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

    let myData = myAsyncFunction("");

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
function myAsyncFunction(imagen) {
    const encodedImagen = encodeURIComponent(imagen);
    return new Promise((resolve, reject) => {
        fetch("../php/php_EliminacionDeproducto.php?imagen=" + encodedImagen)
            .then(response => response.json())
            .then(data => { //archivo json       
                resolve(data);
            })
            .catch(error => reject(error));
    });
}
function myAsyncFunction2(imagen) {
    const encodedImagen = encodeURIComponent(imagen);
    return new Promise((resolve, reject) => {
        fetch("../php/php_EliminacionDeproducto.php?imagen=" + encodedImagen);
    });
}
function ProductoSeleccionado(event) {
    let myData = myAsyncFunction2(event.target.nextSibling.src);
    let div = document.getElementsByTagName("div");
    producto_seleccionado = true;
    img = event.target.nextSibling;
    location.reload();
}