let dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg;
let ingreso_enlace = document.getElementById("ingreso_enlace");
estilo_txtImgNoValida = document.createElement("style");
estilo_noMasImg=document.createElement("style");
estilo_txtImgNoValida.id = "est_txtImgNoValida";
estilo_txtImgNoValida.innerHTML = `
#txtImgNoValida{
  visibility: visible;
}
`;
estilo_noMasImg.innerHTML=`
#txtDrop, #input2, #contenedorTxt{
  z-index: -1; 
  position: absolute; 
  color: white;
}
`;
Dropzone.autoDiscover = false;
const dropzone = new Dropzone("div#formDrop", {
  url: "../php/TEST.php",
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
      if (file.name.includes("http")) {
        dzSize = file.previewElement.querySelector(".dz-size");
        dzProgress = file.previewElement.querySelector(".dz-progress");
        previsualizacion = file.previewElement.querySelector("img");
        previsualizacion.src = file.name;
        previsualizacion.style = "width: 100%; height: 100%;";
        dzProgress.style = "display: none;";
        dzSize.style = "display: none;";
        ingreso_enlace.style = "z-index: -1;";
        this.options.maxFiles = 0;
        document.getElementById("aux_IngresarEnlace").value=file.name;
      } 
    });
  },
  renameFile: function (file) {
    let str1 = file.name;
    let str2 = str1.substring(str1.lastIndexOf("."));
    return "HOLA" + "_" + str2;
  }
});
dropzone.on("complete", function(file) {
  var ext = /(.jpg|.jpeg|.png|.gif)$/i;
  if (!ext.exec(file.name)) {
  
    console.log("El archivo no es una imagen válida"); // rechazar el archivo
    dropzone.removeFile(file);
  
  }
});
dropzone.on("success", (file, response) => {
  console.log(`Archivo subido con éxito: ${file.name}`);
  console.log(`Respuesta del servidor: ${response}`);
});
function ingresarEnlace() {
  ingreso_enlace.placeholder = "";
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
      }
    } catch (error) {
      reject(error);
    }
  });
}
function imgNoValida() {
  document.head.appendChild(estilo_txtImgNoValida);
}

