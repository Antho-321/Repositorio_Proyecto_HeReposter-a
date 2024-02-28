let formDrop1, formDrop2, formDrop3, formDrop4,
    dropzone1, dropzone2, dropzone3, dropzone4,
    ingreso_enlace1, ingreso_enlace2, ingreso_enlace3, ingreso_enlace4,
    dzSize, dzProgress, previsualizacion, estilo_txtImgNoValida, elem_estImgNoValido, estilo_noMasImg, contenedor_preImg,
    personalizacion, cantidadInput, cantidadInput2, texto_dedicatoria, cantidad_pasteles, seleccionables, div_elem,
    contenido_opciones_tamaño, img_figura, img_adorno, inputs_radio, precio, contenedor_select, suma_formas, array_tipoPasteles, elems_masa,
    tamaño1, tamaño2, tamaño3, tamaño4, tamaño5,
    seccion_sabor, seccion_relleno, seccion_forma,
    pregunta_mismo_tipo, pregunta_mismo_tamaño, pregunta_mismo_sabor, pregunta_mismo_relleno, pregunta_misma_cobertura, pregunta_imagenEspecífica,
    diferente_tamaño, diferente_forma, diferente_tipo,
    misma_forma, mismo_tamaño, misma_cobertura,
    select_sabor, select_relleno, select_tamaño,
    txtespAdicional, espAdicional3,
    enlaceAdd, numImgEspAdd, tdEspAdd, formDropAdd, dropzoneAdd, childrenAdd,
    mismo_relleno, forma, tamaño, tipo_pastel, contador, tipo_relleno_sabor, formas, sabores, posSaboresRellenos,
    ids_sabores, ids_rellenos, rellenos, formas_tamanos, sabor, cobertura, relleno, dibujo_imagen_especial, figura_fondant, adorno_fondant, 
    volumen, pos_relleno, tipos, precio_base_procesado, coberturas, volumen_con_cobertura, precio_cobertura, precio_relleno, aumento_precio_sabor, 
    volumen_relleno, forma_tamano, precio_final, posicion_tipo, posicion_sabor, tamanos, posicion_tamano, precio_dibujo, precio_adornos_fondant, precio_element;
formas_tamanos = JSON.parse(document.getElementById("formas_tamanos").value);
tipos = JSON.parse(document.getElementById("tipos").value)
sabores = JSON.parse(document.getElementById("sabores").value);
rellenos = JSON.parse(document.getElementById("rellenos").value);
coberturas = JSON.parse(document.getElementById("coberturas").value);
formas = JSON.parse(document.getElementById("formas").value);
tamanos = JSON.parse(document.getElementById("tamanos").value);
tipo_relleno_sabor = JSON.parse(document.getElementById("tipo_relleno_sabor").value);
contador = 0;
aumento_precio_sabor=0;
precio_dibujo=0;
precio_adornos_fondant=0;
volumen=970.2234539;
forma = "Redonda";
tamaño = "Mini";
tipo_pastel = "Normal (Con receta propia)";
sabor = "Naranja";
cobertura = "Crema";
relleno = "Mermelada";
dibujo_imagen_especial = null;
figura_fondant = null;
adorno_fondant= null;
array_tipoPasteles = [];
personalizacion = document.getElementById("personalizacion");
ingreso_enlace1 = document.getElementById("enlace1");
div_elem = document.createElement("div");
select_sabor = document.createElement("select");
select_relleno = document.createElement("select");
select_tamaño = document.createElement("select");
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
select_tamaño.onchange = opcionSel;
select_sabor.name = "sabor";
select_relleno.name = "relleno";
select_tamaño.name = "tamaño";
document.addEventListener('DOMContentLoaded', function () { resetearDivElem(); resetearSelectSabor(tipo_pastel); resetearSelectRelleno(tipo_pastel); resetearSelectTamaño(); });
Dropzone.autoDiscover = false;
formDrop1 = configurarDropZone(ingreso_enlace1, "");
dropzone1 = new Dropzone("div#formDrop", formDrop1);

