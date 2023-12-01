let ingreso_enlace1 = document.getElementById("enlace1");
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.currentSrc); // esta línea ha cambiado
    ev.dataTransfer.setDragImage(ev.target, 0, 0);
}

// front_controller.js
function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var img = document.createElement("img");
    img.src = data;
    //let myData = myAsyncFunction(data);
    //myData.then(result => console.log(result.enlace));
    
    //console.log(data);
    ev.target.appendChild(img);
} 

Dropzone.autoDiscover = false;
formDrop1 = configurarDropZone(ingreso_enlace1, "");
dropzone1 = new Dropzone("div#formDrop", formDrop1);
ingreso_enlace1.addEventListener('input', () => {
  validaciónIngresoEnlace(ingreso_enlace1, dropzone1);
});
function configurarDropZone(ingreso_enlace, imagenAdicional) {
  let str_aux = imagenAdicional;
  switch (imagenAdicional) {
    case "DibujoImgEspecial":
      imagenAdicional = "?DibujoImgEspecial=" + str_aux;
      break;
    case "Figura":
      imagenAdicional = "?Figura=" + str_aux;
      break;
    case "Adorno":
      imagenAdicional = "?Adorno=" + str_aux;
      break;
  }
  return {
    url: "../php/IngresoImagenProducto.php" + imagenAdicional,
    dictDefaultMessage: `<p id="txtDrop">Arrastra tu imagen, presiona aquí para subirla o ingresa su enlace:</p>
    <input type="url" placeholder="Ingresar enlace" id="input2" style="visibility: hidden">
    <div id="contenedorTxt">
      <p class="txtImgNoValida">Enlace no válido</p>
    <div>
    `,
    acceptedFiles: ".jpg,.jpeg,.png,.gif,.webp",
    maxFiles: 1,
    init: function () {
      this.on("maxfilesexceeded", function (file) {
        this.removeFile(file);
        alert("¡Solo se puede subir un archivo!");
        if (imagenAdicional == "") {
          document.getElementsByClassName("dz-default dz-message")[0].style = "display:none";
        }
        document.head.appendChild(estilo_noMasImg);
      });
      this.on("addedfile", function (file) {
        
        contenedor_preImg = file.previewElement.getElementsByClassName("dz-image")[0];
        dzSize = file.previewElement.getElementsByClassName("dz-size")[0];
        dzProgress = file.previewElement.getElementsByClassName("dz-progress")[0];
        previsualizacion = file.previewElement.getElementsByTagName("img")[0];
        contenedor_preImg.style = "width: 222px; height: 200px; z-index: 1;";
        contenedor_preImg.parentNode.style = "width: 222px; height: 200px; margin: 0px !important; z-index: 1;";
        contenedor_preImg.children[0].style = "width: 222px; height: 200px";
        document.head.appendChild(estilo_contenedorPreImg);
        previsualizacion.style = "width: 100%; height: 100%;";
        dzProgress.style = "display: none;";
        dzSize.style = "display: none;";
        dzSize.parentElement.style = "z-index: 1;";
        if (imagenAdicional == "") {
          if (this.options.maxFiles == 1) {
            AgregarMásContenido();
          }
        }
        
        
      });
      this.on("success", function (_file, _response) {
        ingreso_enlace.style = "z-index: -1;";
      });
      this.on("complete", function (file) {
        if (previsualizacion.src.includes("http") || previsualizacion.src.includes("data:image")) {
          this.options.maxFiles = 0;
          if (imagenAdicional != "") {
            document.getElementsByClassName("aux_IngresarEnlace")[1].value = file.name;
          } else {
            document.getElementsByClassName("aux_IngresarEnlace")[0].value = file.name;
          }
        }else{
          let myData = ultimaImgIngresada();
          myData.then(result => {
            //previsualizacion = file.previewElement.querySelector("img");
            
            if (result.name != undefined) {
             var nombres = Object.keys(result.name);
             previsualizacion.src = "../imagenes/Productos/" + nombres[1];
           }
         });
        }
         
      });
    },
    renameFile: function (file) {
      let str1 = file.name;
      let str2 = str1.substring(str1.lastIndexOf("."));
      return "_" + str2;
    }
  }
}
function ultimaImgIngresada() {
  return new Promise((resolve, reject) => {
    fetch("../php/UltimaImgIngresada.php")
      .then(response => response.json())
      .then(data => {
        resolve(data);
      })
      .catch(error => reject(error));
  });
}
function accederAEnlace(enlace) {
  let encodedImagen = encodeURIComponent(enlace);
  return new Promise((resolve, reject) => {
    fetch("../php/accederAEnlace.php?enlace=" + encodedImagen)
      .then(response => response.json())
      .then(data => {
        resolve(data);
      })
      .catch(error => reject(error));
  });
}
function quitarPlaceHolder(event) {
  let entrada_texto = event.target;
  entrada_texto.placeholder = "";
}
function validaciónIngresoEnlace(ingreso_enlace, dropzone) {
  if (ingreso_enlace.value != "") {
    if (!esUrlValida(ingreso_enlace.value)) {
      imgNoValida("", dropzone);
    } else {
      if (ingreso_enlace.value.includes("images.app.goo.gl")) {
        let myData2 = accederAEnlace(ingreso_enlace.value);
        myData2.then(result => {
          let enlace1 = result.enlace;
          let pos1 = enlace1.indexOf("=");
          let pos2 = enlace1.indexOf("&tbnid");
          let enlace_fin = enlace1.substring(pos1 + 1, pos2);
          enlaceImgVálido(enlace_fin, dropzone);
        });
      } else {
        esImagen1(ingreso_enlace.value).then((result) => {
          if (result) {
            enlaceImgVálido(ingreso_enlace.value, dropzone);
          } else {
            esImagen2(ingreso_enlace.value, dropzone).then((result) => {
              if (result) {
                enlaceImgVálido(ingreso_enlace.value, dropzone);
              } else {
                imgNoValida("", dropzone);
              }
            });
          }
        });
      }
    }
  } else {
    elem_estImgNoValido = document.getElementById("est_txtImgNoValida");
    if (elem_estImgNoValido != undefined) {
      elem_estImgNoValido.remove();
    }
  }
}
function enlaceImgVálido(enlace, dropzone) {
  let file = { name: enlace };
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
      img.addEventListener('error', (_error) => {
        resolve(false);
      });
      img.src = url;
    } catch (error) {
      reject(error);
    }
  });
}
function esImagen2(url, dropzone) {
  return new Promise((resolve, reject) => {
    try {
      if (url.includes("url=")) {
        const splitUrl = url.split('&');
        const imgParam = splitUrl.find(param => param.startsWith('url='));
        const imgUrl = decodeURIComponent(imgParam.replace('url=', ''));
        const img = new Image();
        img.addEventListener('load', () => resolve(true));
        img.addEventListener('error', (_error) => {
          resolve(false);
        });
        img.src = imgUrl;
      } else {
        imgNoValida("", dropzone);
      }
    } catch (error) {
      reject(error);
    }
  });
}
function imgNoValida(archivo, file) {
  if (archivo == "archivo") {
    let hijos = file.previewElement.parentElement.children;
    hijos[hijos.length - 2].firstChild.lastChild.innerHTML = `<p class="txtImgNoValida">Archivo de imagen no válido</p>`;
  }
  document.head.appendChild(estilo_txtImgNoValida);
}