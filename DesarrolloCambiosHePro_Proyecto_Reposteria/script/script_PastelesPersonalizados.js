let dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg, cantidadInput, texto_dedicatoria, colSelect, cantidad_pasteles, seccion_forma, pregunta_misma_forma, diferente_forma, seleccionables, tamaño1, tamaño2, tamaño3, tamaño4, tamaño5;
let ingreso_enlace = document.getElementById("ingreso_enlace");
let contenido_previsualizacion = document.getElementById("contenido_previsualizacion");
let ext = /(.jpg|.jpeg|.png|.gif)$/i;
let fila = document.createElement("tr");
let personalizacion=document.getElementById("personalizacion");
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
const dropzone = new Dropzone("div#formDrop", {
  url: "../php/IngresoImagenProducto.php",
  dictDefaultMessage: `<p id="txtDrop">Arrastra tu imagen, presiona aquí para subirla o ingresa su enlace:</p>
    <input type="url" placeholder="Ingresar enlace" id="input2" style="visibility: hidden">
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
      if (ext.exec(file.name)) {
        ingreso_enlace = document.getElementById("ingreso_enlace");
        if (ingreso_enlace != undefined) {
          ingreso_enlace.remove();
        }
        data.append("type_chooser", "1");
      }

    });
    this.on("addedfile", function (file) {
      let contenedor_preImg = document.querySelector(".dz-image");
      contenedor_preImg.style = "width: 200px; height: 200px;";
      contenedor_preImg.parentNode.style = "width: 200px; height: 200px; margin: 0px !important;";
      contenedor_preImg.children[0].style = "width: 200px; height: 200px";
      document.head.appendChild(estilo_contenedorPreImg);
      dzSize = file.previewElement.querySelector(".dz-size");
      dzProgress = file.previewElement.querySelector(".dz-progress");
      previsualizacion = file.previewElement.querySelector("img");
      previsualizacion.style = "width: 100%; height: 100%;";
      dzProgress.style = "display: none;";
      dzSize.style = "display: none;";

      if (file.name.includes("http") || file.name.includes("data:image")) {
        previsualizacion.src = file.name;
        this.options.maxFiles = 0;
        document.getElementById("aux_IngresarEnlace").value = file.name;
      }
      AgregarMásContenido();
      if (!ext.exec(file.name)) {
        dropzone.removeFile(file);
        imgNoValida("archivo");
      } else {
        ingreso_enlace.style = "z-index: -1;";
      }
    });
  },
  renameFile: function (file) {
    let str1 = file.name;
    let str2 = str1.substring(str1.lastIndexOf("."));
    return "_" + str2;
  }
});
dropzone.on("complete", function (file) {
  let myData = myAsyncFunction();
  myData.then(result => {
    previsualizacion = file.previewElement.querySelector("img");
    var nombres = Object.keys(result.name);
    previsualizacion.src = "../imagenes/Productos/" + nombres[1];
  });
});
function myAsyncFunction() {
  return new Promise((resolve, reject) => {
    fetch("../php/UltimaImgIngresada.php")
      .then(response => response.json())
      .then(data => {
        resolve(data);
      })
      .catch(error => reject(error));
  });
}
function myAsyncFunction2(enlace) {
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
ingreso_enlace.addEventListener('input', () => {
  if (ingreso_enlace.value != "") {
    if (!esUrlValida(ingreso_enlace.value)) {
      imgNoValida();
    } else {
      if (ingreso_enlace.value.includes("images.app.goo.gl")) {
        let myData2 = myAsyncFunction2(ingreso_enlace.value);
        myData2.then(result => {
          let enlace1 = result.enlace;
          let pos1 = enlace1.indexOf("=");
          let pos2 = enlace1.indexOf("&tbnid");
          let enlace_fin = enlace1.substring(pos1 + 1, pos2);
          enlaceImgVálido(enlace_fin);
        });
      } else {
        esImagen1(ingreso_enlace.value).then((result) => {
          if (result) {
            enlaceImgVálido(ingreso_enlace.value);
          } else {
            esImagen2(ingreso_enlace.value).then((result) => {
              if (result) {
                enlaceImgVálido(ingreso_enlace.value);
              } else {
                imgNoValida();
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
});
function enlaceImgVálido(enlace) {
  var file = { name: enlace };
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
function imgNoValida(archivo) {
  if (archivo == "archivo") {
    document.getElementById("txtImgNoValida").innerHTML = "Archivo de imagen no válido";
  }
  document.head.appendChild(estilo_txtImgNoValida);
}
function disminuirCantidadProducto() {
  let str = "";
  diferente_forma = document.getElementById("diferente_forma");
  seleccionables = document.getElementsByName("forma_pasteles");
  colSelect = document.getElementById("colSelect");
  cantidadInput = document.getElementById("cantidad");
  if (cantidadInput.value >= 2) {
    cantidadInput.value = parseInt(cantidadInput.value) - 1;
  }
  Dedicatorias(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML = `
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
  `;
  opcionSel(event);
  if (cantidadInput.value == 1) {
    texto_dedicatoria = document.getElementById("texto_dedicatoria");
    texto_dedicatoria.innerHTML = "<b>Dedicatoria para el pedido:</b>";
    colSelect.style = "display:none";
  }
  if (diferente_forma != null) {
    if (diferente_forma.checked == true) {
      console.log("INPUT VALUE: " + cantidadInput.value);
      for (let i = 0; i <= cantidadInput.value; i++) {
        str += '<option value="' + i + '">' + i + '</option>';
      }
      for (let j = 0; j < seleccionables.length; j++) {
          seleccionables[j].innerHTML = str;
      }
    }
  }
}
function aumentarCantidadProducto() {
  let str = "";
  diferente_forma = document.getElementById("diferente_forma");
  seleccionables = document.getElementsByName("forma_pasteles");
  colSelect = document.getElementById("colSelect");
  cantidadInput = document.getElementById("cantidad");
  cantidadInput.value = parseInt(cantidadInput.value) + 1;
  colSelect.removeAttribute("style");
  Dedicatorias(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML = `
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
  `;
  opcionSel(event);
  texto_dedicatoria = document.getElementById("texto_dedicatoria");
  texto_dedicatoria.innerHTML = "<b>Cantidad de dedicatorias:</b>";
  if (diferente_forma != null) {
    if (diferente_forma.checked == true) {
      console.log("INPUT VALUE: " + cantidadInput.value);
      for (let i = 0; i <= cantidadInput.value; i++) {
        str += '<option value="' + i + '">' + i + '</option>';
      }
      for (let j = 0; j < seleccionables.length; j++) {
          seleccionables[j].innerHTML = str;
      }
    }
  }
}
function Dedicatorias(cantidadInput) {
  opciones = document.getElementById("num_dedicatorias");
  html_aux1 = "";
  if (opciones != null && opciones != undefined) {
    opciones.remove();
  }
  for (let i = 0; i < cantidadInput.value; i++) {
    html_aux1 += '<option value="' + (i + 1) + '">' + (i + 1) + '</option>';
  }
  document.getElementById("contenedor_select").innerHTML = `
  <select id="num_dedicatorias" onchange="AgregarHermanosSelect()">
`+ html_aux1 + `
</select>`;

}
function AgregarHermanosSelect(arreglo_dedicatorias) {
  let límite;
  let dedicatoria = "";
  html_aux2 = "";
  dedicatorias = document.getElementsByName("dedicatoria");
  let select_dedicatorias = document.getElementById("num_dedicatorias");
  límite = select_dedicatorias.value - dedicatorias.length;
  if (select_dedicatorias.value - dedicatorias.length >= 1) {
    for (let i = 1; i <= límite; i++) {
      if (arreglo_dedicatorias == undefined) {
        html_aux2 += '<input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria">';
      } else {
        if (arreglo_dedicatorias[i] != "Sin dedicatoria") {
          dedicatoria = arreglo_dedicatorias[i];
        } else {
          dedicatoria = "";
        }
        html_aux2 += '<input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" value="' + dedicatoria + '">';
      }
    }
    dedicatorias[dedicatorias.length - 1].insertAdjacentHTML("afterend", html_aux2);
  } else {
    límite = límite * (-1);
    cuadros_dedicatoria = document.getElementById("cuadros_dedicatoria");
    for (let i = 1; i <= límite; i++) {
      cuadros_dedicatoria.children[cuadros_dedicatoria.children.length - 1].remove();
    }
  }
  for (let i = 0; i < dedicatorias.length; i++) {
    dedicatorias[i].addEventListener("click", quitarPlaceHolder);
  }
}
function AgregarMásContenido() {
  personalizacion.insertAdjacentHTML("beforeend", `
                <tr>
                    <th>Ingrese el número de pasteles que se encuentra en el modelo:</th>
                    <td colspan="4">
                        <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
                        <input type="number" id="cantidad" name="cantidad" value="1" readonly>
                        <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
                    </td>
                </tr>
                <tr>
                    <th>
                        <p id="texto_dedicatoria"><b>Dedicatoria para el pedido:</b></p>
                    </th>
                    <td id="colSelect" style="display: none">
                        <div id="contenedor_select">
                        </div>
                    </td>
                    <td colspan="4">
                        <div id="cuadros_dedicatoria">
                            <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
                        </div>
                    </td>
                </tr>
                <tr id="seccion_forma">
                  <th>
                    <p><b>Forma:</b></p>
                  </th>
                  <td>
                    <input class="col" type="radio" id="red" onchange="tamañoSel(event)" value="Redonda" name="forma">
                    <label for="red">Redonda&nbsp;</label>
                  </td>
                  <td>
                    <input class="col" type="radio" id="cuad" onchange="tamañoSel(event)" value="Cuadrada" name="forma">
                    <label for="cuad">Cuadrada</label>
                  </td>
                  <td>
                    <input class="col" type="radio" id="rec" onchange="tamañoSel(event)" value="Rectangular" name="forma">
                    <label for="rec">Rectangular</label>
                  </td>
                  <td>
                    <input class="col" type="radio" id="per" onchange="tamañoSel(event)" value="Personalizada" name="forma">
                    <label for="per">Personalizada</label>
                  </td>
                </tr>
  `);
}
function opcionSel(event) {
  //console.log(event.target.id);
  pregunta_misma_forma = document.getElementById("pregunta_misma_forma");
  seccion_forma = document.getElementById("seccion_forma");
  if (pregunta_misma_forma == undefined) {
    if (cantidadInput.value > 1) {
      seccion_forma.style = "display:none";
      document.getElementById("seccion_forma").insertAdjacentHTML("beforebegin", `
                  <tr id="pregunta_misma_forma">
                      <th>¿Todos los pasteles son de la misma forma?</th>
                      <td>
                        <input type="radio" id="igual_forma" onchange="opcionSel(event)" value="Sí" name="misma_forma">
                        <label for="igual_forma">Sí</label>
                      </td>
                      <td>
                        <input type="radio" id="diferente_forma" onchange="opcionSel(event)" value="No" name="misma_forma">
                        <label for="diferente_forma">No</label>
                      </td>
                  </tr>
      `);
    }
  } else {
    if (cantidadInput.value == 1) {
      pregunta_misma_forma.remove();
      seccion_forma.removeAttribute("style");
    }
  }
  switch (event.target.id) {
    case "igual_forma":
      seccion_forma.removeAttribute("style");
      let dif_forma=document.getElementsByTagName("tbody");
      if(dif_forma.length==4){
        dif_forma[3].remove();
      }
      break;
    case "diferente_forma":
      let str = "";
      seccion_forma.style = "display: none";
      for (let i = 0; i <= cantidadInput.value; i++) {
        str += '<option value="' + i + '">' + i + '</option>';
      }
      personalizacion.insertAdjacentHTML("beforeend", `
                  <tr>
                      <th>Nro. de pasteles circulares</th>
                      <td>
                        <select id="num_circulares" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles cuadrados</th>
                      <td>
                        <select id="num_cuadradas" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles rectangulares</th>
                      <td>
                        <select id="num_rectangulares" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles con forma personalizada</th>
                      <td>
                        <select id="num_personalizadas" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
      `);
      break;
      
    default:
    //console.log("NADA");
  }
}
function diferentesFormas(event) {
  seleccionables = document.getElementsByName("forma_pasteles");
  let str = ' ';
  let suma_formas = 0;
  for (let k = 0; k < seleccionables.length; k++) {
    suma_formas += parseInt(seleccionables[k].value);
  }
  console.log("SUMA: " + suma_formas);
  console.log("cantidad value - valor escogido: " + (cantidadInput.value - suma_formas));
  for (let i = 0; i <= cantidadInput.value - suma_formas; i++) {
    str += '<option value="' + i + '">' + i + '</option>';
  }
  for (let j = 0; j < seleccionables.length; j++) {
    if (seleccionables[j].id != event.target.id && seleccionables[j].value == 0) {
      seleccionables[j].innerHTML = str;
    }
  }
}
function tamañoSel(event){
  switch (event.target.id) {
    case "red":
      console.log("REDONDA");
        tamaño1 = "Mini (5-6 personas)";
        tamaño2 = "Pequeña (10-12 personas)";
        tamaño3 = "Mediana (16 personas)";
        tamaño4 = "Grande (30 personas)";
        tamaño5 = "Extra grande (70 personas)";
      break;
      case "cuad":
        tamaño1 = "Pequeña (20-25 personas)";
        tamaño2 = "Mediana (35-40 personas)";
        tamaño3 = "Grande (50 personas)";
      break;
      case "rec":
        tamaño1 = "Mediana (35-40 personas)";
        tamaño2 = "Extra grande (100 personas)";
      break;
      default:
        tamaño1 = "Mini (2-4 personas)";
        tamaño2 = "Pequeña (8-10 personas)";
        tamaño3 = "Mediana (12-14 personas)";
        tamaño4 = "Grande (26-28 personas)";
        tamaño5 = "Extra grande (66-68 personas)";  
  }
  fila.innerHTML = `
    <th><p><b>Tamaño:</b></p></th>
    <td>
      <input type="radio" id="tamaño1" name="tamaño" value="`+ tamaño1 + `">
      <label for="tamaño1">`+ tamaño1 + `</label>
    </td>
    <td>
      <input type="radio" id="tamaño2" name="tamaño" value="`+ tamaño2 + `">
      <label for="tamaño2">`+ tamaño2 + `</label>
    </td>
  `;
  if (event.target.id == "cuad") {
    fila.insertAdjacentHTML("beforeend", `
    <td>
    <input type="radio" id="tamaño3" name="tamaño" value="`+ tamaño3 + `">
    <label for="tamaño3">`+ tamaño3 + `</label>
  </td>
    `);
  } else {
    if (event.target.id == "per" || event.target.id == "red") {
      fila.insertAdjacentHTML("beforeend", `
      <td>
      <input type="radio" id="tamaño3" name="tamaño" value="`+ tamaño3 + `">
      <label for="tamaño3">`+ tamaño3 + `</label>
    </td>
      <td>
    <input type="radio" id="tamaño4" name="tamaño" value="`+ tamaño4 + `">
    <label for="tamaño4">`+ tamaño4 + `</label>
  </td>
  <td>
    <input type="radio" id="tamaño5" name="tamaño" value="`+ tamaño5 + `">
    <label for="tamaño5">`+ tamaño5 + `</label>
  </td>
    `);
    }
  }
  
  if (document.getElementById("normal") == null) {
    //tabla.appendChild(div_fila);
    personalizacion.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.appendChild(fila);
    fila.insertAdjacentHTML("afterend", `
                    <tr>
                        <th><p><b>Masa:</b></p></th>
                        <td>
                            <input type="radio" id="normal" name="masa" value="Normal (Con receta propia)">
                            <label for="normal">Normal (Con receta propia)</label>
                        </td>
                        <td>
                            <input type="radio" id="biz" name="masa" value="Bizcochuelo">
                            <label for="biz">Bizcochuelo</label>
                        </td>
                        <td>
                            <input type="radio" id="milh" name="masa" value="Milhojas">
                            <label for="milh">Milhojas</label>
                        </td>
                    </tr>
                    <tr>
                        <th><p><b>Sabor:</b></p></th>
                        <td>
                            <input class="col" type="radio" id="nar" name="sabor" value="Naranja">
                            <label for="nar">Naranja</label>
                        </td>
                        <td>
                            <input class="col" type="radio" id="choc" name="sabor" value="Chocolate">
                            <label for="choc">Chocolate</label>
                        </td>
                        <td>
                            <input class="col" type="radio" id="narychoc" name="sabor" value="Naranja y chocolate (Marmoleada)">
                            <label for="narychoc">Naranja y chocolate (Marmoleada)</label>
                        </td>
                    </tr>
                    <tr>
                        <th><p><b>Cobertura:</b></p></th>
                        <td>
                            <input class="col" type="radio" id="crema" name="cobertura" value="Crema">
                            <label for="crema">Crema</label>
                        </td>
                        <td>
                            <input class="col" type="radio" id="fondant" name="cobertura" value="Fondant">
                            <label for="fondant">Fondant</label>
                        </td>
                    </tr>
                    <tr>
                        <th><p><b>Relleno:</b></p></th>
                        <td>
                            <input class="col" type="radio" id="frutilla" name="relleno" value="Mermelada de frutilla">
                            <label for="frutilla">Mermelada de frutilla</label>
                        </td>
                        <td>
                            <input class="col" type="radio" id="mora" name="relleno" value="Mermelada de mora">
                            <label for="mora">Mermelada de mora</label>
                        </td>
                        <td>
                            <input class="col" type="radio" id="glass" name="relleno" value="Glass de frutilla con crema">
                            <label for="glass">Glass de frutilla con crema</label>
                        </td>
                        <td>
                            <input class="col" type="radio" id="napolitana" name="relleno" value="Crema napolitana">
                            <label for="napolitana">Crema napolitana</label>
                        </td>
                    </tr>
  `);
  }
}