function setupDropzoneEventHandling(dropzone) {
    let dropZone = dropzone.element; // Adjust this line if necessary to correctly select your Dropzone container

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropZone.style.borderColor = 'green';
    }

    function unhighlight() {
        dropZone.style.borderColor = '#0087F7';
    }

    function handleDrop(e) {
        var dt = e.dataTransfer;
        var files = dt.files;

        if (files.length) {
            // If file is dropped, we assume it's an image file
            handleFiles(files);
        } else {
            // If no files, try to retrieve and display the image URL
            var html = dt.getData('text/html');
            var match = html && html.match(/src\s*=\s*"?(.+?)"?\s/);
            var url = match && match[1];
            if (url) {
                displayImageFromUrl(url);
            }
        }
    }

    function handleFiles(files) {
        for (var i = 0, len = files.length; i < len; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onloadend = function (event) {
                displayImage(event.target.result);
            };
            reader.readAsDataURL(file);
        }
    }

    function displayImageFromUrl(url) {
        var img = document.createElement('img');
        //img.src = url;
        let imageUrl = url;
        var mockFile = { name: "Filename", size: 12345 };

        dropzone1.emit("addedfile", mockFile);
        dropzone1.emit("thumbnail", mockFile, imageUrl);
        //dropzone1.emit("complete", mockFile);
        dropzone1.files.push(mockFile);
    }

    function displayImage(src) {
        var img = document.createElement('img');
        //img.src = src;
        let imageUrl = src;
        var mockFile = { name: "Filename", size: 12345 };
        dropzone1.emit("addedfile", mockFile);
        dropzone1.emit("thumbnail", mockFile, imageUrl);
        //dropzone1.emit("complete", mockFile);
        dropzone1.files.push(mockFile);
    }
}

