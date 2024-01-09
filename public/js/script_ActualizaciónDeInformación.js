let tamaño1, tamaño2, tamaño3, tamaño4, tamaño5, dirImg;;
let div_fila = document.createElement("div");
let div_col = document.createElement("div");
let ingreso_enlace;
let h1 = document.getElementsByTagName("h1")[0];
let verificacion_enlace = document.getElementById("verificacion_enlace");
let btnEnviar;
let txtO = document.querySelector("label[for='ingreso_enlace']");
let dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg;
let ubicación_página = window.location.href;
estilo_txtImgNoValida = document.createElement("style");
estilo_noMasImg = document.createElement("style");
estilo_contenedorPreImg = document.createElement("style");
estilo_txtImgNoValida.id = "est_txtImgNoValida";
estilo_contenedorPreImg.id = "est_contPreImg";
estilo_contenedorPreImg.innerHTML = `
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
if (ubicación_página.substring(ubicación_página.lastIndexOf("/")) == "/actualizar_producto") {
  window.onload = AgregarContenido("");
}else{
  if (ubicación_página.includes("/actualizar_seleccionado")) {
  verificacion_enlace = document.getElementById("verificacion_enlace");
  const fileInput = document.getElementById('file-input');
  const imagePreview = document.getElementById('image-preview');
  let aux_IngresarEnlace = document.getElementById("aux_IngresarEnlace");
  div_fila.className = "fila";
  txtO = document.querySelector("label[for='ingreso_enlace']");
  btnEnviar = document.getElementById("enviarFormulario");
  ingreso_enlace = document.getElementById("ingreso_enlace");
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
        if (file.name.includes("http") || file.name.includes("data:image")) {
          dzSize = file.previewElement.querySelector(".dz-size");
          dzProgress = file.previewElement.querySelector(".dz-progress");
          previsualizacion = file.previewElement.querySelector("img");
          previsualizacion.src = file.name;
          previsualizacion.style = "width: 100%; height: 100%;";
          dzProgress.style = "display: none;";
          dzSize.style = "display: none;";
          ingreso_enlace.style = "z-index: -1;";
          this.options.maxFiles = 0;
          aux_IngresarEnlace.value = file.name;
          imagePreview.src=file.name;
        }
      });
      this.on("success", function (file, response) {
        var obj = JSON.parse(response); // Este es el objeto resultante
        console.log(obj.objeto);
        //localStorage.setItem("ruta_archivo_img", obj.objeto);
        imagePreview.src = obj.objeto;
        aux_IngresarEnlace.value = obj.objeto;
        document.getElementById("ruta_archivo_img").value = "si";
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
    contenedor_preImg.style = "width: 200px; height: 200px;";
    contenedor_preImg.parentNode.style = "width: 200px; height: 200px; margin: 0px !important;";
    contenedor_preImg.children[0].style = "width: 200px; height: 200px";
    document.head.appendChild(estilo_contenedorPreImg);

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
  }
}

div_fila.className = "fila";
function AgregarContenido(CategoríaSeleccionada) {
  seccion_productos = document.getElementById("seccion_productos");
  if (CategoríaSeleccionada == "") {
    // Seleccionar el input oculto por su nombre
    let input = document.getElementById("pasteles");
    // Obtener el valor del input, que es una cadena JSON
    let value = input.value;
    // Convertir la cadena JSON en un array de javascript
    let array = JSON.parse(value);
    // Mostrar el contenido del array en la consola
    console.log(array);
      let div_aux = document.createElement("div");
      for (let i = 0; i < array.length; i++) {
        let div = document.createElement("div");
        let imagen = document.createElement("img");
        let h3 = document.createElement("button");
        imagen.src = array[i].img;
        h3.innerHTML = "Mostrar más información";
        h3.className="mostrar_informacion";
        div.appendChild(h3);
        h3.addEventListener("click", ProductoSeleccionado);
        div.appendChild(imagen);
        div_aux.appendChild(div);
      }
      seccion_productos.appendChild(div_aux);
  } else {
    if (CategoríaSeleccionada == " Navidad") {
      CategoríaSeleccionada = CategoríaSeleccionada.substring(1);
      console.log("CATEGORÍA: " + "X" + CategoríaSeleccionada + "X");
    }
    let myData = myAsyncFunction(CategoríaSeleccionada);
    myData.then(result => {
      console.log(result);
      let div_aux = document.createElement("div");
      for (let i = 0; i < result.length; i++) {
        let a = 15.0;
        let div = document.createElement("div");
        let imagen = document.createElement("img");
        let h3 = document.createElement("button");
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
    );
  }
}
function myAsyncFunction(imagen) {
  const encodedImagen = encodeURIComponent(imagen);
  return new Promise((resolve, reject) => {
    fetch("../php/ConsultaProductoSeleccionado.php?imagen=" + encodedImagen)
      .then(response => response.json())
      .then(data => { //archivo json       
        resolve(data);
      })
      .catch(error => reject(error));
  });
}
function esImagen(url) {
  return new Promise((resolve, reject) => {
    try {
      const img = new Image();
      img.addEventListener('load', () => resolve(true));
      img.addEventListener('error', (error) => {
        //console.error(error); // mostrar el error en la consola
        resolve(false);
      });
      img.src = url;
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
  let tabla = document.querySelector(".tabla_info");
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
        tamaño3 = "Mediana: 12-14 personas";
        tamaño4 = "Grande (26-28 personas)";
        tamaño5 = "Extra grande (66-68 personas)";
      } else {
        tamaño1 = "Mini (5-6 personas)";
        tamaño2 = "Pequeña (10-12 personas)";
        tamaño3 = "Mediana: 16 personas";
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
function ProductoSeleccionado(event) {
  const srcString = event.target.nextSibling.src;
  // Decode the URL if it's encoded
  const decodedUrl = decodeURIComponent(srcString);

  document.getElementById("enlace_img").value = decodedUrl; // Use the decoded URL
  console.log("Image URL: " + decodedUrl);
}

function esImagen(url) {
  return new Promise((resolve, reject) => {
    try {
      const img = new Image();
      img.addEventListener('load', () => resolve(true));
      img.addEventListener('error', (error) => {
        //console.error(error); // mostrar el error en la consola
        resolve(false);
      });
      img.src = url;
    } catch (error) {
      reject(error);
    }
  });
}
function esUrlValida(url) {
  const expresionRegular = /^(https?|http):\/\/[^\s/$.?#].[^\s]*$/i;
  return expresionRegular.test(url);
}
function imgNoValida() {
  document.head.appendChild(estilo_txtImgNoValida);
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
