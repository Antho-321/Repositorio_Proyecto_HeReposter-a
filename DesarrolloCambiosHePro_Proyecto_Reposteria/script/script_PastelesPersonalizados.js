let dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg, cantidadInput, texto_dedicatoria, colSelect, cantidad_pasteles, seccion_forma, pregunta_misma_forma, diferente_forma, seleccionables, tamaño1, tamaño2, tamaño3, tamaño4, tamaño5, inputs_forma, seccion_masa, opciones_tamaño;
let ingreso_enlace = document.getElementById("ingreso_enlace");
let contenido_previsualizacion = document.getElementById("contenido_previsualizacion");
let ext = /(.jpg|.jpeg|.png|.gif)$/i;
let fila = document.createElement("tr");
let fila2 = document.createElement("tr");
let personalizacion = document.getElementById("personalizacion");
let algunoCheckeado = false;
opciones_tamaño="";
fila.id = "seccion_tamaño";
estilo_txtImgNoValida = document.createElement("style");
estilo_noMasImg = document.createElement("style");
estilo_contenedorPreImg = document.createElement("style");
estilo_txtImgNoValida.id = "est_txtImgNoValida";
estilo_contenedorPreImg.id = "est_contPreImg";
inputs_forma = document.getElementsByName("forma");
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
    if (result.name != undefined) {
      var nombres = Object.keys(result.name);
      previsualizacion.src = "../imagenes/Productos/" + nombres[1];
    }
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
ingreso_enlace.addEventListener('input', () => {
  if (ingreso_enlace.value != "") {
    if (!esUrlValida(ingreso_enlace.value)) {
      imgNoValida();
    } else {
      if (ingreso_enlace.value.includes("images.app.goo.gl")) {
        let myData2 = accederAEnlace(ingreso_enlace.value);
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
function disminuirCantidadP() {
  let str = "";
  diferente_forma = document.getElementById("diferente_forma");
  seleccionables = document.getElementsByName("forma_pasteles");
  colSelect = document.getElementById("colSelect");
  if (cantidadInput.value >= 2) {
    cantidadInput.value = parseInt(cantidadInput.value) - 1;
  }
  DedicatoriasP(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML = `
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
  `;
  opcionSel(event);
  if (cantidadInput.value == 1) {
    let seccion_tamaño = document.getElementById("seccion_tamaño");
    texto_dedicatoria = document.getElementById("texto_dedicatoria");
    texto_dedicatoria.innerHTML = "<b>Dedicatoria para el pedido:</b>";
    colSelect.style = "display:none";
    if (seccion_tamaño != null) {
      let elem = seccion_tamaño;
      while (elem != null) {
        if (elem instanceof HTMLElement) {
          elem.removeAttribute("style");
        }
        elem = elem.nextElementSibling;
      }
    }
  }
  if (diferente_forma != null) {
    if (diferente_forma.checked == true) {
      for (let i = 0; i <= cantidadInput.value; i++) {
        str += '<option value="' + i + '">' + i + '</option>';
      }
      for (let j = 0; j < seleccionables.length; j++) {
        seleccionables[j].innerHTML = str;
      }
    }
  }
  let inputs = document.getElementsByTagName("input");
  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].value == "Sí") {
      //inputs[i].parentElement.parentElement.style="display:none";
      let elem = inputs[i].parentElement.parentElement;
      while (elem != null) {
        if (elem instanceof HTMLElement) {
          elem.style = "display:none";
        }
        elem = elem.nextElementSibling;
      }
      //console.log(inputs[i].parentElement.parentElement);
      break;
    }
  }
}
function aumentarCantidadP() {
  let str = "";
  for (let i = 0; i < inputs_forma.length; i++) {
    if (inputs_forma[i].checked) {
      algunoCheckeado = true;
      break;
    }
  }
  diferente_forma = document.getElementById("diferente_forma");
  seleccionables = document.getElementsByName("forma_pasteles");
  colSelect = document.getElementById("colSelect");
  cantidadInput.value = parseInt(cantidadInput.value) + 1;
  colSelect.removeAttribute("style");
  DedicatoriasP(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML = `
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
  `;
  opcionSel(event);
  texto_dedicatoria = document.getElementById("texto_dedicatoria");
  texto_dedicatoria.innerHTML = "<b>Cantidad de dedicatorias:</b>";
  if (diferente_forma != null) {
    if (diferente_forma.checked == true) {
      for (let i = 0; i <= cantidadInput.value; i++) {
        str += '<option value="' + i + '">' + i + '</option>';
      }
      for (let j = 0; j < seleccionables.length; j++) {
        seleccionables[j].innerHTML = str;
      }
    }
  }
  let seccion_tamaño = document.getElementById("seccion_tamaño");
  if (seccion_tamaño != null) {
    let elem = seccion_tamaño;
    while (elem != null) {
      if (elem instanceof HTMLElement) {
        elem.style = "display: none";
      }
      elem = elem.nextElementSibling;
    }
    seccion_tamaño.style = "display:none";
  }
}
function DedicatoriasP(cantidadInput) {
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
                        <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadP()">
                        <input type="number" id="cantidad" name="cantidad" value="1" readonly>
                        <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadP()">
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
                    <select onchange="tamañoSel(event)" name="forma">
                      <option value="Redonda">Redonda</option>
                      <option value="Cuadrada">Cuadrada</option>
                      <option value="Rectangular">Rectangular</option>
                      <option value="Personalizada">Personalizada</option>
                    </select>
                  </td>
                </tr>
                <tr id="seccion_tamaño">
                  <th><p><b>Tamaño:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_tamaño" name="tamaño">
                      <option value="Mini (5-6 personas)">Mini (5-6 personas)</option>
                      <option value="Pequeña (10-12 personas)">Pequeña (10-12 personas)</option>
                      <option value="Mediana (16 personas)">Mediana (16 personas)</option>
                      <option value="Grande (30 personas)">Grande (30 personas)</option>
                      <option value="Extra grande (70 personas)">Extra grande (70 personas)</option>
                    </select>
                  </td>
                </tr>
                <tr id="seccion_tipoPastel">
                  <th><p><b>Tipo de pastel:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_pastel" name="masa">
                      <option value="Normal (Con receta propia)">Normal (Con receta propia)</option>
                      <option value="Bizcochuelo">Bizcochuelo</option>
                      <option value="Milhojas">Milhojas</option>
                      <option value="Cheesecake">Cheesecake</option>
                      <option value="Mousse">Mousse</option>
                    </select>
                  </td>
                </tr>
                <tr id="seccion_sabor">
                  <th><p><b>Sabor:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_sabor" name="sabor">
                      <option value="Naranja">Naranja</option>
                      <option value="Chocolate">Chocolate</option>
                      <option value="Naranja y chocolate (Marmoleada)">Naranja y chocolate (Marmoleada)</option>
                    </select>
                  </td>
                </tr>
  `);
  console.log(document.getElementById("opciones_sabor").value);
  cantidadInput = document.getElementById("cantidad");
}
function opcionSel(event) {
  //console.log(event.target.id);
  pregunta_misma_forma = document.getElementById("pregunta_misma_forma");
  seccion_forma = document.getElementById("seccion_forma");
  if (cantidadInput != undefined) {
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
  }
  switch (event.target.id) {
    case "igual_forma":
      seccion_forma.removeAttribute("style");
      let dif_forma = document.getElementsByTagName("tbody");
      if (dif_forma.length == 4) {
        dif_forma[3].remove();
      }
      //console.log(event.target.parentNode.parentNode.parentNode);

      event.target.parentNode.parentNode.parentNode.insertAdjacentHTML("afterend", `
                      <tr>
                          <th>¿Todos los pasteles son del mismo tamaño?:</th>
                        <td>
                          <input type="radio" id="mismo_tamaño" onchange="opcionSel(event)" value="Sí" name="mismo_tamaño">
                          <label for="igual_forma">Sí</label>
                        </td>
                        <td>
                          <input type="radio" id="diferente_tamaño" onchange="opcionSel(event)" value="No" name="mismo_tamaño">
                          <label for="diferente_forma">No</label>
                        </td>
                      </tr>
    `);

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
    case "mismo_tamaño":
      let elem;
      //console.log(fila2);
      if (algunoCheckeado) {
        elem = fila2
        if (elem.hasAttribute("style")) {
          elem.removeAttribute("style");
        }
      } else {
        elem = fila;
      }
      event.target.parentNode.parentNode.parentNode.appendChild(elem);
      elem.insertAdjacentHTML("afterend", `
          <tr>
          <th>¿Desea que todos tengan la misma masa?:</th>
        <td>
          <input type="radio" id="misma_masa" onchange="opcionSel(event)" value="Sí" name="misma_masa">
          <label for="igual_forma">Sí</label>
        </td>
        <td>
          <input type="radio" id="diferente_masa" onchange="opcionSel(event)" value="No" name="misma_masa">
          <label for="diferente_forma">No</label>
        </td>
      </tr>
  `);
      break;
    case "diferente_tamaño":
      let seccion_tamaño = document.getElementById("seccion_tamaño");
      if (seccion_tamaño != null) {
        let elem = seccion_tamaño;
        while (elem != null) {
          if (elem instanceof HTMLElement) {
            elem.style = "display: none";
          }
          elem = elem.nextElementSibling;
        }
        seccion_tamaño.style = "display:none";
      }
      break;
    default:
    //console.log("NADA");
  }
  switch (event.target.name) {
    case "tamaño":
      if (document.getElementsByName("masa").length == 0) {
        event.target.parentElement.parentElement.insertAdjacentHTML("afterend", `
                      <tr>
                          <th><p><b>Tipo de pastel:</b></p></th>
                          <td>
                              <input type="radio" id="normal" onchange="opcionSel(event)" name="masa" value="Normal (Con receta propia)">
                              <label for="normal">Normal (Con receta propia)</label>
                          </td>
                          <td>
                              <input type="radio" id="biz" onchange="opcionSel(event)" name="masa" value="Bizcochuelo">
                              <label for="biz">Bizcochuelo</label>
                          </td>
                          <td>
                              <input type="radio" id="milh" onchange="opcionSel(event)" name="masa" value="Milhojas">
                              <label for="milh">Milhojas</label>
                          </td>
                          <td>
                              <input type="radio" id="cheese" onchange="opcionSel(event)" name="masa" value="Cheesecake">
                              <label for="cheese">Cheesecake</label>
                          </td>
                          <td>
                              <input type="radio" id="mousse" onchange="opcionSel(event)" name="masa" value="Mousse">
                              <label for="mousse">Mousse</label>
                          </td>
                      </tr>
        `);
      }

      break;
    case "masa":
      if (document.getElementsByName("sabor").length == 0) {
        
      } 
      sabor = document.getElementsByName("sabor");
      seccion_masa = document.getElementById("seccion_masa");
        switch (event.target.id) {
          case "normal":
            sabor[0].value = "Naranja";
            sabor[0].nextElementSibling.innerHTML = "Naranja";
            sabor[2].parentElement.removeAttribute("style");
            break;
          case "biz":
          case "cheese":
            sabor[0].value = "Vainilla";
            sabor[0].nextElementSibling.innerHTML = "Vainilla";
            sabor[2].parentElement.style = "display: none";
            break;
          case "milh":
            seccion_masa.style = "display:none";
            break;
          case "mousse":
            sabor[0].value = "Fresa";
            sabor[0].nextElementSibling.innerHTML = "Fresa";
            sabor[1].value = "Naranja";
            sabor[1].nextElementSibling.innerHTML = "Naranja";
            sabor[2].value = "Maracuyá";
            sabor[2].nextElementSibling.innerHTML = "Maracuyá";
            sabor[3].value = "Limón";
            sabor[3].nextElementSibling.innerHTML = "Limón";
            sabor[3].parentElement.removeAttribute("style");
            sabor[4].value = "Uva";
            sabor[4].nextElementSibling.innerHTML = "Uva";
            sabor[4].parentElement.removeAttribute("style");
            sabor[5].value = "Manzana";
            sabor[5].nextElementSibling.innerHTML = "Manzana";
            sabor[5].parentElement.removeAttribute("style");
            break;
        }
      
      
        if (event.target.id != "milh") {
          seccion_masa.removeAttribute("style");
          if(event.target.id!="mousse"){
            sabor[1].value="Chocolate";
            sabor[1].nextElementSibling.innerHTML="Chocolate";
            sabor[3].parentElement.style="display:none";
            sabor[4].parentElement.style="display:none";
            sabor[5].parentElement.style="display:none";
          }
        }
      break;
  }
}
function diferentesFormas(event) {
  seleccionables = document.getElementsByName("forma_pasteles");
  let str = ' ';
  let suma_formas = 0;
  for (let k = 0; k < seleccionables.length; k++) {
    suma_formas += parseInt(seleccionables[k].value);
  }
  for (let i = 0; i <= cantidadInput.value - suma_formas; i++) {
    str += '<option value="' + i + '">' + i + '</option>';
  }
  for (let j = 0; j < seleccionables.length; j++) {
    if (seleccionables[j].id != event.target.id && seleccionables[j].value == 0) {
      seleccionables[j].innerHTML = str;
    }
  }
}
function tamañoSel(event) {
  console.log(event.target.value);
  switch (event.target.value) {
    case "Redonda":
      tamaño1 = "Mini (5-6 personas)";
      tamaño2 = "Pequeña (10-12 personas)";
      tamaño3 = "Mediana (16 personas)";
      tamaño4 = "Grande (30 personas)";
      tamaño5 = "Extra grande (70 personas)";
      break;
    case "Cuadrada":
      tamaño1 = "Pequeña (20-25 personas)";
      tamaño2 = "Mediana (35-40 personas)";
      tamaño3 = "Grande (50 personas)";
      break;
    case "Rectangular":
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
opciones_tamaño=`
<option value="`+tamaño1+`">`+tamaño1+`</option>
<option value="`+tamaño2+`">`+tamaño2+`</option>
`;
if (event.target.value == "Cuadrada") {
    opciones_tamaño+=`<option value="`+tamaño3+`">`+tamaño3+`</option>`;
  } else {
    if (event.target.value == "Personalizada" || event.target.value == "Redonda") {
      opciones_tamaño+=`
      <option value="`+tamaño3+`">`+tamaño3+`</option>
      <option value="`+tamaño4+`">`+tamaño4+`</option>
      <option value="`+tamaño5+`">`+tamaño5+`</option>
      `;
    }
  }
  if (cantidadInput.value == 1) {
      document.getElementById("opciones_tamaño").innerHTML=opciones_tamaño;
  }

}