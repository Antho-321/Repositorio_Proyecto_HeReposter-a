window.onload = AgregarImagen();
function AgregarImagen() {
    let direccion_producto, div, imagen, h3, a, x, ancho_imagen, alto_imagen;
    let section_productos = document.getElementById("seccion_productos");
    let num_productos = 8;
    for (let i = 1; i <= num_productos; i++) {
        div = document.createElement("div");
        imagen = document.createElement("img");
        h3 = document.createElement("h3");
        a = 15.0;
        x = document.body.getBoundingClientRect().width;
        ancho_imagen = (x - (5.0 * a)) / 4.0;
        alto_imagen = 0.8 * ancho_imagen;
        if (i <= 4) {
            direccion_producto = "https://i.pinimg.com/originals/c2/81/bf/c281bf4918c1ec9a981722e9330e2ba2.jpg";
        } else {
            direccion_producto = "../iconos/usuario.png";
        }
        imagen.src = direccion_producto;
        imagen.width = ancho_imagen;
        imagen.height = alto_imagen;
        imagen.style.paddingLeft = a + "px";
        imagen.style.paddingTop = (a / 2) + "px";
        h3.innerHTML = "Mostrar más información";
        div.appendChild(h3);
        h3.addEventListener("click", function () {
            //Se muestra la página: ActualizaciónDeProductos
        });
        div.appendChild(imagen);
        seccion_productos.appendChild(div);
    }
}