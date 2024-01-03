let producto;
let estilo_Ingreso_Registro = document.createElement("style");
let div_aux2=document.getElementById("Salto");
estilo_Ingreso_Registro.innerHTML = `
  body>div>h1, #seccion_productos {
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
#Ventana{
    background-color: aliceblue !important;  
    width: 550px;
    height: 75vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-radius: 30px;
    z-index: 1;
}
.Mensaje{
    height: auto !important;
}
.Recuperación{
    height: 58vh !important;
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
#Ventana>input, #SinCuenta>input, .btnHaciaDerecha>input, #Ventana>button {
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
window.onload = AgregarContenido("");
function AgregarContenido(CategoríaSeleccionada) {
    seccion_productos = document.getElementById("seccion_productos");
    //let div, imagen, h3, a;
    //let div_aux = document.createElement("div");
// Seleccionar el input oculto por su nombre
let input = document.getElementById("pasteles");
// Obtener el valor del input, que es una cadena JSON
let value = input.value;
// Convertir la cadena JSON en un array de javascript
let array = JSON.parse(value);
// Mostrar el contenido del array en la consola
console.log(array);


        
        let div_aux = document.createElement("div");
        //console.log(Object.keys(result).length);
        for (let i = 0; i < array.length; i++) {
            let a = 15.0;
            let div = document.createElement("div");
            let imagen = document.createElement("img");
            let h3 = document.createElement("h3");
            imagen.src = array[i].img;
            imagen.style.paddingRight = a + "px";
            imagen.style.paddingTop = (a / 2) + "px";
            h3.innerHTML = "Seleccionar producto";
            div.appendChild(h3);
            h3.addEventListener("click", ProductoSeleccionado);
            div.appendChild(imagen);
            div_aux.appendChild(div);
        }

        seccion_productos.appendChild(div_aux);
   
}
function myAsyncFunction(imagen) {
    let encodedImagen;
    if (imagen.includes("http")){
        encodedImagen = encodeURIComponent(imagen);
    }else{
        encodedImagen=imagen;
    }
    return new Promise((resolve, reject) => {
        fetch("../php/php_EliminacionDeproducto.php?imagen=" + encodedImagen)
            .then(response => response.json())
            .then(data => { //archivo json       
                resolve(data);
            })
            .catch(error => reject(error));
    });
}
function ProductoSeleccionado(event) {
    document.head.appendChild(estilo_Ingreso_Registro);
    producto=event.target.nextSibling.src;
    div_aux2.innerHTML=`
    <div class="Mensaje" id="Ventana">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir" onclick="CerrarVentana()">
                </div>  
                    <h2>¿Eliminar producto?</h2>
                    <div id="botones">
                    <button id="finalización_registro" onclick="eliminarProducto()">Aceptar</button>
                    <button id="finalización_registro" onclick="CerrarVentana()">Cancelar</button>
                    <div>
                    
            </div>
    `;  
}
function eliminarProducto(){
    const srcString = producto;
        if (srcString.includes("imagenes")) {
            let dirImg;
            let num=srcString.indexOf("/imagenes");
            dirImg=".."+srcString.substring(num);
            myData=myAsyncFunction(dirImg);
        }else{
            myData = myAsyncFunction(producto);
        }
    myData.then(result => {
        console.log(result);
    });
    window.location.href = "/InicioAdministración";

}
function CerrarVentana() {
    let estilo_aux = document.getElementsByTagName("style")[1];
    div_aux2.innerHTML = "";
    if (estilo_aux != null || estilo_aux != undefined) {
        estilo_aux.remove();
    } else {
        document.getElementsByTagName("style")[0].remove();
    }
}