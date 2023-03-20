let dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg, cantidadInput, texto_dedicatoria;
let ingreso_enlace = document.getElementById("ingreso_enlace");
let contenido_previsualizacion = document.getElementById("contenido_previsualizacion");
estilo_txtImgNoValida = document.createElement("style");
estilo_noMasImg = document.createElement("style");
estilo_contenedorPreImg=document.createElement("style");
estilo_txtImgNoValida.id = "est_txtImgNoValida";
estilo_contenedorPreImg.id="est_contPreImg";
estilo_contenedorPreImg.innerHTML=`
#formDrop{
  border: 0px;
}
`;
estilo_txtImgNoValida.innerHTML = `
#txtImgNoValida{
  visibility: visible;
}
`;
estilo_noMasImg.innerHTML = `
#txtDrop, #input2, #contenedorTxt{
  z-index: -1; 
  position: absolute; 
  color: white;
}
`;
Dropzone.autoDiscover = false;
const dropzone = new Dropzone("div#formDrop", {
  url: "../php/IngresoImagenProducto.php",
  dictDefaultMessage: `<p id="txtDrop">Arrastra tu imagen, presiona aquí para subirla o ingresa su enlace:</p>
    <input type="url" placeholder="Ingresar enlace" id="input2">
    <div id="contenedorTxt">
      <p id="txtImgNoValida">Enlace no válido</p>
    <div>
    `,
  maxFiles: 1,
  init: function () {
    this.on("maxfilesexceeded", function (file) {
      this.removeFile(file);
      alert("¡Solo se puede subir un archivo!");
      document.head.appendChild(estilo_noMasImg);
    });
    this.on("sending", function (file, xhr, data) {

      ingreso_enlace = document.getElementById("ingreso_enlace");
      if (ingreso_enlace != undefined) {
        ingreso_enlace.remove();
      }
      data.append("type_chooser", "1");
    });
    this.on("addedfile", function (file) {
      if (file.name.includes("http")||file.name.includes("data:image")) {
        dzSize = file.previewElement.querySelector(".dz-size");
        dzProgress = file.previewElement.querySelector(".dz-progress");
        previsualizacion = file.previewElement.querySelector("img");
        previsualizacion.src = file.name;
        previsualizacion.style = "width: 100%; height: 100%;";
        dzProgress.style = "display: none;";
        dzSize.style = "display: none;";
        ingreso_enlace.style = "z-index: -1;";
        this.options.maxFiles = 0;
        document.getElementById("aux_IngresarEnlace").value = file.name;
      }
    });
  },
  renameFile: function (file) {
    let str1 = file.name;
    let str2 = str1.substring(str1.lastIndexOf("."));
    return "HOLA" + "_" + str2;
  }
});
dropzone.on("complete", function (file) {
  var ext = /(.jpg|.jpeg|.png|.gif)$/i;
  if (!ext.exec(file.name)) {

    console.log("El archivo no es una imagen válida"); // rechazar el archivo
    dropzone.removeFile(file);

  }
});
dropzone.on("addedfile", file => {
  let contenedor_preImg = document.querySelector(".dz-image");
  contenedor_preImg.style="width: 200px; height: 200px;";
  contenedor_preImg.parentNode.style="width: 200px; height: 200px; margin: 0px !important;";
  contenedor_preImg.children[0].style="width: 200px; height: 200px";
  document.head.appendChild(estilo_contenedorPreImg);
});
function quitarPlaceHolder(event) {
  let entrada_texto = event.target;
  entrada_texto.placeholder = "";
}
ingreso_enlace.addEventListener('input', () => {
  if (ingreso_enlace.value != "") {

    if (!esUrlValida(ingreso_enlace.value)) {
      imgNoValida();

    } else {

      esImagen1(ingreso_enlace.value).then((result) => {
        if (result) {
          enlaceImgVálido();
        } else {

          esImagen2(ingreso_enlace.value).then((result) => {

            if (result) {

              enlaceImgVálido();
            } else {
              imgNoValida();

            }
          });

        }
      });
    }
  } else {
    elem_estImgNoValido = document.getElementById("est_txtImgNoValida");
    if (elem_estImgNoValido != undefined) {
      elem_estImgNoValido.remove();
    }
  }
});
function enlaceImgVálido() {
  var file = { name: ingreso_enlace.value };
  dropzone.emit("addedfile", file);
  elem_estImgNoValido = document.getElementById("est_txtImgNoValida");
  if (elem_estImgNoValido != undefined) {
    elem_estImgNoValido.remove();
  }
}
function esUrlValida(url) {
  if (url.includes("data:image")) {
    return true;
  }
  const expresionRegular = /^(https?|http):\/\/[^\s/$.?#].[^\s]*$/i;
  return expresionRegular.test(url);
}
function esImagen1(url) {
  return new Promise((resolve, reject) => {
    try {
      const img = new Image();
      img.addEventListener('load', () => resolve(true));
      img.addEventListener('error', (error) => {
        resolve(false);
      });
      img.src = url;
    } catch (error) {
      reject(error);
    }
  });
}
function esImagen2(url) {
  return new Promise((resolve, reject) => {
    try {

      if (url.includes("url=")) {

        const splitUrl = url.split('&');
        const imgParam = splitUrl.find(param => param.startsWith('url='));
        const imgUrl = decodeURIComponent(imgParam.replace('url=', ''));
        const img = new Image();
        img.addEventListener('load', () => resolve(true));
        img.addEventListener('error', (error) => {
          resolve(false);
        });
        img.src = imgUrl;
      } else {
        imgNoValida();
      }
    } catch (error) {
      reject(error);
    }
  });
}
function imgNoValida() {
  document.head.appendChild(estilo_txtImgNoValida);
}
function disminuirCantidadProducto() {
  cantidadInput = document.getElementById("cantidad");
  if (cantidadInput.value >= 2) {
      cantidadInput.value = parseInt(cantidadInput.value) - 1;
  }
  if (cantidadInput.value==1) {
      texto_dedicatoria=document.getElementById("texto_dedicatoria");
      texto_dedicatoria.innerHTML="Dedicatoria para el pedido:";
  }
  Dedicatorias(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML=`
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria">
  `;
}
function aumentarCantidadProducto() {
  cantidadInput = document.getElementById("cantidad");
  cantidadInput.value = parseInt(cantidadInput.value) + 1;
  Dedicatorias(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML=`
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria">
  `;
}
function Dedicatorias(cantidadInput){
  opciones=document.getElementById("num_dedicatorias");
  html_aux1="";
  if (opciones!=null&&opciones!=undefined){
      opciones.remove();
  }
  texto_dedicatoria=document.getElementById("texto_dedicatoria");
  texto_dedicatoria.innerHTML="<b>Cantidad de dedicatorias:</b>";
  for(let i=0;i<cantidadInput.value;i++){
      html_aux1+='<option value="'+(i+1)+'">'+(i+1)+'</option>';
  }
  document.getElementById("contenedor_select").innerHTML=`
  <select id="num_dedicatorias" onchange="AgregarHermanosSelect()">
`+html_aux1+`
</select>`;

}
function AgregarHermanosSelect(arreglo_dedicatorias){
  console.log("ARREGLO DEDICATORIAS");
  console.log(arreglo_dedicatorias);
  let límite;
  let dedicatoria="";
  html_aux2="";
  dedicatorias=document.getElementsByName("dedicatoria");
  let select_dedicatorias=document.getElementById("num_dedicatorias");
  console.log("cantidad para agregar o quitar: "+(select_dedicatorias.value-dedicatorias.length));
  límite=select_dedicatorias.value-dedicatorias.length;
  if (select_dedicatorias.value-dedicatorias.length>=1) {     
      for(let i=1;i<=límite;i++){
          if (arreglo_dedicatorias==undefined) {
              html_aux2+='<input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria">';
          }else{
              console.log("i: "+i);
              if (arreglo_dedicatorias[i]!="Sin dedicatoria") {
                  dedicatoria=arreglo_dedicatorias[i];
              }else{
                  dedicatoria="";
              }
              html_aux2+='<input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" value="'+dedicatoria+'">';
          }
      }
      dedicatorias[dedicatorias.length-1].insertAdjacentHTML("afterend",html_aux2);
  }else{
      límite=límite*(-1);
      cuadros_dedicatoria=document.getElementById("cuadros_dedicatoria");
      console.log("límite: "+límite);
      for (let i=1;i<=límite;i++) {
          cuadros_dedicatoria.children[cuadros_dedicatoria.children.length-1].remove();
      }
      //cuadros_dedicatoria.children[cuadros_dedicatoria.children.length-1].remove();
  }
      for (let i=0;i<dedicatorias.length;i++) {
          dedicatorias[i].addEventListener("click", quitarPlaceHolder);
      }
}
function opciones(event){

}