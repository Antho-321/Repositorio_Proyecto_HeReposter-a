let tamaño1, tamaño2, tamaño3, tamaño4, tamaño5, precio;
let div_fila = document.createElement("div");
let div_col = document.createElement("div");
let tabla = document.querySelectorAll(".tabla_info")[1];
let h1 = document.getElementsByTagName("h1")[0];
let ingreso_enlace = document.getElementById("ingreso_enlace");
let verificacion_enlace = document.getElementById("verificacion_enlace");
let btnEnviar = document.getElementById("enviarFormulario");
let txtO = document.querySelector("label[for='ingreso_enlace']");
const imagePreview = document.getElementById('image-preview');
const searchString = window.location.search;
const searchParams = new URLSearchParams(searchString);
div_fila.className = "fila";
btnEnviar.disabled="true";


function esImagen2(url) {
  return new Promise((resolve, reject) => {
    try {
      if(url.includes("url=")){
        const splitUrl = url.split('&');
      const imgParam = splitUrl.find(param => param.startsWith('url='));
      const imgUrl = decodeURIComponent(imgParam.replace('url=', ''));
      console.log("imgUrl: " + imgUrl);
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
function esUrlValida(url) {
  const expresionRegular = /^(https?|http):\/\/[^\s/$.?#].[^\s]*$/i;
  return expresionRegular.test(url);
}

function opcionesPastel(event) {
  if (event.target.id == "rec") {
    tamaño1 = "Mediana (35-40 personas)";
    tamaño2 = "Extra grande (100 personas)";
  } else {
    if (event.target.id == "cuad") {
      tamaño1 = "Pequeña (20-25 personas)";
      tamaño2 = "Mediana (35-40 personas)";
      tamaño3 = "Grande (50 personas)";
    } else {
      if (event.target.id == "per") {
        tamaño1 = "Mini (2-4 personas)";
        tamaño2 = "Pequeña (8-10 personas)";
        tamaño3 = "Mediana (12-14 personas)";
        tamaño4 = "Grande (26-28 personas)";
        tamaño5 = "Extra grande (66-68 personas)";
      } else {
        tamaño1 = "Mini (5-6 personas)";
        tamaño2 = "Pequeña (10-12 personas)";
        tamaño3 = "Mediana (16 personas)";
        tamaño4 = "Grande (30 personas)";
        tamaño5 = "Extra grande (70 personas)";
      }
    }
  }
  div_fila.innerHTML = `
    <p class="col">Tamaño:</p>
    <div class="col">
      <input class="col" type="radio" id="tamaño1" name="tamano" value="`+ tamaño1 + `" onchange="cambioTamano(this.value)">
      <label for="tamaño1">`+ tamaño1 + `</label>
    </div>
    <div class="col">
      <input class="col" type="radio" id="tamaño2" name="tamano" value="`+ tamaño2 + `" onchange="cambioTamano(this.value)">
      <label for="tamaño2">`+ tamaño2 + `</label>
    </div>
  `;
  if (event.target.id == "cuad") {
    div_fila.insertAdjacentHTML("beforeend", `
    <div class="col">
    <input class="col" type="radio" id="tamaño3" name="tamano" value="`+ tamaño3 + `" onchange="cambioTamano(this.value)">
    <label for="tamaño3">`+ tamaño3 + `</label>
  </div>
    `);
  } else {
    if (event.target.id == "per" || event.target.id == "red") {
      div_fila.insertAdjacentHTML("beforeend", `
      <div class="col">
      <input class="col" type="radio" id="tamaño3" name="tamano" value="`+ tamaño3 + `" onchange="cambioTamano(this.value)">
      <label for="tamaño3">`+ tamaño3 + `</label>
    </div>
      <div class="col">
    <input class="col" type="radio" id="tamaño4" name="tamano" value="`+ tamaño4 + `" onchange="cambioTamano(this.value)">
    <label for="tamaño4">`+ tamaño4 + `</label>
  </div>
  <div class="col">
    <input class="col" type="radio" id="tamaño5" name="tamano" value="`+ tamaño5 + `" onchange="cambioTamano(this.value)">
    <label for="tamaño5">`+ tamaño5 + `</label>
  </div>
    `);
    }
  }



  if (document.getElementById("normal") == null) {
    tabla.appendChild(div_fila);
    div_fila.insertAdjacentHTML("afterend", `
                    <div class="fila">
                        <p class="col">Masa:</p>
                        <div class="col">
                            <input class="col" type="radio" id="normal" name="masa" value="Normal (Con receta propia)">
                            <label for="normal">Normal (Con receta propia)</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="biz" name="masa" value="Bizcochuelo">
                            <label for="biz">Bizcochuelo</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="milh" name="masa" value="Milhojas">
                            <label for="milh">Milhojas</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Sabor:</p>
                        <div class="col">
                            <input class="col" type="radio" id="nar" name="sabor" value="Naranja">
                            <label for="nar">Naranja</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="choc" name="sabor" value="Chocolate">
                            <label for="choc">Chocolate</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="narychoc" name="sabor" value="Naranja y chocolate (Marmoleada)">
                            <label for="narychoc">Naranja y chocolate (Marmoleada)</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Cobertura:</p>
                        <div class="col">
                            <input class="col" type="radio" id="crema" name="cobertura" value="Crema">
                            <label for="crema">Crema</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="fondant" name="cobertura" value="Fondant">
                            <label for="fondant">Fondant</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Relleno:</p>
                        <div class="col">
                            <input class="col" type="radio" id="frutilla" name="relleno" value="Mermelada de frutilla">
                            <label for="frutilla">Mermelada de frutilla</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="mora" name="relleno" value="Mermelada de mora">
                            <label for="mora">Mermelada de mora</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="glass" name="relleno" value="Glass de frutilla con crema">
                            <label for="glass">Glass de frutilla con crema</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="napolitana" name="relleno" value="Crema napolitana">
                            <label for="napolitana">Crema napolitana</label>
                        </div>
                    </div>
  `);
  }
  if (document.getElementById("precio_descripcion") == null) {
    tabla.insertAdjacentHTML("afterend", `
    <div id="precio_descripcion">
      <div class="fila">
        <label class="col">Precio:</label>
        <div class="col">
          <label for="precio">$</label>
          <input id="precio" type="number" step="0.1" name="precio">
        </div>
      </div>
          <div class="fila">
            <p class="col">Descripción adicional:</p>
            <textarea class="col" name="descripcion" id="descAdicional" placeholder="(Opcional)"></textarea>
          </div>  
    </div>
    `);
    precio=document.getElementById("precio");
    precio.addEventListener("input",habilitarEnvio);
    document.getElementById("descAdicional").addEventListener("click", vaciarPlaceHolder); 
  }
}
function vaciarPlaceHolder(event) {
  event.target.placeholder = "";
}
function obtenerNumeros(cadena) {
  let resultado = cadena.match(/\d+-\d+|\d+/g);
  return resultado ? resultado.join('') : '';
}
function cambioTamano(value) {
  document.getElementById("porciones").value=obtenerNumeros(value);
}
function habilitarEnvio(){
  console.log(precio.value=="");
  if (precio.value!=""){
    btnEnviar.removeAttribute("disabled");
  }else{
    btnEnviar.disabled="true";
  }
}

let dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg;
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
    <input type="url" placeholder="Ingresar enlace" id="input2" class="input_enlace">
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
          //alert("enlace validoooo");
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
  verificacion_enlace.value = "si";
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

