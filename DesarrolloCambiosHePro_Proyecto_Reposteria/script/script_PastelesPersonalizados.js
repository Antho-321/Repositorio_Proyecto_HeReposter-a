let dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg, cantidadInput, texto_dedicatoria, colSelect, cantidad_pasteles, seccion_forma1, diferente_forma, seleccionables, tamaño1, tamaño2, tamaño3, tamaño4, tamaño5, inputs_forma, seccion_sabor, opciones_tamaño, dropzone2, contenedor_preImg, formDrop2, formDrop3, dropzone3, formDrop4, dropzone4, seccion_relleno, img_figura, img_adorno, ingreso_enlace1, ingreso_enlace2, ingreso_enlace3, ingreso_enlace4, formDrop1, dropzone1, seccion_forma2;
let contenido_previsualizacion = document.getElementById("contenido_previsualizacion");
let ext = /(.jpg|.jpeg|.png|.gif)$/i;
let fila = document.createElement("tr");
let fila2 = document.createElement("tr");
let personalizacion = document.getElementById("personalizacion");
ingreso_enlace1 = document.getElementById("enlace1");
Dropzone.autoDiscover = false;
formDrop1 = configurarDropZone(ingreso_enlace1, "");
dropzone1 = new Dropzone("div#formDrop", formDrop1);
ingreso_enlace1.addEventListener('input', () => {
  validaciónIngresoEnlace(ingreso_enlace1, dropzone1);
});
opciones_tamaño = "";
fila.id = "seccion_tamaño";
estilo_txtImgNoValida = document.createElement("style");
estilo_noMasImg = document.createElement("style");
estilo_contenedorPreImg = document.createElement("style");
estilo_txtImgNoValida.id = "est_txtImgNoValida";
estilo_contenedorPreImg.id = "est_contPreImg";
inputs_forma = document.getElementsByName("forma");
estilo_contenedorPreImg.innerHTML = `
.dropzone{
  border: 0px;
}
`;
estilo_txtImgNoValida.innerHTML = `
.txtImgNoValida{
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
    acceptedFiles: ".jpg,.jpeg,.png,.gif",
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
        contenedor_preImg.style = "width: 222px; height: 200px;";
        contenedor_preImg.parentNode.style = "width: 222px; height: 200px; margin: 0px !important;";
        contenedor_preImg.children[0].style = "width: 222px; height: 200px";
        document.head.appendChild(estilo_contenedorPreImg);
        previsualizacion.style = "width: 100%; height: 100%;";
        dzProgress.style = "display: none;";
        dzSize.style = "display: none;";
        if (imagenAdicional == "") {
          if (this.options.maxFiles == 1) {
            AgregarMásContenido();
          }
        }
        if (file.name.includes("http") || file.name.includes("data:image")) {
          previsualizacion.src = file.name;
          this.options.maxFiles = 0;
          if (imagenAdicional != "") {
            document.getElementsByClassName("aux_IngresarEnlace")[1].value = file.name;
          } else {
            document.getElementsByClassName("aux_IngresarEnlace")[0].value = file.name;
          }
        }
      });
      this.on("error", function (file, errorMessage) {
        imgNoValida("archivo", file);
        this.removeFile(file);
      });
      this.on("success", function (file, response) {
        ingreso_enlace.style = "z-index: -1;";
      });
      this.on("complete", function (file) {
        let myData = ultimaImgIngresada();
        myData.then(result => {
          previsualizacion = file.previewElement.querySelector("img");
          if (result.name != undefined) {
            var nombres = Object.keys(result.name);
            previsualizacion.src = "../imagenes/Productos/" + nombres[1];
          }
        });

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
      img.addEventListener('error', (error) => {
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
        img.addEventListener('error', (error) => {
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
function disminuirCantidadP() {
  let str = "";
  seccion_forma1 = document.getElementById("seccion_forma1");
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
      if (cantidadInput.value == 1) {
        let elem = inputs[i].parentElement.parentElement;
        elem = elem.nextElementSibling;
        while (elem != null) {
          elem.previousElementSibling.remove();
          if (elem.nextElementSibling == null) {
            elem.remove();
            break;
          } else {
            elem = elem.nextElementSibling;
          }
        }
      }
      break;
    }
  }
  if (cantidadInput.value == 1) {
    texto_dedicatoria = document.getElementById("texto_dedicatoria");
    texto_dedicatoria.innerHTML = "<b>Dedicatoria para el pedido:</b>";
    colSelect.style = "display:none";
    personalizacion.firstElementChild.insertAdjacentHTML("beforeend", contenidoUnPastel());
    document.getElementById("sin_imgEspecífica").checked = true;
  }
}
function aumentarCantidadP() {
  let str = "";
  personalizacion.firstElementChild.children[0].firstElementChild.colSpan = "3";
  personalizacion.firstElementChild.children[1].firstElementChild.colSpan = "3";
  seccion_forma1 = document.getElementById("seccion_forma1");
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
  if (seccion_forma1 != null) {
    let elem = seccion_forma1.nextElementSibling;
    while (elem != null) {
      elem.previousElementSibling.remove();
      if (elem.nextElementSibling == null) {
        elem.remove();
        break;
      } else {
        elem = elem.nextElementSibling;
      }
    }
  }
  if (cantidadInput.value == "2") {
    console.log("AGREGO CONTENIDO");
    personalizacion.firstElementChild.insertAdjacentHTML("beforeend", `
                  <tr id="pregunta_misma_forma">
                    <th>¿Todos los pasteles son de la misma forma?</th>
                    <td colspan="2">
                      <input type="radio" id="igual_forma" onchange="opcionSel(event)" value="Sí" name="misma_forma" class="left">
                      <label for="igual_forma" class="right">Sí</label>          
                      <input type="radio" id="diferente_forma" onchange="opcionSel(event)" value="No" name="misma_forma" class="left">
                      <label for="diferente_forma" class="right">No</label>
                    </td>
                  </tr>
                  <tr id="seccion_forma2">
                    <th><p><b>Forma:</b></p></th>
                    <td colspan="2">
                      <select onchange="tamañoSel(event)" name="forma">
                        <option value="Redonda">Redonda</option>
                        <option value="Cuadrada">Cuadrada</option>
                        <option value="Rectangular">Rectangular</option>
                        <option value="Personalizada">Personalizada</option>
                      </select>
                    </td>
                  </tr>
                  <tr id="pregunta_mismo_tamaño">
                    <th>¿Todos los pasteles son del mismo tamaño?</th>
                    <td colspan="2">
                      <input type="radio" id="igual_tamaño" onchange="opcionSel(event)" value="Sí" name="mismo_tamaño" class="left">
                      <label for="igual_tamaño" class="right">Sí</label>          
                      <input type="radio" id="diferente_tamaño" onchange="opcionSel(event)" value="No" name="mismo_tamaño" class="left">
                      <label for="diferente_tamaño" class="right">No</label>
                    </td>
                  </tr>
    `);
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
  personalizacion.firstElementChild.insertAdjacentHTML("beforeend", `            
  <tr>
                    <th>Ingrese el número de pasteles que se encuentra en el modelo:</th>
                    <td colspan="2">
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
                    <td>
                        <div id="cuadros_dedicatoria">
                            <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
                        </div>
                    </td>
                </tr>
                `+ contenidoUnPastel() + `
  `);
  document.getElementById("sin_imgEspecífica").checked = true;
  cantidadInput = document.getElementById("cantidad");
}
function contenidoUnPastel() {
  return `
                <tr id="seccion_forma1">
                  <th><p><b>Forma:</b></p></th>
                  <td>
                    <select onchange="tamañoSel(event)" name="forma">
                      <option value="Redonda">Redonda</option>
                      <option value="Cuadrada">Cuadrada</option>
                      <option value="Rectangular">Rectangular</option>
                      <option value="Personalizada">Personalizada</option>
                    </select>
                  </td>
                </tr>
                `+contenido_seccion_tamaño()+`
                `+contenido_seccion_tipoPastel()+`
                `+contenido_seccion_sabor()+`
                `+contenido_seccion_cobertura()+`
                `+contenido_seccion_relleno()+`
                <tr id="pregunta_imagenEspecífica">
                  <th><p><b>¿Desea un dibujo/imagen especial en el pastel?</b></p></th>
                  <td>
                    <input type="radio" id="con_imgEspecífica" onchange="opcionSel(event)" value="Sí" name="imgEspecífica" class="left">
                    <label for="con_imgEspecífica" class="right">Sí</label>
                    <input type="radio" id="sin_imgEspecífica" onchange="opcionSel(event)" value="No" name="imgEspecífica" class="left">
                    <label for="sin_imgEspecífica" class="right">No</label>
                  </td>
                </tr>
                <tr id="pregunta_fig_adorno">
                  <th>¿El modelo escogido tiene una figura / adorno en fondant o desea incluirla?</th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_fig_adEnFondant" name="fig_adEnFondant">
                      <option value="No">No</option>
                      <option value="Incluir figura">Incluir figura</option>
                      <option value="Incluir adorno">Incluir adorno</option>
                      <option value="Incluir figura y adorno">Incluir figura y adorno</option>
                      <option value="El modelo incluye una figura">El modelo incluye una figura</option>
                      <option value="El modelo incluye un adorno">El modelo incluye un adorno</option>
                      <option value="El modelo incluye ambos">El modelo incluye ambos</option>
                    </select>
                  </td>
                </tr>
                <tr id="espAdicional">
                  <th>Especificación adicional:</th>
                  <td id="secdescrAdicional">
                    <textarea name="descrAdicional" id="descrAdicional" placeholder="(Opcional)" onclick="quitarPlaceHolder(event)"></textarea>
                  </td>
                </tr>
                <tr id="seccion_precio">
                  <td colspan="2">
                    <h2>Precio: $5</h2>
                  </td>
                </tr>
                <tr id="seccion_envío">
                  <td colspan="2">
                    <button>Añadir al carrito</button>
                  </td>
                </tr>
                <tr id="seccion_nota">
                  <td colspan="2">
                    <h3>Nota: Para otras especificaciones puede comunicarse al 0988363503. Tenga en cuenta que especificaciones más complejas podrían conllevar cambios en el precio.</h3>
                  </td>
                </tr>
  `;
}
function contenido_seccion_tamaño(){
  return `
  <tr id="seccion_tamaño">
                  <th><p><b>Tamaño:</b></p></th>
                  <td>
                    <select id="opciones_tamaño" name="tamaño">
                      <option value="Mini (5-6 personas)">Mini (5-6 personas)</option>
                      <option value="Pequeña (10-12 personas)">Pequeña (10-12 personas)</option>
                      <option value="Mediana (16 personas)">Mediana (16 personas)</option>
                      <option value="Grande (30 personas)">Grande (30 personas)</option>
                      <option value="Extra grande (70 personas)">Extra grande (70 personas)</option>
                    </select>
                  </td>
                </tr>
  `;
}
function contenido_seccion_tipoPastel(){
  return `
  <tr id="seccion_tipoPastel">
                  <th><p><b>Tipo de pastel:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_pastel" name="masa">
                      <option value="Normal (Con receta propia)">Normal (Con receta propia)</option>
                      <option value="Bizcochuelo">Bizcochuelo</option>
                      <option value="Milhojas">Milhojas</option>
                      <option value="Cheesecake">Cheesecake</option>
                      <option value="Mousse">Mousse</option>
                      <option value="Tres leches">Tres leches</option>
                    </select>
                  </td>
                </tr>
  `;
}
function contenido_seccion_sabor(){
  return `
  <tr id="seccion_sabor">
                  <th><p><b>Sabor:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_sabor" name="sabor">
                      <option value="Naranja">Naranja</option>
                      <option value="Chocolate">Chocolate</option>
                      <option value="Naranja y chocolate (Marmoleada)">Naranja y chocolate (Marmoleada)</option>
                      <option value="4" style="display:none">4</option>
                      <option value="5" style="display:none">5</option>
                      <option value="6" style="display:none">6</option>
                    </select>
                  </td>
                </tr>
  `;
}
function contenido_seccion_cobertura(){
  return `
  <tr id="seccion_cobertura">
                  <th><p><b>Cobertura:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_cobertura" name="cobertura">
                      <option value="Crema">Crema</option>
                      <option value="Fondant">Fondant</option>
                      <option value="Ninguna">Ninguna</option>
                    </select>
                  </td>
                </tr>
  `;
}
function contenido_seccion_relleno(){
  return `
  <tr id="seccion_relleno">
                  <th><p><b>Relleno:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_relleno" name="relleno">
                      <option value="Mermelada de frutilla">Mermelada de frutilla</option>
                      <option value="Mermelada de mora">Mermelada de mora</option>
                      <option value="Glass de frutilla con crema">Glass de frutilla con crema</option>
                      <option value="Crema napolitana">Crema napolitana</option>
                      <option value="Durazno con crema">Durazno con crema</option>
                      <option value="Ninguno">Ninguno</option>
                    </select>
                  </td>
                </tr>
  `;
}
function opcionSel(event) {
  switch (event.target.id) {
    case "igual_forma":
      let dif_forma = document.getElementsByTagName("tbody");
      if (dif_forma.length == 4) {
        dif_forma[3].remove();
      }

      break;
    case "diferente_forma":
      let str = "";
      seccion_forma2=document.getElementById("seccion_forma2");
      seccion_forma2.style = "display: none";
      for (let i = 0; i <= cantidadInput.value; i++) {
        str += '<option value="' + i + '">' + i + '</option>';
      }
      event.target.parentElement.parentElement.insertAdjacentHTML("afterend", `
                  <tr>
                      <th>Nro. de pasteles circulares</th>
                      <td colspan="2">
                        <select id="num_circulares" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles cuadrados</th>
                      <td colspan="2">
                        <select id="num_cuadradas" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles rectangulares</th>
                      <td colspan="2">
                        <select id="num_rectangulares" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles con forma personalizada</th>
                      <td colspan="2">
                        <select id="num_personalizadas" onchange="diferentesFormas(event)" name="forma_pasteles">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
      `);
      break;
    case "mismo_tamaño":
      console.log(event.target.parentElement.parentElement);
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
    case "con_imgEspecífica":
      event.target.parentElement.parentElement.insertAdjacentHTML("afterend", `
                <tr class="seccion_imgEspecífica">
                  <th>Textura:</th>            
                  <td>
                    <select onchange="opcionSel(event)" id="opciones_imgEspecífica" name="imgEspecífica">
                      <option value="Papel comestible">Papel comestible</option>
                      <option value="Crema">Crema</option>
                      <option value="Fondant">Fondant</option>
                    </select>
                  </td>
                </tr>          
                <tr class="seccion_imgEspecífica">
                  <th>Previsualización de dibujo/imagen:</th>
                  <td class="seccion_formDrop">
                    <div class="dropzone" id="formDrop2">
                      <input type="url" placeholder="Ingresar enlace" name="ingreso_enlace" class="para_enlace"  id="enlace2"
                      onclick="quitarPlaceHolder(event)">
                      <input type="hidden" name="enlace" class="aux_IngresarEnlace">
                    </div>
                  </td>
                </tr>
                
        `);
      ingreso_enlace2 = document.getElementById("enlace2");
      formDrop2 = configurarDropZone(ingreso_enlace2, "DibujoImgEspecial");
      dropzone2 = new Dropzone("div#formDrop2", formDrop2);
      ingreso_enlace2.addEventListener('input', () => {
        validaciónIngresoEnlace(ingreso_enlace2, dropzone2);
      });
      break;
    case "sin_imgEspecífica":
      console.log(document.getElementsByClassName("seccion_imgEspecífica"));
      document.getElementsByClassName("seccion_imgEspecífica")[0].remove();
      document.getElementsByClassName("seccion_imgEspecífica")[0].remove();

      break;
  }
  switch (event.target.name) {
    case "masa":
      seccion_relleno = document.getElementById("seccion_relleno");
      sabor = document.getElementById("opciones_sabor").children;
      seccion_sabor = document.getElementById("seccion_sabor");
      if (event.target.value != "Milhojas") {
        seccion_sabor.removeAttribute("style");
        if (event.target.value != "Mousse") {
          sabor[1].value = "Chocolate";
          sabor[1].innerHTML = "Chocolate";
          sabor[3].style = "display:none";
          sabor[4].style = "display:none";
          sabor[5].style = "display:none";
        }
      }
      if (event.target.value != "Normal (Con receta propia)" && event.target.value != "Bizcochuelo" && event.target.value != "Milhojas") {
        seccion_relleno.style = "display:none";
      } else {
        seccion_relleno.removeAttribute("style");
      }
      break;
    case "fig_adEnFondant":
      img_figura = document.getElementById("img_figura");
      img_adorno = document.getElementById("img_adorno");
      if (event.target.value == "No") {
        removerDropsAdicionales();
      }
      break;
  }
  switch (event.target.value) {
    case "Normal (Con receta propia)":
      sabor[0].value = "Naranja";
      sabor[0].innerHTML = "Naranja";
      sabor[2].value = "Naranja y chocolate (Marmoleada)";
      sabor[2].innerHTML = "Naranja y chocolate (Marmoleada)";
      sabor[2].removeAttribute("style");
      break;
    case "Bizcochuelo":
    case "Cheesecake":
      sabor[0].value = "Vainilla";
      sabor[0].innerHTML = "Vainilla";
      sabor[2].style = "display: none";
      break;
    case "Milhojas":
      seccion_sabor.style = "display:none";
      break;
    case "Mousse":
      sabor[0].value = "Fresa";
      sabor[0].innerHTML = "Fresa";
      sabor[1].value = "Naranja";
      sabor[1].innerHTML = "Naranja";
      sabor[2].value = "Maracuyá";
      sabor[2].innerHTML = "Maracuyá";
      sabor[3].value = "Limón";
      sabor[3].innerHTML = "Limón";
      sabor[3].removeAttribute("style");
      sabor[4].value = "Uva";
      sabor[4].innerHTML = "Uva";
      sabor[4].parentElement.removeAttribute("style");
      sabor[5].value = "Manzana";
      sabor[5].innerHTML = "Manzana";
      sabor[5].removeAttribute("style");
      break;
    case "Incluir figura":
      if (img_adorno != null) {
        img_adorno.remove();
      }
      if (img_figura == null) {
        seccionFigura(event);
      }
      break;
    case "Incluir adorno":
      if (img_figura != null) {
        img_figura.remove();
      }
      if (img_adorno == null) {
        seccionAdorno(event);
      }
      break;
    case "Incluir figura y adorno":
      removerDropsAdicionales();
      seccionFigura(event);
      seccionAdorno(event);
      break;
    case "Tres leches":
      seccion_sabor.style = "display:none";
      break;
  }
  if (event.target.value.includes("modelo")) {
    removerDropsAdicionales();
  }
}
function removerDropsAdicionales() {
  if (img_figura != null) {
    img_figura.remove();
  }
  if (img_adorno != null) {
    img_adorno.remove();
  }
}
function seccionFigura(event) {
  event.target.parentElement.parentElement.insertAdjacentHTML("afterend", `
  <tr id="img_figura">
    <th>Previsualización de figura:</th>
    <td class="seccion_formDrop">
      <div class="dropzone" id="formDrop3">
      <input type="url" placeholder="Ingresar enlace" name="ingreso_enlace" class="para_enlace"  id="enlace3"
      onclick="quitarPlaceHolder(event)">
      <input type="hidden" name="enlace" class="aux_IngresarEnlace">
      </div>
    </td>
  </tr>