setupDropzoneEventHandling(dropzone1);
ingreso_enlace1.addEventListener('input', () => {
    validaciónIngresoEnlace(ingreso_enlace1, dropzone1);
});
function configurarDropZone(ingreso_enlace, imagenAdicional) {
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
        url: document.getElementById("img_pastel_personalizado").value + imagenAdicional,
        headers: {
            "X-CSRF-TOKEN": csrfToken
        },
        dictDefaultMessage: `<p id="txtDrop">Presiona aquí para subir tu imagen, arrástrala o ingresa su enlace:</p>
    <input type="url" placeholder="Ingresar enlace" id="input2" style="visibility: hidden">
    <div id="contenedorTxt">
      <p class="txtImgNoValida">Enlace no válido</p>
    <div>
    `,
        clickable: true,
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
                contador++;
                let test = document.getElementsByClassName("dz-image")[1];
                contenedor_preImg = file.previewElement.getElementsByClassName("dz-image")[0];
                dzSize = file.previewElement.getElementsByClassName("dz-size")[0];
                dzProgress = file.previewElement.getElementsByClassName("dz-progress")[0];
                previsualizacion = file.previewElement.getElementsByTagName("img")[0];
                contenedor_preImg.style = "width: 222px; height: 200px; z-index: 1;";
                contenedor_preImg.parentNode.style = "width: 222px; height: 200px; margin: 0px !important; z-index: 1; background: transparent !important;";
                contenedor_preImg.children[0].style = "width: 222px; height: 200px";
                document.head.appendChild(estilo_contenedorPreImg);
                previsualizacion.style = "width: 100%; height: 100%;";
                dzProgress.style = "display: none;";
                dzSize.style = "display: none;";
                dzSize.parentElement.style = "z-index: 1;";

                if (contador == 1) {
                    if (imagenAdicional == "") {
                        if (this.options.maxFiles == 1) {
                            AgregarMásContenido();
                        }
                    }
                }
                if (test != undefined) {
                    document.getElementsByClassName("dz-image")[0].parentElement.remove();
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
                } else {
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
function AgregarMásContenido() {
    personalizacion.firstElementChild.insertAdjacentHTML("beforeend", `            
                  <tr>
                      <th>Ingrese el número de pasteles que se encuentra en el modelo:</th>
                      <td colspan="1">
                          <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadP()">
                          <input type="number" class="cantidad" name="cantidad" value="1" readonly>
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
    cantidadInput = document.getElementsByClassName("cantidad")[0];
    contenedor_select = document.getElementById("contenedor_select");
    select_tamaño = document.getElementById("opciones_tamaño");
    select_sabor = document.getElementById("opciones_sabor");
    select_relleno = document.getElementById("opciones_relleno");
    precio_element=document.getElementById("precio");
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
    let str_aux = "";
    for (let i = 0; i < formas.length; i++) {
        str_aux += '<option value="' + formas[i].formas_descripcion + '">' + formas[i].formas_descripcion + '</option>';
    }
    return `
                  <tr id="seccion_forma">
                    <th><p><b>Forma:</b></p></th>
                    <td>
                      <select onchange="formaSel(event)" name="forma">
                        `+ str_aux + `
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
                      <select id="opciones_tamaño" name="tamaño" onchange="tamano(event)">
                        `+ select_tamaño.innerHTML + `
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
        contenido_onchange = ` onchange="tipoPasteles(event)" `;
    } else {
        contenido_onchange = " ";
    }
    
    let str_aux = "";
    for (let i = 0; i < tipos.length; i++) {
        str_aux += '<option value="' + tipos[i].tipo_descripcion + '">' + tipos[i].tipo_descripcion + '</option>';
    }
    return `
                  `+ str_aux1 + `
                      <select`+ contenido_onchange + `id="opciones_pastel" name="masa">
                        `+ str_aux + `
                      </select>
                  `+ str_aux2 + `
    `;
}
function contenido_seccion_sabor() {
    return `
                  <tr id="seccion_sabor">
                    <th><p><b>Sabor:</b></p></th>
                    <td>
                      <select onchange="opcionSel(event)" name="sabor" id="opciones_sabor">
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
                      <select onchange="opcionSel(event)" name="relleno" id="opciones_relleno">
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
                    <th rowspan="2">Especificación adicional:</th>
                    <td colspan="`+ num_col + `">
                      <textarea name="descrAdicional" id="descrAdicional" placeholder="(Opcional)" onclick="quitarPlaceHolder(event)"></textarea>
                    </td>
                  </tr>
                  <tr id="espAdicional2">
                    <td>
                      <p class="txtadd">Añadir</p>
                      <input type="button" id="disminuir_cantidad" value="-" onclick="quitarDropAdd()">
                      <input type="number" class="cantidad" name="cantidad" value="0" readonly>
                      <input type="button" id="aumentar_cantidad" value="+" onclick="añadirDropAdd()">
                      <p class="txtadd">imágenes</p>
                    </td>
                  </tr>
                  <tr id="espAdicional3" style="display: none">
                    <td></td>
                  </tr>
                  <tr id="seccion_precio">
                    <td colspan="`+ (num_col + 1) + `">
                      <h4 id="precio">Precio: $5</h4>
                    </td>
                  </tr>
                  <tr id="seccion_envío">
                    <td colspan="`+ (num_col + 1) + `">
                      <button>Añadir al carrito</button>
                    </td>
                  </tr>
                  <tr id="seccion_nota">
                    <td colspan="`+ (num_col + 1) + `">
                      <p style="font-size: 17px;"><b>Nota: Para otras especificaciones puede comunicarse al 0988363503. Tenga en cuenta que especificaciones más complejas conllevarían cambios en el precio.</b></p>
                    </td>
                  </tr>
    `;
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
    dropzone1.emit("thumbnail", file, enlace);
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
function opcionSel(event) {
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
                pregunta_mismo_tamaño.insertAdjacentHTML("afterend", contenido_seccion_tamaño(forma));
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
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    }
                } else {
                    if (mismo_relleno.checked) {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
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
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    }
                } else {
                    if (mismo_relleno.checked) {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
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
                event.target.parentElement.parentElement.insertAdjacentHTML("afterend", contenido_seccion_tamaño(forma));
                formaSel(seccion_forma.children[1].firstElementChild.value);
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
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    }
                }
            } else {
                for (let i = 0; i < elems_masa.length; i++) {
                    if (mismo_relleno.checked) {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
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
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    }
                }
            } else {
                for (let i = 0; i < elems_masa.length; i++) {
                    if (mismo_relleno.checked) {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
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
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    }
                }
            } else {
                for (let i = 0; i < elems_masa.length; i++) {
                    if (!mismo_sabor.checked) {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
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
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    }
                }
            } else {
                for (let i = 0; i < elems_masa.length; i++) {
                    if (!mismo_sabor.checked) {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
                    } else {
                        elems_masa[i].onchange = function () { tipoPasteles(event); };
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
        if (!event.target.value.includes("adorno")) {
            seccionFigura(event);
            document.getElementById("espAdicional").insertAdjacentHTML("beforebegin", `
      <tr>
      <th colspan="2" style="color: #C43E00">Tenga en cuenta que la pastelería no dispone del personal para realizar otro tipo de figuras</th>
    </tr>
      `);
        }
    }
    switch (event.target.name) {
        case "fig_fondant":
            figura_fondant=event.target.value;
            calcularCambiarPrecio();
            break;
        case "fig_adEnFondant":
            img_figura = document.getElementById("img_figura");
            img_adorno = document.getElementById("img_adorno");
            if (event.target.value == "No") {
                figura_fondant=null;
                removerDropsAdicionales();
            }
            if (event.target.value=="No") {
                img_figura = null;
            }
            var str = event.target.value;
            var word = "adorno";
            var otherWords = ["ambos", "figura"];
            var containsWord = str.includes(word);
            var containsOtherWords = otherWords.some(otherWord => str.includes(otherWord));
            if (containsWord && !containsOtherWords) {
                figura_fondant=null;
            }
            if (event.target.value.includes("figura")||event.target.value.includes("ambos")) {
                figura_fondant=document.getElementById("figura_fondant").value;
            }
            if (event.target.value.includes("adorno")||event.target.value.includes("ambos")) {
                adorno_fondant="Sí";
            }else{
                adorno_fondant=null;
            }
            calcularCambiarPrecio();
            break;
        case "sabor":
            sabor = event.target.value;
            calcularCambiarPrecio();
            break;
        case "cobertura":
            cobertura = event.target.value;
            calcularCambiarPrecio();
            break;
        case "relleno":
            relleno = event.target.value;
            calcularCambiarPrecio();
            break;
        case "imgEspecífica":
            if (event.target.value != "No") {
                dibujo_imagen_especial = document.getElementById("opciones_imgEspecífica").value;
            } else {
                dibujo_imagen_especial = null;
            }
            calcularCambiarPrecio();
            break;
    }
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
function removerDropsAdicionales() {
    while (event.target.parentElement.parentElement.nextElementSibling.id != "espAdicional") {
        event.target.parentElement.parentElement.nextElementSibling.remove();
    }
}
function seccionFigura(event) {
    document.getElementById("pregunta_fig_adorno").insertAdjacentHTML("afterend", `
    <tr id="img_figura">
      <th>Opciones de figura:</th>
      <td>
        <select name="fig_fondant" id="figura_fondant" onchange="opcionSel(event)">
          <option value="Angel">Angel</option>
          <option value="Cruz">Cruz</option>
          <option value="Bebé">Bebé</option>
          <option value="Perro">Perro</option>
          <option value="Cisne">Cisne</option>
          <option value="Corona">Corona</option>
        </select>
      </td>
    </tr>
  `);
}
function resetearDivElem() {
    div_elem.innerHTML = `
    <select><option value="0">0</option></select>
    <select><option value="0">0</option></select>
    <select><option value="0">0</option></select>
    <select><option value="0">0</option></select>
  `;
}
function array_desde_hasta(txt_desde_hasta) {
    let array = [];
    let i = txt_desde_hasta.indexOf("-");
    let sabor_desde = parseInt(txt_desde_hasta.substring(0, i));
    let sabor_hasta = parseInt(txt_desde_hasta.substring(i + 1));
    array.push(sabor_desde);
    array.push(sabor_hasta);
    return array;
}
function resetearSelectSabor(tipo_pastel) {
    let str_aux = "";
    let cont=0;
    for (let i = 0; i < tipo_relleno_sabor.length; i++) {
        if (tipo_relleno_sabor[i].tipo_descripcion==tipo_pastel) {
            pos_relleno=i;
            if (cont==0) {
                sabor=tipo_relleno_sabor[i].sabores_descripcion;
            }
            str_aux += '<option value="' + tipo_relleno_sabor[i].sabores_descripcion + '">' + tipo_relleno_sabor[i].sabores_descripcion + '</option>';
            cont++;
        }
    } 
    if (sabor=="N/A") {
        select_sabor.parentElement.parentElement.style = "display: none";
    }else{
        if (select_sabor.parentElement != null) {
            select_sabor.parentElement.parentElement.removeAttribute("style");
        }
        select_sabor.innerHTML=str_aux;
    }
}
function resetearSelectRelleno() {
    ids_rellenos = tipo_relleno_sabor[pos_relleno].rellenos;
    if (ids_rellenos == 1) {
        if (select_relleno.parentElement != null) {
            select_relleno.parentElement.parentElement.removeAttribute("style");
        }
        let str_aux = "";
        relleno = rellenos[0].relleno_descripcion;
        for (let i = 0; i < rellenos.length; i++) {
            str_aux += '<option value="' + rellenos[i].relleno_descripcion + '">' + rellenos[i].relleno_descripcion + '</option>';
        }
        select_relleno.innerHTML = str_aux;
    } else {
        select_relleno.parentElement.parentElement.style = "display: none";
        relleno = null;
    }
}
function resetearSelectTamaño() {
    let str_aux = "";
    let cont = 0;
    for (let i = 0; i < formas_tamanos.length; i++) {
        if (formas_tamanos[i].formas_descripcion == forma) {
            if (cont == 0) {
                tamaño = formas_tamanos[i].tamano_descripcion;
                forma_tamano=i;
            }
            str_aux += '<option value="'+formas_tamanos[i].tamano_descripcion+'">' + formas_tamanos[i].tamano_descripcion + ' (' + formas_tamanos[i].num_porciones + ' personas)</option>';
            cont++;
        }
    }
    select_tamaño.innerHTML = str_aux;
}
function formaSel(event) {
    forma = event.target.value;
    resetearSelectTamaño();
    calcularCambiarPrecio();
}
function tipoPasteles(event) {
    tipo_pastel = event.target.value;
    resetearSelectSabor(tipo_pastel);
    resetearSelectRelleno(tipo_pastel);
    calcularCambiarPrecio();
}
function tamano(event) {
    tamaño=event.target.value;
    calcularCambiarPrecio();
}
function getPosicionFormasTamano(nombre_tamano, nombre_forma){
    for (let i = 0; i < formas_tamanos.length; i++) {
        if (formas_tamanos[i].tamano_descripcion==nombre_tamano && formas_tamanos[i].formas_descripcion == nombre_forma) {
            return i;
        }
    }
}
function getPosicionTipo(tipo_pastel){
    for (let i = 0; i < tipos.length; i++) {
        if (tipos[i].tipo_descripcion==tipo_pastel) {
            return i;
        }
    }
}
function getPosicionTamano(nombre_tamano){
    for (let i = 0; i < tamanos.length; i++) {
        if (tamanos[i].tamano_descripcion==nombre_tamano) {
            return i;
        }
    }
}
function getPosicionRelleno(nombre_relleno){
    for (let i = 0; i < rellenos.length; i++) {
        if (rellenos[i].relleno_descripcion==nombre_relleno) {
            return i;
        }
    }
}
function getPosicionCobertura(nombre_cobertura){
    for (let i = 0; i < coberturas.length; i++) {
        if (coberturas[i].cobertura_descripcion==nombre_cobertura) {
            return i;
        }
    }
}
function getPosicionSabor(nombre_sabor){
    for (let i = 0; i < sabores.length; i++) {
        if (sabores[i].sabores_descripcion==nombre_sabor) {
            return i;
        }
    }
}
function getPosicionForma(nombre_forma){
    for (let i = 0; i < formas.length; i++) {
        if (formas[i].formas_descripcion==nombre_forma) {
            return i;
        }
    }
}
function roundTo(num, decimals) {
    const factor = Math.pow(10, decimals);
    return Math.round(num * factor) / factor;
}
function roundToNearestHalf(num) {
    // Calculate the whole number part and the decimal part of the input
    const wholePart = Math.floor(num);
    const decimalPart = num - wholePart;

    // Determine the rounding based on the decimal part
    if (decimalPart < 0.5) {
        return decimalPart < 0.04 ? wholePart : wholePart + 0.5;
    } else {
        return wholePart +1;
    }
}
function ajustarValor(valor) {
    if (valor - Math.floor(valor) >= 0.57) {
      return Math.floor(valor) + 1;
    } else {
      return Math.floor(valor);
    }
  }
function calcularCambiarPrecio() {
    let volumen_referencial, posicion_forma, posicion_relleno;
    forma_tamano=getPosicionFormasTamano(tamaño,forma);
    posicion_forma=getPosicionForma(forma);
    posicion_relleno=getPosicionRelleno(relleno);
    posicion_tipo=getPosicionTipo(tipo_pastel);
    posicion_sabor=getPosicionSabor(sabor);
    posicion_tamano=getPosicionTamano(tamaño);
    precio_adornos_fondant=0;

    if (posicion_relleno==undefined) {
        posicion_relleno=4;
    }

    // console.log("Forma: " + forma);
    // console.log("Tamaño: " + tamaño);
    // console.log("Tipo de pastel: " + tipo_pastel);
    // console.log("Sabor: " + sabor);
    // console.log("Cobertura: " + cobertura);
    // console.log("Relleno: " + relleno);
    // console.log("Dibujo / Imagen especial: " + dibujo_imagen_especial);
    // console.log("Figura en fondant: " + figura_fondant);
    // console.log("Adorno en fondant: " + adorno_fondant);
    // console.log("");

    if (formas_tamanos[forma_tamano].longitud2==null) {
        volumen=Math.PI*parseFloat(formas_tamanos[forma_tamano].longitud1)*parseFloat(formas_tamanos[forma_tamano].longitud1)*parseFloat(formas_tamanos[forma_tamano].altura);
        volumen_con_cobertura=Math.PI*(parseFloat(formas_tamanos[forma_tamano].longitud1)+0.5)*(parseFloat(formas_tamanos[forma_tamano].longitud1)+0.5)*(parseFloat(formas_tamanos[forma_tamano].altura)+0.5);
        volumen_relleno=Math.PI*parseFloat(formas_tamanos[forma_tamano].longitud1)*parseFloat(formas_tamanos[forma_tamano].longitud1)*parseFloat(rellenos[posicion_relleno].relleno_altura)
    }else{
        volumen=parseFloat(formas_tamanos[forma_tamano].longitud1)*parseFloat(formas_tamanos[forma_tamano].longitud2)*parseFloat(formas_tamanos[forma_tamano].altura);
        volumen_con_cobertura=(parseFloat(formas_tamanos[forma_tamano].longitud1)+1)*(parseFloat(formas_tamanos[forma_tamano].longitud2)+1)*(parseFloat(formas_tamanos[forma_tamano].altura)+0.5);
        if (rellenos[posicion_relleno].relleno_altura!=null) {
            volumen_relleno=(parseFloat(formas_tamanos[forma_tamano].longitud1))*(parseFloat(formas_tamanos[forma_tamano].longitud2))*(parseFloat(rellenos[posicion_relleno].relleno_altura));
        }
    }
    let precio_base_inicial=volumen*tipos[posicion_tipo].precio_base_volumen;
    switch (cobertura) {
        case "Crema":
            volumen_referencial=volumen_con_cobertura-volumen;
            precio_cobertura=coberturas[getPosicionCobertura(cobertura)].cobertura_precio_base_volumen*volumen_referencial;
            if (posicion_forma<=1) {
                if (precio_cobertura-parseInt(precio_cobertura,10)>=0.04) {
                    precio_cobertura=parseInt(precio_cobertura,10)+1;
                }else{
                    precio_cobertura=parseInt(precio_cobertura,10);
                }
            }else{
                precio_cobertura=Math.round(precio_cobertura);
            }
            break;
        case "Fondant":
            volumen_referencial=volumen_con_cobertura-volumen;
            precio_cobertura=coberturas[getPosicionCobertura(cobertura)].cobertura_precio_base_volumen*volumen_referencial;
            precio_cobertura=roundToNearestHalf(precio_cobertura);
            break;
        default:
            precio_cobertura=0;
            break;
    }
    if (rellenos[posicion_relleno].relleno_precio_base_volumen!=null) {
        precio_relleno=roundToNearestHalf(volumen_relleno*parseFloat(rellenos[posicion_relleno].relleno_precio_base_volumen));
    }else{
        precio_relleno=1;
    }
    switch (posicion_tipo) {
        case 1:
        case 2:
        case 6:
        case 7:
            precio=roundToNearestHalf(precio_base_inicial);
            break;
        case 5:
            precio_base_procesado=0.000720334*precio_base_inicial*precio_base_inicial+0.850859*precio_base_inicial-1.08465; 
            precio=ajustarValor(precio_base_procesado);
            break;
        default:
            switch (posicion_forma) {
                case 2:
                    precio_base_procesado=0.239355*precio_base_inicial*precio_base_inicial-4.50043*precio_base_inicial+33.7525;
                    precio=roundTo(precio_base_procesado,2);
                    break;
                case 3:
                    precio_base_procesado=0.0684798*precio_base_inicial*precio_base_inicial+0.376787*precio_base_inicial+0.928108;
                    precio=roundTo(precio_base_procesado,2);
                    break;
                default:
                    precio_base_procesado=0.0432885*precio_base_inicial*precio_base_inicial+0.753599*precio_base_inicial+0.504866;
                    let entero=parseInt(precio_base_procesado,10);
                    if (precio_base_procesado-entero>=0.5) {
                        precio=entero+1;
                    }else{
                        precio=entero;
                    }
                    break;
            }
            break;
    }
    switch (posicion_sabor) {
        case 6:
            aumento_precio_sabor=parseFloat(formas_tamanos[forma_tamano].naranja_chocolate);
            break;
        case 7:
            aumento_precio_sabor=parseFloat(formas_tamanos[forma_tamano].naranja_maracuya);
            break;
        default:
            aumento_precio_sabor=0;
            break;
    }

    switch (dibujo_imagen_especial) {
        case "Papel comestible":
            precio_dibujo=5;
            break;
        case "Crema":
            if (posicion_tamano==4) {
                precio_dibujo=3;
            } else {
                precio_dibujo=5;
            }
            break;
        default:
            precio_dibujo=0;
            break;
    }
    if (figura_fondant!=null) {
        precio_adornos_fondant+=5;
    }
    if (adorno_fondant!=null) {
        precio_adornos_fondant+=5;
    }
    precio_final=precio+precio_relleno+precio_cobertura+aumento_precio_sabor+precio_dibujo+precio_adornos_fondant;
    precio_element.innerHTML="Precio: $"+precio_final;
}