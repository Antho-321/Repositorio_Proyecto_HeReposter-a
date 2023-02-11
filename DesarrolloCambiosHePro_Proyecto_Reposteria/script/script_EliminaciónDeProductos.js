window.onload = AgregarImagen();
function AgregarImagen() {
    for (let i = 0; i < 8; i++) {
        let section_productos = document.getElementById("seccion_productos");
        let div = document.createElement("div");
        let imagen = document.createElement("img");
        let h3 = document.createElement("h3");
        let a = 10.0;
        let x = document.body.getBoundingClientRect().width;
        console.log(x);
        let ancho_imagen = (x - (5.0 * a)) / 4.0;
        let alto_imagen = 0.8 * ancho_imagen;
        imagen.src = "https://i.pinimg.com/originals/c2/81/bf/c281bf4918c1ec9a981722e9330e2ba2.jpg";
        imagen.width = ancho_imagen;
        imagen.height = alto_imagen;
        imagen.style.paddingLeft = a + "px";
        imagen.style.paddingTop = (a / 2) + "px";
        h3.innerHTML="Eliminar producto";
        div.appendChild(h3);
        div.appendChild(imagen);
        seccion_productos.appendChild(div);
    }
}