let formDrop1, formDrop2, formDrop3, formDrop4,
  dropzone1, dropzone2, dropzone3, dropzone4,
  ingreso_enlace1, ingreso_enlace2, ingreso_enlace3, ingreso_enlace4,
  dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg, contenedor_preImg,
  personalizacion, cantidadInput, texto_dedicatoria, cantidad_pasteles, seleccionables, div_elem,
  contenido_opciones_tamaño, img_figura, img_adorno, inputs_radio, precio, contenedor_select, suma_formas, array_tipoPasteles, elems_masa,
  tamaño1, tamaño2, tamaño3, tamaño4, tamaño5,
  seccion_sabor, seccion_relleno, seccion_forma,
  pregunta_mismo_tipo, pregunta_mismo_tamaño, pregunta_mismo_sabor, pregunta_mismo_relleno, pregunta_misma_cobertura, pregunta_imagenEspecífica,
  diferente_tamaño, diferente_forma, diferente_tipo,
  misma_forma, mismo_tamaño,misma_cobertura,
  select_sabor, select_relleno;
array_tipoPasteles = [];
personalizacion = document.getElementById("personalizacion");
ingreso_enlace1 = document.getElementById("enlace1");
div_elem = document.createElement("div");
select_sabor = document.createElement("select");
select_relleno = document.createElement("select");
estilo_txtImgNoValida = document.createElement("style");
estilo_noMasImg = document.createElement("style");
estilo_contenedorPreImg = document.createElement("style");
estilo_txtImgNoValida.id = "est_txtImgNoValida";
estilo_contenedorPreImg.id = "est_contPreImg";
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
select_sabor.onchange = opcionSel;
select_relleno.onchange = opcionSel;
select_sabor.name = "sabor";
select_relleno.name = "relleno";
document.addEventListener('DOMContentLoaded', function () { resetearDivElem(); resetearSelectSabor(); resetearSelectRelleno(); });
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
      this.on("success", function (_file, _response) {
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
function disminuirCantidadP() {
  let str = "";
  if (diferente_tamaño.checked) {
    for (let i = 0; i < suma_formas; i++) {
      pregunta_mismo_tamaño.nextElementSibling.remove();
    }
  }
  seccion_forma = document.getElementById("seccion_forma");
  seleccionables = document.getElementsByName("forma");
  if (cantidadInput.value >= 2) {
    cantidadInput.value = parseInt(cantidadInput.value) - 1;
  }
  DedicatoriasP(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML = `
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
  `;
  opcionSel(event);
  if (diferente_forma != null) {
    if (diferente_forma.checked) {
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
    personalizacion.firstElementChild.insertAdjacentHTML("beforeend", contenidoUnPastel());
    document.getElementById("sin_imgEspecífica").checked = true;
    contenedor_select.style = "display:none";
  }
  if (diferente_tamaño.checked) {
    if (misma_forma.checked) {
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
      diferenteTamaño(false, div_elem.children);
      resetearDivElem();
    } else {
      diferenteTamaño(false, seleccionables);
    }
  } else {
    if (diferente_forma.checked) {
      diferenteTamaño(true, seleccionables);
    }
  }
  if(cantidadInput.value>1){
    actualizarDesdeTipo();
  } 
}
function aumentarCantidadP() {
  let str = "";
  seccion_forma = document.getElementById("seccion_forma");
  seleccionables = document.getElementsByName("forma");
  cantidadInput.value = parseInt(cantidadInput.value) + 1;
  DedicatoriasP(cantidadInput);
  document.getElementById("cuadros_dedicatoria").innerHTML = `
  <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
  `;
  opcionSel(event);
  texto_dedicatoria = document.getElementById("texto_dedicatoria");
  texto_dedicatoria.innerHTML = "<b>Cantidad de dedicatorias:</b>";
  if (cantidadInput.value == "2") {
    if (seccion_forma != null) {
      let elem = seccion_forma.nextElementSibling;
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

    personalizacion.firstElementChild.insertAdjacentHTML("beforeend", `
                  <tr id="pregunta_misma_forma">
                    <th>¿Todos los pasteles son de la misma forma?</th>
                    <td colspan="1">
                      <input type="radio" id="misma_forma" onchange="opcionSel(event)" value="Sí" name="misma_forma" class="left">
                      <label for="misma_forma" class="right">Sí</label>          
                      <input type="radio" id="diferente_forma" onchange="opcionSel(event)" value="No" name="misma_forma" class="left">
                      <label for="diferente_forma" class="right">No</label>
                    </td>
                  </tr>
                  `+ contenido_seccion_forma() + `
                  </tr>
                  <tr id="pregunta_mismo_tamaño">
                    <th>¿Todos los pasteles son del mismo tamaño?</th>
                    <td colspan="1">
                      <input type="radio" id="mismo_tamaño" onchange="opcionSel(event)" value="Sí" name="mismo_tamaño" class="left">
                      <label for="mismo_tamaño" class="right">Sí</label>          
                      <input type="radio" id="diferente_tamaño" onchange="opcionSel(event)" value="No" name="mismo_tamaño" class="left">
                      <label for="diferente_tamaño" class="right">No</label>
                    </td>
                  </tr>`+ contenido_seccion_tamaño() + `
                  <tr id="pregunta_mismo_tipo">
                    <th>¿Desea que todos los pasteles sean del mismo tipo?</th>
                    <td colspan="1">
                      <input type="radio" id="mismo_tipo" onchange="opcionSel(event)" value="Sí" name="mismo_tipo" class="left">
                      <label for="mismo_tipo" class="right">Sí</label>          
                      <input type="radio" id="diferente_tipo" onchange="opcionSel(event)" value="No" name="mismo_tipo" class="left">
                      <label for="diferente_tipo" class="right">No</label>
                    </td>
                  </tr>`+ contenido_seccion_tipoPastel(false, true, 0, false, false, false, false, false, false) + `
                  <tr id="pregunta_mismo_sabor">
                  <th>¿Desea que todos los pasteles tengan el mismo sabor?</th>
                    <td colspan="1">
                      <input type="radio" id="mismo_sabor" onchange="opcionSel(event)" value="Sí" name="mismo_sabor" class="left">
                      <label for="mismo_sabor" class="right">Sí</label>          
                      <input type="radio" id="diferente_sabor" onchange="opcionSel(event)" value="No" name="mismo_sabor" class="left">
                      <label for="diferente_sabor" class="right">No</label>
                    </td>
                  </tr>`+ contenido_seccion_sabor() + `
                  <tr id="pregunta_misma_cobertura">
                  <th>¿Desea que todos los pasteles tengan el mismo tipo de cobertura?</th>
                    <td colspan="1">
                      <input type="radio" id="misma_cobertura" onchange="opcionSel(event)" value="Sí" name="misma_cobertura" class="left">
                      <label for="misma_cobertura" class="right">Sí</label>          
                      <input type="radio" id="diferente_cobertura" onchange="opcionSel(event)" value="No" name="misma_cobertura" class="left">
                      <label for="diferente_cobertura" class="right">No</label>
                    </td>
                  </tr>`+ contenido_seccion_cobertura() + `
                  <tr id="pregunta_mismo_relleno">
                  <th>¿Desea que todos los pasteles tengan el mismo relleno?</th>
                    <td colspan="1">
                      <input type="radio" id="mismo_relleno" onchange="opcionSel(event)" value="Sí" name="mismo_relleno" class="left">
                      <label for="mismo_relleno" class="right">Sí</label>          
                      <input type="radio" id="diferente_relleno" onchange="opcionSel(event)" value="No" name="mismo_relleno" class="left">
                      <label for="diferente_relleno" class="right">No</label>
                    </td>
                  </tr>`+ contenido_seccion_relleno() + `
                  `+ contenido_pregunta_imagenEspecífica(2) + `
                  `+ contenido_pregunta_fig_adorno() + `
                  `+ contenido_adicional(1) + `
    `);
    elems_masa = document.getElementsByName("masa");
    elems_masa[0].onchange = function () { tipoPasteles(event, true, 0, true, true, true, false, false); };
    inputs_radio = document.querySelectorAll("input[type='radio']");
    for (let i = 0; i < inputs_radio.length; i += 2) {
      if (i + 2 >= inputs_radio.length) {
        inputs_radio[i + 1].checked = true;
      } else {
        inputs_radio[i].checked = true;
      }
    }
    seccion_forma = document.getElementById("seccion_forma");
    mismo_tamaño = document.getElementById("mismo_tamaño");
    misma_forma = document.getElementById("misma_forma");
    misma_cobertura = document.getElementById("misma_cobertura");
    diferente_tamaño = document.getElementById("diferente_tamaño");
    diferente_forma = document.getElementById("diferente_forma");
    diferente_tipo = document.getElementById("diferente_tipo");
    pregunta_mismo_tamaño = document.getElementById("pregunta_mismo_tamaño");
    pregunta_mismo_tipo = document.getElementById("pregunta_mismo_tipo");
    pregunta_mismo_sabor = document.getElementById("pregunta_mismo_sabor");
    pregunta_mismo_relleno = document.getElementById("pregunta_mismo_relleno");
    pregunta_misma_cobertura = document.getElementById("pregunta_misma_cobertura");
    pregunta_imagenEspecífica = document.getElementById("pregunta_imagenEspecífica");
  }
  precio = document.getElementById("precio");
  contenedor_select.removeAttribute("style");

  if (diferente_forma.checked) {
    for (let i = 0; i <= cantidadInput.value; i++) {
      str += '<option value="' + i + '">' + i + '</option>';
    }
    for (let j = 0; j < seleccionables.length; j++) {
      seleccionables[j].innerHTML = str;
    }
  }
  if (diferente_tamaño.checked) {
    if (misma_forma.checked) {
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
      diferenteTamaño(false, div_elem.children);
      resetearDivElem();
    } else {
      diferenteTamaño(false, seleccionables);
    }
  } else {
    if (diferente_forma.checked) {
      diferenteTamaño(true, seleccionables);
    }
  }
  actualizarDesdeTipo();
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
  contenedor_select.innerHTML = `
  <select id="num_dedicatorias" onchange="AgregarHermanosSelect()">
`+ html_aux1 + `
</select>`;
}
function AgregarHermanosSelect(arreglo_dedicatorias) {
  let límite;
  let dedicatoria = "";
  html_aux2 = "";
  dedicatoria = document.getElementsByName("dedicatoria");
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
                    <td colspan="1">
                        <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadP()">
                        <input type="number" id="cantidad" name="cantidad" value="1" readonly>
                        <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadP()">
                    </td>
                </tr>
                <tr id="seccion_dedicatorias">
                    <th>
                        <p id="texto_dedicatoria"><b>Dedicatoria para el pedido:</b></p>
                    </th>
                    <td>
                        <div id="contenedor_select" style="display:none"></div>
                        <div id="cuadros_dedicatoria">
                            <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" onclick="quitarPlaceHolder(event)">
                        </div>
                    </td>
                </tr>
                `+ contenidoUnPastel() + `
  `);
  document.getElementById("sin_imgEspecífica").checked = true;
  cantidadInput = document.getElementById("cantidad");
  contenedor_select = document.getElementById("contenedor_select");
}
function contenidoUnPastel() {
  return `
                `+ contenido_seccion_forma() + `
                `+ contenido_seccion_tamaño() + `
                `+ contenido_seccion_tipoPastel(false, true, 0, false, false, false, true, false, false) + `
                `+ contenido_seccion_sabor() + `
                `+ contenido_seccion_cobertura() + `
                `+ contenido_seccion_relleno() + `
                `+ contenido_pregunta_imagenEspecífica(1) + `
                `+ contenido_pregunta_fig_adorno() + `
                `+ contenido_adicional(1) + `
  `;
}
function contenido_seccion_forma() {
  return `
                <tr id="seccion_forma">
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
  `;
}
function contenido_seccion_tamaño() {
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
function contenido_seccion_tipoPastel(select, sabor, num_select, retorno_vacio, ver_mismo_relleno, ver_mismo_sabor, contenido_onchange, difTipo, difForma) {
  let str_aux1 = `
<tr id="seccion_tipoPastel">
                  <th><p><b>Tipo de pastel:</b></p></th>
                  <td>
`;
  let str_aux2 = `
</td>
</tr>
`;
  if (select == true) {
    str_aux1 = "";
    str_aux2 = "";
  }
  if (contenido_onchange) {
    contenido_onchange = ` onchange="tipoPasteles(event, ` + sabor + `,` + num_select + `,` + retorno_vacio + `,` + ver_mismo_relleno + `,` + ver_mismo_sabor + `,` + difTipo + `,` + difForma + `)" `;
  } else {
    contenido_onchange = " ";
  }
  return `
                `+ str_aux1 + `
                    <select`+ contenido_onchange + `id="opciones_pastel" name="masa">
                      <option value="Normal (Con receta propia)">Normal (Con receta propia)</option>
                      <option value="Normal (Con premezcla)">Normal (Con premezcla)</option>
                      <option value="Especial (Con frutos secos)">Especial (Con frutos secos)</option>
                      <option value="Bizcochuelo">Bizcochuelo</option>
                      <option value="Milhojas">Milhojas</option>
                      <option value="Cheesecake">Cheesecake</option>
                      <option value="Mousse">Mousse</option>
                      <option value="Tres leches">Tres leches</option>
                    </select>
                `+ str_aux2 + `
  `;
}
function contenido_seccion_sabor() {
  return `
                <tr id="seccion_sabor">
                  <th><p><b>Sabor:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" name="sabor">
                      `+ select_sabor.innerHTML + `
                    </select>
                  </td>
                </tr>
  `;
}
function contenido_seccion_cobertura() {
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
function contenido_seccion_relleno() {
  return `
                <tr id="seccion_relleno">
                  <th><p><b>Relleno:</b></p></th>
                  <td>
                    <select onchange="opcionSel(event)" name="relleno">
                      `+ select_relleno.innerHTML + `
                    </select>
                  </td>
                </tr>
  `;
}
function contenido_pregunta_imagenEspecífica(num_col) {
  let str_aux;
  if (num_col == 1) {
    str_aux = "el";
  } else {
    str_aux = "algún";
  }
  return `
<tr id="pregunta_imagenEspecífica">
  <th><p><b>¿Desea un dibujo/imagen especial en `+ str_aux + ` pastel?</b></p></th>
  <td>
    <input type="radio" id="con_imgEspecífica" onchange="opcionSel(event)" value="Sí" name="imgEspecífica" class="left">
    <label for="con_imgEspecífica" class="right">Sí</label>
    <input type="radio" id="sin_imgEspecífica" onchange="opcionSel(event)" value="No" name="imgEspecífica" class="left">
    <label for="sin_imgEspecífica" class="right">No</label>
  </td>
</tr>
  `;
}
function contenido_pregunta_fig_adorno(num_col) {
  return `
                <tr id="pregunta_fig_adorno">
                  <th>¿El modelo escogido tiene o desea incluir una figura / adorno en fondant?</th>
                  <td colspan="`+ num_col + `">
                    <select onchange="opcionSel(event)" id="opciones_fig_adEnFondant" name="fig_adEnFondant">
                      <option value="No">No</option>
                      <option value="Incluir figura">Incluir figura</option>
                      <option value="Incluir adorno">Incluir adorno</option>
                      <option value="Incluir adorno y figura">Incluir adorno y figura</option>
                      <option value="El modelo incluye una figura">El modelo incluye una figura</option>
                      <option value="El modelo incluye un adorno">El modelo incluye un adorno</option>
                      <option value="El modelo incluye ambos">El modelo incluye ambos</option>
                    </select>
                  </td>
                </tr>
  `;
}
function contenido_adicional(num_col) {
  return `
                <tr id="espAdicional">
                  <th>Especificación adicional:</th>
                  <td colspan="`+ num_col + `">
                    <textarea name="descrAdicional" id="descrAdicional" placeholder="(Opcional)" onclick="quitarPlaceHolder(event)"></textarea>
                  </td>
                </tr>
                <tr id="seccion_precio">
                  <td colspan="`+ (num_col + 1) + `">
                    <h2 id="precio">Precio: $5</h2>
                  </td>
                </tr>
                <tr id="seccion_envío">
                  <td colspan="`+ (num_col + 1) + `">
                    <button>Añadir al carrito</button>
                  </td>
                </tr>
                <tr id="seccion_nota">
                  <td colspan="`+ (num_col + 1) + `">
                    <h3>Nota: Para otras especificaciones puede comunicarse al 0988363503. Tenga en cuenta que especificaciones más complejas podrían conllevar cambios en el precio.</h3>
                  </td>
                </tr>
  `;
}
function seccionFigura(event) {
  document.getElementById("pregunta_fig_adorno").insertAdjacentHTML("afterend", `
  <tr id="img_figura">
    <th>Opciones de figura:</th>
    <td>
      <select>
        <option value="Angel">Angel</option>
        <option value="Cruz">Cruz</option>
      </select>
    </td>
  </tr>
`);
}
function seccionAdorno(event) {
  event.target.parentElement.parentElement.insertAdjacentHTML("afterend", `
                  <tr id="img_adorno">
                    <th>Previsualización de adorno:</th>
                    <td class="seccion_formDrop">
                      <div class="dropzone" id="formDrop4">
                        <input type="url" placeholder="Ingresar enlace" name="ingreso_enlace" class="para_enlace" id="enlace4" onclick="quitarPlaceHolder(event)">
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
function opcionSel(event) {
  switch (event.target.name) {
    case "fig_adEnFondant":
      img_figura = document.getElementById("img_figura");
      img_adorno = document.getElementById("img_adorno");
      if (event.target.value == "No") {
        removerDropsAdicionales();
      }
      break;
  }
  switch (event.target.id) {
    case "misma_forma":
      while (event.target.parentElement.parentElement.nextElementSibling.id != "pregunta_mismo_tamaño") {
        event.target.parentElement.parentElement.nextElementSibling.remove();
      }
      event.target.parentElement.parentElement.insertAdjacentHTML("afterend", contenido_seccion_forma());
      pregunta_mismo_tamaño.firstElementChild.innerHTML = "¿Todos los pasteles son del mismo tamaño?";
      if (mismo_tamaño.checked == true) {
        while (pregunta_mismo_tamaño.nextElementSibling.id != "pregunta_mismo_tipo") {
          pregunta_mismo_tamaño.nextElementSibling.remove();
        }
        pregunta_mismo_tamaño.insertAdjacentHTML("afterend", contenido_seccion_tamaño());
      } else {
        seccion_forma = document.getElementById("seccion_forma");
        div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
        div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
        diferenteTamaño(false, div_elem.children);
        resetearDivElem();
      }
      seccion_forma = document.getElementById("seccion_forma");
      actualizarDesdeTipo();
      elems_masa = document.getElementsByName("masa");
      for (let i = 0; i < elems_masa.length; i++) {
        if (!mismo_sabor.checked) {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, diferente_tipo.checked, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, diferente_tipo.checked, diferente_forma.checked); };
          }
        } else {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, diferente_tipo.checked, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, diferente_tipo.checked, diferente_forma.checked); };
          }
        }
      }
      break;
    case "diferente_forma":
      let str = "";
      seccion_forma.remove();
      while (pregunta_mismo_tamaño.nextElementSibling.id != "pregunta_mismo_tipo") {
        pregunta_mismo_tamaño.nextElementSibling.remove();
      }
      for (let i = 0; i <= cantidadInput.value; i++) {
        str += '<option value="' + i + '">' + i + '</option>';
      }
      event.target.parentElement.parentElement.insertAdjacentHTML("afterend", `
                  <tr>
                      <th>Nro. de pasteles redondos</th>
                      <td colspan="2">
                        <select id="num_circulares" onchange="diferentesFormas(event)" name="forma">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles cuadrados</th>
                      <td colspan="2">
                        <select id="num_cuadradas" onchange="diferentesFormas(event)" name="forma">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles rectangulares</th>
                      <td colspan="2">
                        <select id="num_rectangulares" onchange="diferentesFormas(event)" name="forma">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <th>Nro. de pasteles con forma personalizada</th>
                      <td colspan="2">
                        <select id="num_personalizadas" onchange="diferentesFormas(event)" name="forma">
                        `+ str + `
                        </select>
                      </td>
                  </tr>
      `);
      if (mismo_tamaño.checked == true) {
        diferenteTamaño(true, seleccionables);
        pregunta_mismo_tamaño.firstElementChild.innerHTML = "¿Los pasteles son del mismo tamaño?";
      } else {
        diferenteTamaño(false, seleccionables);
      }
      actualizarDesdeTipo();
      elems_masa = document.getElementsByName("masa");
      for (let i = 0; i < elems_masa.length; i++) {
        if (!mismo_sabor.checked) {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, diferente_tipo.checked, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, diferente_tipo.checked, diferente_forma.checked); };
          }
        } else {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, diferente_tipo.checked, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, diferente_tipo.checked, diferente_forma.checked); };
          }
        }
      }
      break;
    case "mismo_tamaño":
      suma_formas = sumaPastelesDiferentes(seleccionables);
      if (misma_forma.checked == true) {
        while (event.target.parentElement.parentElement.nextElementSibling.id != "pregunta_mismo_tipo") {
          event.target.parentElement.parentElement.nextElementSibling.remove();
        }
        event.target.parentElement.parentElement.insertAdjacentHTML("afterend", contenido_seccion_tamaño());
        tamañoSel(seccion_forma.children[1].firstElementChild.value);
      } else {
        diferenteTamaño(true, seleccionables);
      }
      break;
    case "diferente_tamaño":
      if (misma_forma.checked) {
        div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
        div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
        diferenteTamaño(false, div_elem.children);
        resetearDivElem();
      } else {
        diferenteTamaño(false, seleccionables);
      }
      break;
    case "mismo_tipo":
      mostrar_mismo_tipo();
      break;
    case "diferente_tipo":
      mostrar_diferente_tipo();
      break;
    case "mismo_sabor":
      if (diferente_tipo.checked) {
        for (let i = 0; i < elems_masa.length; i++) {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, true, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, true, diferente_forma.checked); };
          }
        }
      } else {
        for (let i = 0; i < elems_masa.length; i++) {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, false, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, false, diferente_forma.checked); };
          }
        }
      }
      if (diferente_tipo.checked) {
        if (mismo_relleno.checked) {
          mostrar_mismo_relleno_difTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_relleno_difTipo(diferente_forma.checked);
        }
        mostrar_mismo_sabor_difTipo(diferente_forma.checked);
      } else {
        if (mismo_relleno.checked) {
          mostrar_mismo_relleno_mismTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_relleno_mismTipo(diferente_forma.checked);
        }
        mostrar_mismo_sabor_mismTipo(diferente_forma.checked);
      }
      break;
    case "diferente_sabor":
      elems_masa = document.getElementsByName("masa");
      if (diferente_tipo.checked) {
        for (let i = 0; i < elems_masa.length; i++) {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, true, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, true, diferente_forma.checked); };
          }
        }
      } else {
        for (let i = 0; i < elems_masa.length; i++) {
          if (mismo_relleno.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, false, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, false, diferente_forma.checked); };
          }
        }
      }
      if (diferente_tipo.checked) {
        if (mismo_relleno.checked) {
          mostrar_mismo_relleno_difTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_relleno_difTipo(diferente_forma.checked);
        }
        mostrar_diferente_sabor_difTipo(diferente_forma.checked);
      } else {
        if (mismo_relleno.checked) {
          mostrar_mismo_relleno_mismTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_relleno_mismTipo(diferente_forma.checked);
        }
        mostrar_diferente_sabor_mismTipo(diferente_forma.checked);
      }
      break;
    case "misma_cobertura":
      mostrar_misma_cobertura();
      break;
    case "diferente_cobertura":
      mostrar_diferente_cobertura();
      break;
    case "mismo_relleno":
      if (diferente_tipo.checked) {
        for (let i = 0; i < elems_masa.length; i++) {
          if (!mismo_sabor.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, true, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, true, diferente_forma.checked); };
          }
        }
      } else {
        for (let i = 0; i < elems_masa.length; i++) {
          if (!mismo_sabor.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, false, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, false, diferente_forma.checked); };
          }
        }
      }
      if (diferente_tipo.checked) {
        if (mismo_sabor.checked) {
          mostrar_mismo_sabor_difTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_sabor_difTipo(diferente_forma.checked);
        }
        mostrar_mismo_relleno_difTipo(diferente_forma.checked);
      } else {
        if (mismo_sabor.checked) {
          mostrar_mismo_sabor_mismTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_sabor_mismTipo(diferente_forma.checked);
        }
        mostrar_mismo_relleno_mismTipo(diferente_forma.checked);
      }
      break;
    case "diferente_relleno":
      elems_masa = document.getElementsByName("masa");
      if (diferente_tipo.checked) {
        for (let i = 0; i < elems_masa.length; i++) {
          if (!mismo_sabor.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, true, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, true, diferente_forma.checked); };
          }
        }
      } else {
        for (let i = 0; i < elems_masa.length; i++) {
          if (!mismo_sabor.checked) {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, false, diferente_forma.checked); };
          } else {
            elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, false, diferente_forma.checked); };
          }
        }
      }
      if (diferente_tipo.checked) {
        if (mismo_sabor.checked) {
          mostrar_mismo_sabor_difTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_sabor_difTipo(diferente_forma.checked);
        }
        mostrar_diferente_relleno_difTipo(diferente_forma.checked);
      } else {
        if (mismo_sabor.checked) {
          mostrar_mismo_sabor_mismTipo(diferente_forma.checked);
        } else {
          mostrar_diferente_sabor_mismTipo(diferente_forma.checked);
        }
        mostrar_diferente_relleno_mismTipo(diferente_forma.checked);
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
      document.getElementsByClassName("seccion_imgEspecífica")[0].remove();
      document.getElementsByClassName("seccion_imgEspecífica")[0].remove();
      break;
  }
  switch (event.target.value) {
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
    case "Incluir adorno y figura":
      removerDropsAdicionales();
      seccionFigura(event);
      seccionAdorno(event);
      break;
  }
  if (event.target.value.includes("modelo")) {
    removerDropsAdicionales();
    if(!event.target.value.includes("adorno")){
      seccionFigura(event);
      document.getElementById("espAdicional").insertAdjacentHTML("beforebegin",`
    <tr>
    <th colspan="2" style="color: #C43E00">Tenga en cuenta que la pastelería no dispone del personal para realizar otro tipo de figuras</th>
  </tr>
    `);
    }
  }
}
function tipoPasteles(event, sabor, num_select, retorno_vacio, ver_mismo_relleno, ver_mismo_sabor, difTipo, difForma) {
  let sabor_aux = sabor;
  let tipo_pastel;
  if (sabor_aux == true) {
    if (typeof retorno_vacio == "boolean") {
      if (retorno_vacio) {
        if (difTipo) {
          if (ver_mismo_relleno) {
            mostrar_mismo_relleno_difTipo(difForma);
          } else {
            mostrar_diferente_relleno_difTipo(difForma);
          }
          if (ver_mismo_sabor) {
            mostrar_mismo_sabor_difTipo(difForma);
          } else {
            mostrar_diferente_sabor_difTipo(difForma);
          }
        } else {
          if (ver_mismo_relleno) {
            mostrar_mismo_relleno_mismTipo(difForma);
          } else {
            mostrar_diferente_relleno_mismTipo(difForma);
          }
          if (ver_mismo_sabor) {
            mostrar_mismo_sabor_mismTipo(difForma);
          } else {
            mostrar_diferente_sabor_mismTipo(difForma);
          }
        }
        return "";
      }
    }

    tipo_pastel = event.target.value;
    if (document.getElementsByName("sabor")[num_select] != undefined) {
      sabor = document.getElementsByName("sabor")[num_select].children;
    } else {
      return "";
    }
    if (document.getElementsByName("relleno")[num_select] != undefined) {
      seccion_relleno = document.getElementsByName("relleno")[num_select].parentElement.parentElement;
    }
    if (document.getElementsByName("sabor")[num_select] != undefined) {
      seccion_sabor = document.getElementsByName("sabor")[num_select].parentElement.parentElement;
    }
  } else {
    tipo_pastel = event;
    sabor = sabor.children;
  }
  if (tipo_pastel != "Milhojas") {
    if (seccion_sabor != undefined) {
      seccion_sabor.removeAttribute("style");
    }
    if (tipo_pastel != "Mousse") {
      sabor[1].value = "Chocolate";
      sabor[1].innerHTML = "Chocolate";
      sabor[3].style = "display:none";
      sabor[4].style = "display:none";
      sabor[5].style = "display:none";
    }
  }
  if (seccion_relleno != undefined) {
    if (tipo_pastel == "Mousse" || tipo_pastel == "Tres leches" || tipo_pastel == "Cheesecake") {
      seccion_relleno.style = "display:none";
    } else {
      seccion_relleno.removeAttribute("style");
    }
  }
  switch (tipo_pastel) {
    case "Normal (Con receta propia)":
    case "Normal (Con premezcla)":
    case "Especial (Con frutos secos)":
      sabor[0].value = "Naranja";
      sabor[0].innerHTML = "Naranja";
      modificarSabor(sabor[2],"Naranja y chocolate (Marmoleada)");
      modificarSabor(sabor[3],"Vainilla");
      modificarSabor(sabor[4],"Maracuyá");
      break;
    case "Bizcochuelo":
    case "Cheesecake":
      sabor[0].value = "Vainilla";
      sabor[0].innerHTML = "Vainilla";
      sabor[2].style = "display: none";
      break;
    case "Mousse":
      sabor[0].value = "Fresa";
      sabor[0].innerHTML = "Fresa";
      sabor[1].value = "Naranja";
      sabor[1].innerHTML = "Naranja";
      modificarSabor(sabor[2],"Maracuyá");
      modificarSabor(sabor[3],"Limón");
      modificarSabor(sabor[4],"Uva");
      modificarSabor(sabor[5],"Manzana");
      break;
    case "Milhojas":
    case "Tres leches":
      if (seccion_sabor != undefined) {
        seccion_sabor.style = "display:none";
      }
      break;
  }
  if (sabor_aux != true) {
    return sabor_aux;
  }
}
function modificarSabor(sabor, nombre_sabor){
  sabor.value=nombre_sabor;
  sabor.innerHTML=nombre_sabor;
  sabor.removeAttribute("style");
}
function diferentesFormas(event) {
  let limite, num_aux, str_aux;
  let str = '<option value="0">0</option>';

  while (mismo_tamaño.parentElement.parentElement.nextElementSibling.id != "pregunta_mismo_tipo") {
    mismo_tamaño.parentElement.parentElement.nextElementSibling.remove();
  }

  suma_formas = sumaPastelesDiferentes(seleccionables);
  if (suma_formas > cantidadInput.value) {
    num_aux = event.target.value;
    limite = cantidadInput.value - event.target.value;
    for (let z = 0; z <= cantidadInput.value; z++) {
      str_aux += '<option value="' + z + '">' + z + '</option>';
    }
    event.target.innerHTML = str_aux;
    event.target.value = num_aux;
  } else {
    limite = cantidadInput.value - suma_formas;
  }
  for (let i = 1; i <= limite && event.target.value != cantidadInput.value; i++) {
    str += '<option value="' + i + '">' + i + '</option>';
  }
  for (let j = 0; j < seleccionables.length; j++) {
    if (seleccionables[j].id != event.target.id) {
      if (seleccionables[j].value == 0 || (cantidadInput.value - suma_formas) < 0) {
        seleccionables[j].innerHTML = str;
      }
    }
  }
  if (diferente_tamaño.checked == true) {
    diferenteTamaño(false, seleccionables);
  } else {
    diferenteTamaño(true, seleccionables);
  }
}
function tamañoSel(event) {
  let ingreso;
  if (typeof event == "string") {
    ingreso = event;
  } else {
    ingreso = event.target.value;
    if(diferente_tamaño!=undefined){
      if (diferente_tamaño.checked) {
        div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
        div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
        diferenteTamaño(false, div_elem.children);
        resetearDivElem();
      }
    }
  }
  switch (ingreso) {
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
  contenido_opciones_tamaño = `
  <option value="`+ tamaño1 + `">` + tamaño1 + `</option>
  <option value="`+ tamaño2 + `">` + tamaño2 + `</option>
`;
  if (ingreso == "Cuadrada") {
    contenido_opciones_tamaño += `<option value="` + tamaño3 + `">` + tamaño3 + `</option>`;
  } else {
    if (ingreso == "Personalizada" || ingreso == "Redonda") {
      contenido_opciones_tamaño += `
      <option value="`+ tamaño3 + `">` + tamaño3 + `</option>
      <option value="`+ tamaño4 + `">` + tamaño4 + `</option>
      <option value="`+ tamaño5 + `">` + tamaño5 + `</option>
      `;
    }
  }
  if(diferente_tipo!=undefined){
    actualizarDesdeTipo();
  }
  if (typeof event != "string" || (misma_forma.checked == true && mismo_tamaño.checked == true)) {
    document.getElementById("opciones_tamaño").innerHTML = contenido_opciones_tamaño;
  } else {
    return contenido_opciones_tamaño;
  }
}
function resetearDivElem() {
  div_elem.innerHTML = `
  <select><option value="0">0</option></select>
  <select><option value="0">0</option></select>
  <select><option value="0">0</option></select>
  <select><option value="0">0</option></select>
`;
}
function resetearSelectSabor() {
  select_sabor.innerHTML = `
    <option value="Naranja">Naranja</option>
    <option value="Chocolate">Chocolate</option>
    <option value="Naranja y chocolate (Marmoleada)">Naranja y chocolate (Marmoleada)</option>
    <option value="Vainilla">Vainilla</option>
    <option value="Maracuyá">Maracuyá</option>
    <option value="6" style="display:none">6</option>
  `;
}
function resetearSelectRelleno() {
  select_relleno.innerHTML = `
    <option value="Mermelada de frutilla">Mermelada de frutilla</option>
    <option value="Mermelada de mora">Mermelada de mora</option>
    <option value="Glass de frutilla con crema">Glass de frutilla con crema</option>
    <option value="Crema napolitana">Crema napolitana</option>
    <option value="Durazno con crema">Durazno con crema</option>
    <option value="Manjar">Manjar</option>
    <option value="Ninguno">Ninguno</option>
  `;
}
function formaANúmero(forma) {
  switch (forma) {
    case "Redonda":
      return 0;
    case "Cuadrada":
      return 1;
    case "Rectangular":
      return 2;
    case "Personalizada":
      return 3;
  }
}
function diferenteTamaño(mismo_tamaño, seleccionables) {
  while (pregunta_mismo_tamaño.nextElementSibling.id != "pregunta_mismo_tipo") {
    pregunta_mismo_tamaño.nextElementSibling.remove();
  }
  suma_formas = sumaPastelesDiferentes(seleccionables);
  if (suma_formas == 0) {
    if (diferente_forma.checked == true) {
      pregunta_mismo_tamaño.insertAdjacentHTML("afterend", `
        <tr>
          <th colspan="2" style="color: red">Escoga números válidos para la forma de cada pastel</th>
        </tr>
      `);
    }
  } else {
    ingresoDiferentesTamaños(pregunta_mismo_tipo, mismo_tamaño, seleccionables);
  }
}
function ingresoDiferentesTamaños(elem, mismo_tamaño_aux, seleccionables) {
  for (let i = 0; i < seleccionables.length; i++) {
    if (seleccionables[i].value != 0) {
      let limite=seleccionables[i].value;
      for (let j = 1; j <= limite; j++) {
        if (mismo_tamaño_aux == true) {
          j = "";
        }
        elem.insertAdjacentHTML("beforebegin", `
        <tr>
          <th>`+ nombrePastelSegúnNro(i, false, mismo_tamaño_aux) + j + `</th>
          <td>
            <select id="opciones_tamaño" name="tamaño">
              `+ tamañoSel(nombrePastelSegúnNro(i, true, mismo_tamaño_aux)) + `
            </select>
          </td>
        </tr>
      `);
        if (mismo_tamaño_aux == true) {
          break;
        }
      }
    }
  }
}
function sumaPastelesDiferentes(seleccionables) {
  let suma_formas = 0;

  if (seleccionables != null) {
    for (let k = 0; k < seleccionables.length; k++) {
      suma_formas += parseInt(seleccionables[k].value);
    }
  }
  return suma_formas;
}
function removerDropsAdicionales() {
  while(event.target.parentElement.parentElement.nextElementSibling.id!="espAdicional"){
    event.target.parentElement.parentElement.nextElementSibling.remove();
  }
}
function nombrePastelSegúnNro(num, nombre_específico, mismo_tamaño) {
  let str_aux;
  let aux1_mismo_tamaño = " ";
  let aux2_mismo_tamaño = " Nro. ";
  let aux3_mismo_tamaño = aux2_mismo_tamaño;
  if (mismo_tamaño == true) {
    aux1_mismo_tamaño = "es ";
    aux2_mismo_tamaño = "s";
    aux3_mismo_tamaño = "";
  }
  switch (num) {
    case 0:
      str_aux = "Tamaño para pastel" + aux1_mismo_tamaño + "redondo" + aux2_mismo_tamaño;
      break;
    case 1:
      str_aux = "Tamaño para pastel" + aux1_mismo_tamaño + "cuadrado" + aux2_mismo_tamaño;
      break;
    case 2:
      str_aux = "Tamaño para pastel" + aux1_mismo_tamaño + "rectangular" + aux1_mismo_tamaño.substring(0, aux1_mismo_tamaño.indexOf(" ")) + aux3_mismo_tamaño;
      break;
    case 3:
      str_aux = "Tamaño para pastel" + aux1_mismo_tamaño + "con forma personalizada" + aux3_mismo_tamaño;
      break;
  }
  if (nombre_específico == true) {
    let str_aux2 = str_aux.substring(0, str_aux.length - 6);
    if (mismo_tamaño == true) {
      str_aux2 = str_aux;
      if (str_aux[str_aux.length - 1] == "s") {
        if (str_aux[str_aux.length - 2] == "e") {
          str_aux2 = str_aux.substring(0, str_aux.length - 2);
        } else {
          str_aux2 = str_aux.substring(0, str_aux.length - 1);
        }
      }
    }
    let str_aux3 = str_aux2.substring(str_aux2.lastIndexOf(" ") + 1);
    let str_aux4 = str_aux3[0].toUpperCase() + str_aux3.substring(1);
    if (str_aux4[str_aux4.length - 1] == "o") {
      str_aux4 = str_aux4.substring(0, str_aux4.length - 1) + "a";
    }
    return (str_aux4);
  }
  return str_aux;
}
function mostrar_mismo_sabor_difTipo(difForma) {
  elems_masa = document.getElementsByName("masa");
  while (pregunta_mismo_sabor.nextElementSibling.id != "pregunta_misma_cobertura") {
    pregunta_mismo_sabor.nextElementSibling.remove();
  }
  array_tipoPasteles = [];
  for (let i = 0; i < elems_masa.length; i++) {
    if (elems_masa[i].value != "Milhojas" && elems_masa[i].value != "Tres leches") {
      array_tipoPasteles.push(elems_masa[i].value);
    }
  }
  if (array_tipoPasteles.length == 0) {
    pregunta_mismo_sabor.insertAdjacentHTML("afterend", `
  <tr>
    <th colspan="2" style="color: red">No hay sabores disponibles para las selecciones anteriores</th>
  </tr>
  `);
  } else {
    let arregloSinRepetidos = [...new Set(array_tipoPasteles)];
    let k_aux = -1;
    for (let k = 0; k < arregloSinRepetidos.length; k++) {
      if (arregloSinRepetidos[k] == "Bizcochuelo" || arregloSinRepetidos[k] == "Cheesecake") {
        k_aux = k;
      }
      if (k + 1 < arregloSinRepetidos.length) {
        if (arregloSinRepetidos[k + 1] == "Cheesecake" || arregloSinRepetidos[k + 1] == "Bizcochuelo") {
          if (k_aux != -1) {
            arregloSinRepetidos.splice(k + 1, 1);
            arregloSinRepetidos[k_aux] = "Bizcochuelo y Cheescake";
          }
        }
      }
    }
    for (let k = 0; k < arregloSinRepetidos.length; k++) {
      if (arregloSinRepetidos[k].includes("Normal")) {
        k_aux = k;
      }
      if (k + 1 < arregloSinRepetidos.length) {
        if (arregloSinRepetidos[k + 1].includes("Normal")) {
          if (k_aux != -1) {
            arregloSinRepetidos.splice(k + 1, 1);
            arregloSinRepetidos[k_aux] = "Normal";
          }
        }
      }
    }
    for (let k = 0; k < arregloSinRepetidos.length; k++) {
      if (arregloSinRepetidos[k].includes("Normal")|| arregloSinRepetidos[k] == "Especial (Con frutos secos)") {
        k_aux = k;
      }
      if (k + 1 < arregloSinRepetidos.length) {
        if (arregloSinRepetidos[k + 1].includes("Normal")|| arregloSinRepetidos[k + 1] == "Especial (Con frutos secos)") {
          if (k_aux != -1) {
            arregloSinRepetidos.splice(k + 1, 1);
            arregloSinRepetidos[k_aux] = "Normal y Especial (Con frutos secos)";
          }
        }
      }
    }
    let str_aux;
    for (let j = 0; j < arregloSinRepetidos.length; j++) {
      pregunta_misma_cobertura.insertAdjacentHTML("beforebegin", `
        <tr>
          <th>Sabor para pasteles de tipo `+ arregloSinRepetidos[j] + `</th>
          <td></td>
        </tr>
    `);
      str_aux = arregloSinRepetidos[j];
      if (arregloSinRepetidos[j] == "Bizcochuelo y Cheescake") {
        str_aux = "Bizcochuelo";
      }
      if (arregloSinRepetidos[j].includes("Normal")) {
        str_aux = "Normal (Con premezcla)";
      }
      pregunta_misma_cobertura.previousElementSibling.children[1].appendChild(tipoPasteles(str_aux, select_sabor.cloneNode(true), 0));
    }
  }
}
function mostrar_mismo_relleno_difTipo(difForma) {
  elems_masa = document.getElementsByName("masa");
  while (pregunta_mismo_relleno.nextElementSibling.id != "pregunta_imagenEspecífica") {
    pregunta_mismo_relleno.nextElementSibling.remove();
  }
  array_tipoPasteles = [];
  for (let i = 0; i < elems_masa.length; i++) {
    if (elems_masa[i].value != "Mousse" && elems_masa[i].value != "Tres leches" && elems_masa[i].value != "Cheesecake") {
      array_tipoPasteles.push(elems_masa[i].value);
    }
  }
  if (array_tipoPasteles.length == 0) {
    pregunta_mismo_relleno.insertAdjacentHTML("afterend", `
  <tr>
    <th colspan="2" style="color: red">No hay rellenos disponibles para las selecciones anteriores</th>
  </tr>
  `);
  } else {
    let arregloSinRepetidos = [...new Set(array_tipoPasteles)];
    let str_aux = "";
    for (let j = 0; j < arregloSinRepetidos.length; j++) {
      str_aux += arregloSinRepetidos[j];
      if (j + 2 < arregloSinRepetidos.length) {
        str_aux += ", ";
      } else {
        if (j + 2 == arregloSinRepetidos.length) {
          str_aux += " y ";
        }
      }
    }
    pregunta_imagenEspecífica.insertAdjacentHTML("beforebegin", `
        <tr>
          <th>Relleno para pasteles de tipo `+ str_aux + `</th>
          <td></td>
        </tr>
    `);
    pregunta_imagenEspecífica.previousElementSibling.children[1].appendChild(select_relleno.cloneNode(true));
  }
}
function mostrar_diferente_relleno_difTipo(difForma) {
  while (pregunta_mismo_relleno.nextElementSibling.id != "pregunta_imagenEspecífica") {
    pregunta_mismo_relleno.nextElementSibling.remove();
  }
  array_tipoPasteles = [];
  for (let i = 0; i < elems_masa.length; i++) {
    array_tipoPasteles.push(elems_masa[i].value);
  }
  if (pregunta_mismo_tamaño.nextElementSibling.firstElementChild.innerHTML.includes("Escoga")) {
    pregunta_mismo_relleno.insertAdjacentHTML("afterend", `
          <tr>`+ pregunta_mismo_tamaño.nextElementSibling.innerHTML + `</tr>
          `);
  } else {
    if (diferente_tipo.checked == true) {
      let displayNone;
      let elem = pregunta_mismo_tipo;
      let cont_aux = 0;
      for (let j = 0; j < array_tipoPasteles.length; j++) {
        displayNone = "";
        if (elem.nextElementSibling.children[1].firstElementChild.value.includes("Cheesecake") || elem.nextElementSibling.children[1].firstElementChild.value.includes("Mousse") || elem.nextElementSibling.children[1].firstElementChild.value.includes("Tres leches")) {
          displayNone = ' style="display: none"';
          cont_aux++;
        }
        pregunta_imagenEspecífica.insertAdjacentHTML("beforebegin", `
                <tr`+ displayNone + `>
                  <th> `+ elem.nextElementSibling.firstElementChild.innerHTML.replace("Tipo de pastel", "Relleno") + `</th>
                  <td></td>
                </tr>
              `);
        elem = elem.nextElementSibling;
        pregunta_imagenEspecífica.previousElementSibling.children[1].innerHTML = "";
        pregunta_imagenEspecífica.previousElementSibling.children[1].appendChild(select_relleno.cloneNode(true));
      }
      if (cont_aux == array_tipoPasteles.length) {
        pregunta_imagenEspecífica.insertAdjacentHTML("beforebegin", `
            <tr>
              <th colspan="2" style="color: red">No hay rellenos disponibles para las selecciones anteriores</th>
            </tr>
            `);
      }
    }

  }
}
function mostrar_diferente_sabor_difTipo(difForma) {
  while (pregunta_mismo_sabor.nextElementSibling.id != "pregunta_misma_cobertura") {
    pregunta_mismo_sabor.nextElementSibling.remove();
  }
  array_tipoPasteles = [];
  for (let i = 0; i < elems_masa.length; i++) {
    array_tipoPasteles.push(elems_masa[i].value);
  }
  if (pregunta_mismo_tamaño.nextElementSibling.firstElementChild.innerHTML.includes("Escoga")) {
    pregunta_mismo_sabor.insertAdjacentHTML("afterend", `
          <tr>`+ pregunta_mismo_tamaño.nextElementSibling.innerHTML + `</tr>
          `);
  } else {
    let displayNone;
    let elem = pregunta_mismo_tipo;
    let cont_aux = 0;
    for (let j = 0; j < array_tipoPasteles.length; j++) {
      displayNone = "";
      if (elem.nextElementSibling.children[1].firstElementChild.value.includes("Milhojas") || elem.nextElementSibling.children[1].firstElementChild.value.includes("Tres leches")) {
        displayNone = ' style="display: none"';
        cont_aux++;
      }
      pregunta_misma_cobertura.insertAdjacentHTML("beforebegin", `
                <tr`+ displayNone + `>
                  <th> `+ elem.nextElementSibling.firstElementChild.innerHTML.replace("Tipo de pastel", "Sabor") + `</th>
                  <td></td>
                </tr>
              `);
      pregunta_misma_cobertura.previousElementSibling.children[1].appendChild(tipoPasteles(array_tipoPasteles[j], select_sabor.cloneNode(true), 0));
      elem = elem.nextElementSibling;
    }
    if (cont_aux == array_tipoPasteles.length) {
      pregunta_misma_cobertura.insertAdjacentHTML("beforebegin", `
            <tr>
              <th colspan="2" style="color: red">No hay sabores disponibles para las selecciones anteriores</th>
            </tr>
            `);
    }

  }
}
function mostrar_diferente_sabor_mismTipo(difForma) {
  while (pregunta_mismo_sabor.nextElementSibling.id != "pregunta_misma_cobertura") {
    pregunta_mismo_sabor.nextElementSibling.remove();
  }
  if (pregunta_mismo_tipo.nextElementSibling.children[1].firstElementChild.value != "Milhojas" && pregunta_mismo_tipo.nextElementSibling.children[1].firstElementChild.value != "Tres leches") {
    let elem = pregunta_misma_cobertura;
    let mismo_tamaño_aux = false;
    if (difForma) {
      suma_formas = sumaPastelesDiferentes(seleccionables);
      if (suma_formas == 0) {
        if (diferente_forma.checked == true) {
          pregunta_mismo_sabor.insertAdjacentHTML("afterend", `
        <tr>
          <th colspan="2" style="color: red">Escoga números válidos para la forma de cada pastel</th>
        </tr>
      `);
        }
      } else {
        for (let i = 0; i < seleccionables.length; i++) {
          if (seleccionables[i].value != 0) {
            for (let j = 1; j <= seleccionables[i].value; j++) {
              if (mismo_tamaño_aux == true) {
                j = "";
              }
              elem.insertAdjacentHTML("beforebegin", `
        <tr>
          <th>`+ nombrePastelSegúnNro(i, false, mismo_tamaño_aux).replace("Tamaño", "Sabor") + j + `</th>
          <td>
          </td>
        </tr>
      `);
              pregunta_misma_cobertura.previousElementSibling.children[1].appendChild(tipoPasteles(pregunta_mismo_tipo.nextElementSibling.children[1].firstElementChild.value, select_sabor.cloneNode(true), 0));
            }
          }
        }
      }

    } else {
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
      for (let i = 0; i < div_elem.children.length; i++) {
        if (div_elem.children[i].value != 0) {
          for (let j = 1; j <= div_elem.children[i].value; j++) {
            elem.insertAdjacentHTML("beforebegin", `
            <tr>
              <th>`+ nombrePastelSegúnNro(i, false, mismo_tamaño_aux).replace("Tamaño", "Sabor") + j + `</th>
              <td>
              </td>
            </tr>
          `);
            pregunta_misma_cobertura.previousElementSibling.children[1].appendChild(tipoPasteles(pregunta_mismo_tipo.nextElementSibling.children[1].firstElementChild.value, select_sabor.cloneNode(true), 0));
          }
        }
      }
      resetearDivElem();
    }
  } else {
    pregunta_mismo_sabor.insertAdjacentHTML("afterend", `
    <tr>
      <th colspan="2" style="color: red">No hay sabores disponibles para el tipo de pastel seleccionado</th>
    </tr>
    `);
  }
}
function mostrar_mismo_sabor_mismTipo(difForma) {
  while (pregunta_mismo_sabor.nextElementSibling.id != "pregunta_misma_cobertura") {
    pregunta_mismo_sabor.nextElementSibling.remove();
  }
  switch (document.getElementById("opciones_pastel").value) {
    case "Milhojas":
    case "Tres leches":
      pregunta_mismo_sabor.insertAdjacentHTML("afterend", `
    <tr>
    <th colspan="2" style="color: red">No hay un sabor disponible para el tipo de pastel seleccionado</th>
  </tr>
  `);
      break;
    default:
      pregunta_mismo_sabor.insertAdjacentHTML("afterend", `
      <tr>
        <th>Sabor:<th>
        <td><td>
      </tr>
      `);
      pregunta_misma_cobertura.previousElementSibling.children[1].appendChild(tipoPasteles(document.getElementById("opciones_pastel").value, select_sabor.cloneNode(true), 0));
  }
}
function mostrar_mismo_relleno_mismTipo(difForma) {

  while (pregunta_mismo_relleno.nextElementSibling.id != "pregunta_imagenEspecífica") {
    pregunta_mismo_relleno.nextElementSibling.remove();
  }
  switch (document.getElementById("opciones_pastel").value) {
    case "Cheesecake":
    case "Mousse":
    case "Tres leches":
      pregunta_mismo_relleno.insertAdjacentHTML("afterend", `
    <tr>
      <th colspan="2" style="color: red">No hay un relleno disponible para el tipo de pastel seleccionado</th>
    </tr>
    `);
      break;
    default:
      pregunta_mismo_relleno.insertAdjacentHTML("afterend", `
          <tr>
            <th>Relleno:<th>
            <td><td>
          </tr>
          `);
      pregunta_imagenEspecífica.previousElementSibling.children[1].appendChild(select_relleno.cloneNode(true));
  }
}
function mostrar_diferente_relleno_mismTipo(difForma) {
  while (pregunta_mismo_relleno.nextElementSibling.id != "pregunta_imagenEspecífica") {
    pregunta_mismo_relleno.nextElementSibling.remove();
  }
  if (pregunta_mismo_tipo.nextElementSibling.children[1].firstElementChild.value != "Cheesecake" && pregunta_mismo_tipo.nextElementSibling.children[1].firstElementChild.value != "Mousse" && pregunta_mismo_tipo.nextElementSibling.children[1].firstElementChild.value != "Tres leches") {
    let elem = pregunta_imagenEspecífica;
    if (difForma) {
      suma_formas = sumaPastelesDiferentes(seleccionables);
      if (suma_formas == 0) {
        if (diferente_forma.checked == true) {
          pregunta_mismo_relleno.insertAdjacentHTML("afterend", `
        <tr>
          <th colspan="2" style="color: red">Escoga números válidos para la forma de cada pastel</th>
        </tr>
      `);
        }
      }else{
        for (let i = 0; i < seleccionables.length; i++) {
          if (seleccionables[i].value != 0) {
            for (let j = 1; j <= seleccionables[i].value; j++) {
              elem.insertAdjacentHTML("beforebegin", `
              <tr>
                <th>`+ nombrePastelSegúnNro(i, false, false).replace("Tamaño", "Relleno") + j + `</th>
                <td>
                </td>
              </tr>
            `);
              pregunta_imagenEspecífica.previousElementSibling.children[1].appendChild(select_relleno.cloneNode(true));
            }
          }
        }
      }
      
    } else {
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
      for (let i = 0; i < div_elem.children.length; i++) {
        if (div_elem.children[i].value != 0) {
          for (let j = 1; j <= div_elem.children[i].value; j++) {
            elem.insertAdjacentHTML("beforebegin", `
            <tr>
              <th>`+ nombrePastelSegúnNro(i, false, false).replace("Tamaño", "Relleno") + j + `</th>
              <td>
              </td>
            </tr>
          `);
            pregunta_imagenEspecífica.previousElementSibling.children[1].appendChild(select_relleno.cloneNode(true));
          }
        }
      }
      resetearDivElem();
    }
  } else {
    pregunta_mismo_relleno.insertAdjacentHTML("afterend", `
    <tr>
      <th colspan="2" style="color: red">No hay rellenos disponibles para el tipo de pastel seleccionado</th>
    </tr>
    `);
  }
}
function ingresoDiferentesTipos(elem, mismo_tamaño_aux, seleccionables) {
  for (let i = 0; i < seleccionables.length; i++) {
    if (seleccionables[i].value != 0) {
      for (let j = 1; j <= seleccionables[i].value; j++) {
        elem.insertAdjacentHTML("beforebegin", `
          <tr>
            <th>`+ nombrePastelSegúnNro(i, false, mismo_tamaño_aux).replace("Tamaño", "Tipo de pastel") + j + `</th>
            <td>
            </td>
          </tr>
        `);
        if (mismo_sabor.checked) {
          if (mismo_relleno.checked) {
            pregunta_mismo_sabor.previousElementSibling.children[1].innerHTML = contenido_seccion_tipoPastel(true, true, 0, true, true, true, false, true, diferente_forma.checked);
          } else {
            pregunta_mismo_sabor.previousElementSibling.children[1].innerHTML = contenido_seccion_tipoPastel(true, true, 0, true, false, true, false, true, diferente_forma.checked);
          }
        } else {
          if (mismo_relleno.checked) {
            pregunta_mismo_sabor.previousElementSibling.children[1].innerHTML = contenido_seccion_tipoPastel(true, true, 0, true, true, false, false, true, diferente_forma.checked);
          } else {
            pregunta_mismo_sabor.previousElementSibling.children[1].innerHTML = contenido_seccion_tipoPastel(true, true, 0, true, false, false, false, true, diferente_forma.checked);
          }
        }
      }
    }
  }
}
function mostrar_diferente_tipo() {
  if (mismo_relleno.checked) {
    pregunta_mismo_relleno.nextElementSibling.firstElementChild.innerHTML = "Relleno para pasteles de tipo Normal (Con receta propia):";
  }
  while (pregunta_mismo_tipo.nextElementSibling.id != "pregunta_mismo_sabor") {
    pregunta_mismo_tipo.nextElementSibling.remove();
  }
  if (pregunta_mismo_tamaño.nextElementSibling.firstElementChild.innerHTML.includes("Escoga")) {
    pregunta_mismo_tipo.insertAdjacentHTML("afterend", `
        <tr>`+ pregunta_mismo_tamaño.nextElementSibling.innerHTML + `</tr>
        `);
  } else {
    pregunta_mismo_sabor.firstElementChild.innerHTML = pregunta_mismo_sabor.firstElementChild.innerHTML.replace(" todos", "");
    pregunta_mismo_relleno.firstElementChild.innerHTML = pregunta_mismo_relleno.firstElementChild.innerHTML.replace(" todos", "");
    if (misma_forma.checked) {
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
      div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
      ingresoDiferentesTipos(pregunta_mismo_sabor, false, div_elem.children);
      resetearDivElem();
    } else {
      ingresoDiferentesTipos(pregunta_mismo_sabor, false, seleccionables);
    }
    elems_masa = document.getElementsByName("masa");
    for (let i = 0; i < elems_masa.length; i++) {
      if (!mismo_sabor.checked) {
        if (mismo_relleno.checked) {
          elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, true, diferente_forma.checked); };
        } else {
          elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, true, diferente_forma.checked); };
        }
      } else {
        if (mismo_relleno.checked) {
          elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, true, diferente_forma.checked); };
        } else {
          elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, true, diferente_forma.checked); };
        }
      }
    }
  }
  if (mismo_relleno.checked) {
    mostrar_mismo_relleno_difTipo(diferente_forma.checked);
  } else {
    mostrar_diferente_relleno_difTipo(diferente_forma.checked);
  }
  if (mismo_sabor.checked) {
    mostrar_mismo_sabor_difTipo(diferente_forma.checked);
  } else {
    mostrar_diferente_sabor_difTipo(diferente_forma.checked);
  }
}
function mostrar_mismo_tipo() {
  if (mismo_relleno.checked) {
    pregunta_mismo_relleno.nextElementSibling.firstElementChild.innerHTML = "Relleno:";
  }
  if (mismo_sabor.checked) {
    pregunta_mismo_sabor.nextElementSibling.firstElementChild.innerHTML = "Sabor:";
  }
  while (pregunta_mismo_tipo.nextElementSibling.id != "pregunta_mismo_sabor") {
    pregunta_mismo_tipo.nextElementSibling.remove();
  }
  pregunta_mismo_tipo.insertAdjacentHTML("afterend", contenido_seccion_tipoPastel(false, true, 0, false, false, false, false, false, false));
  elems_masa = document.getElementsByName("masa");
  for (let i = 0; i < elems_masa.length; i++) {
    if (!mismo_sabor.checked) {
      if (mismo_relleno.checked) {
        elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, false, false, diferente_forma.checked); };
      } else {
        elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, false, false, diferente_forma.checked); };
      }
    } else {
      if (mismo_relleno.checked) {
        elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, true, true, false, diferente_forma.checked); };
      } else {
        elems_masa[i].onchange = function () { tipoPasteles(event, true, 0, true, false, true, false, diferente_forma.checked); };
      }
    }
  }
  if (mismo_relleno.checked) {
    mostrar_mismo_relleno_mismTipo(diferente_forma.checked);
  } else {
    mostrar_diferente_relleno_mismTipo(diferente_forma.checked);
  }
  if (mismo_sabor.checked) {
    mostrar_mismo_sabor_mismTipo(diferente_forma.checked);
  } else {
    mostrar_diferente_sabor_mismTipo(diferente_forma.checked);
  }
}
function actualizarDesdeTipo() {
  if (diferente_tipo.checked) {
    mostrar_diferente_tipo();
    if (mismo_relleno.checked) {
      mostrar_mismo_relleno_difTipo(diferente_forma.checked);
    } else {
      mostrar_diferente_relleno_difTipo(diferente_forma.checked);
    }
    if (mismo_sabor.checked) {
      mostrar_mismo_sabor_difTipo(diferente_forma.checked);
    } else {
      mostrar_diferente_sabor_difTipo(diferente_forma.checked);
    }
  } else {
    mostrar_mismo_tipo();
    if (mismo_relleno.checked) {
      mostrar_mismo_relleno_mismTipo(diferente_forma.checked);
    } else {
      mostrar_diferente_relleno_mismTipo(diferente_forma.checked);
    }
    if (mismo_sabor.checked) {
      mostrar_mismo_sabor_mismTipo(diferente_forma.checked);
    } else {
      mostrar_diferente_sabor_mismTipo(diferente_forma.checked);
    }
  }
  if(misma_cobertura.checked){
    mostrar_misma_cobertura();
  }else{
    mostrar_diferente_cobertura();
  }
}
function diferenteCobertura( seleccionables){
  let select, nombrePasteles, final, referencia;
    referencia = pregunta_misma_cobertura;
    final = "pregunta_mismo_relleno";

  while (referencia.nextElementSibling.id != final) {
    referencia.nextElementSibling.remove();
  }
  suma_formas = sumaPastelesDiferentes(seleccionables);
  if (suma_formas == 0) {
    if (diferente_forma.checked) {
      referencia.insertAdjacentHTML("afterend", `
        <tr>
          <th colspan="2" style="color: red">Escoga números válidos para la forma de cada pastel</th>
        </tr>
      `);
    }
  } else {
    elem = pregunta_mismo_relleno;
    for (let i = 0; i < seleccionables.length; i++) {
    if (seleccionables[i].value != 0) {
      for (let j = 1; j <= seleccionables[i].value; j++) {
          select = `<select onchange="opcionSel(event)" name="cobertura">
                      <option value="Crema">Crema</option>
                      <option value="Fondant">Fondant</option>
                      <option value="Ninguna">Ninguna</option>
                  </select>`;
          nombrePasteles = nombrePastelSegúnNro(i, false, false).replace("Tamaño", "Cobertura");
    
        elem.insertAdjacentHTML("beforebegin", `
        <tr>
          <th>`+ nombrePasteles + j + `</th>
          <td>
            `+ select + `
          </td>
        </tr>
      `);
      }
    }
  }
  }
}
function mostrar_diferente_cobertura(){
  if (misma_forma.checked) {
    div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.value = cantidadInput.value;
    div_elem.children[formaANúmero(seccion_forma.children[1].firstElementChild.value)].firstElementChild.innerHTML = cantidadInput.value;
    diferenteCobertura(div_elem.children);
    resetearDivElem();
  } else {
    diferenteCobertura(seleccionables);
  }
}
function mostrar_misma_cobertura(){
  while(pregunta_misma_cobertura.nextElementSibling.id!="pregunta_mismo_relleno"){
    pregunta_misma_cobertura.nextElementSibling.remove();
  }
  pregunta_misma_cobertura.insertAdjacentHTML("afterend",contenido_seccion_cobertura());
}