`);

  ingreso_enlace3 = document.getElementById("enlace3");
  formDrop3 = configurarDropZone(ingreso_enlace3, "Figura");
  dropzone3 = new Dropzone("div#formDrop3", formDrop3);
  ingreso_enlace3.addEventListener('input', () => {
    validaciónIngresoEnlace(ingreso_enlace3, dropzone3);
  });
}
function seccionAdorno(event) {
  event.target.parentElement.parentElement.insertAdjacentHTML("afterend", `
                  <tr id="img_adorno">
                    <th>Previsualización de adorno:</th>
                    <td class="seccion_formDrop">
                      <div class="dropzone" id="formDrop4">
                      <input type="url" placeholder="Ingresar enlace" name="ingreso_enlace" class="para_enlace" id="enlace4"
                      onclick="quitarPlaceHolder(event)">
                      <input type="hidden" name="enlace" class="aux_IngresarEnlace">
                      </div>
                    </td>
                  </tr>
            `);
  ingreso_enlace4 = document.getElementById("enlace4");
  formDrop4 = configurarDropZone(ingreso_enlace4, "Adorno");
  dropzone4 = new Dropzone("div#formDrop4", formDrop4);
  ingreso_enlace4.addEventListener('input', () => {
    validaciónIngresoEnlace(ingreso_enlace4, dropzone4);
  });
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
  opciones_tamaño = `
<option value="`+ tamaño1 + `">` + tamaño1 + `</option>
<option value="`+ tamaño2 + `">` + tamaño2 + `</option>
`;
  if (event.target.value == "Cuadrada") {
    opciones_tamaño += `<option value="` + tamaño3 + `">` + tamaño3 + `</option>`;
  } else {
    if (event.target.value == "Personalizada" || event.target.value == "Redonda") {
      opciones_tamaño += `
      <option value="`+ tamaño3 + `">` + tamaño3 + `</option>
      <option value="`+ tamaño4 + `">` + tamaño4 + `</option>
      <option value="`+ tamaño5 + `">` + tamaño5 + `</option>
      `;
    }
  }
  if (cantidadInput.value == 1) {
    document.getElementById("opciones_tamaño").innerHTML = opciones_tamaño;
  }
}