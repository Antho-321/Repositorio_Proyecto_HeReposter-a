let tamaño1, tamaño2, tamaño3, tamaño4, tamaño5;
let div_fila = document.createElement("div");
let div_col = document.createElement("div");
let tabla = document.querySelector(".tabla_info");
let h1 = document.getElementsByTagName("h1")[0];
let ingreso_enlace = document.getElementById("ingreso_enlace");
let verificacion_enlace = document.getElementById("verificacion_enlace");
let imgNoValida = document.getElementById("imgNoValida");
let btnEnviar = document.getElementById("enviarFormulario");
let txtO = document.querySelector("label[for='ingreso_enlace']");
const fileInput = document.getElementById('file-input');
const imagePreview = document.getElementById('image-preview');
const searchString = window.location.search;
const searchParams = new URLSearchParams(searchString);
div_fila.className = "fila";
ingreso_enlace.addEventListener("click", vaciarPlaceHolder);
fileInput.addEventListener('change', () => {
  const file = fileInput.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => {
    imagePreview.src = reader.result;
  };
  txtO.remove();
  ingreso_enlace.remove();
  verificacion_enlace.value = "no";
});


ingreso_enlace.addEventListener('input', () => {
  if (ingreso_enlace.value != "") {
    if (!esUrlValida(ingreso_enlace.value)) {
      console.log('Link no válido');
      imgNoValida.style.visibility = "visible";
      btnEnviar.disabled = true;
    } else {
      esImagen1(ingreso_enlace.value).then((result) => {
        if (result) {
          console.log('Se ha ingresado una imagen');
          console.log("ENLACE VALIDO");
          enlaceImgVálido();
        } else {
          esImagen2(ingreso_enlace.value).then((result) => {
            if (result) {
              enlaceImgVálido();
            } else {
              console.log('Link no válido');
              imgNoValida.style.visibility = "visible";
              btnEnviar.disabled = true;
            }
          });

        }
      });
    }
  } else {
    imgNoValida.style.visibility = "hidden";
    btnEnviar.disabled = false;
  }
});
function esImagen1(url) {
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
function esImagen2(url) {
  return new Promise((resolve, reject) => {
    try {
      const splitUrl = url.split('&');
      const imgParam = splitUrl.find(param => param.startsWith('url='));
      const imgUrl = decodeURIComponent(imgParam.replace('url=', ''));
      console.log("imgUrl: " + imgUrl);
      const img = new Image();
      img.addEventListener('load', () => resolve(true));
      img.addEventListener('error', (error) => {
        //console.error(error); // mostrar el error en la consola
        resolve(false);
      });
      img.src = imgUrl;
    } catch (error) {
      reject(error);
    }
  });
}
function esUrlValida(url) {
  const expresionRegular = /^(https?|http):\/\/[^\s/$.?#].[^\s]*$/i;
  return expresionRegular.test(url);
}
function enlaceImgVálido() {
  txtO.remove();
  fileInput.remove();
  imagePreview.src = ingreso_enlace.value;
  verificacion_enlace.value = "si";
  imgNoValida.style.visibility = "hidden";
  btnEnviar.disabled = false;
}
function vaciarPlaceHolder(event) {
  event.target.placeholder = "";
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
      <input class="col" type="radio" id="tamaño1" name="tamaño" value="`+ tamaño1 + `">
      <label for="tamaño1">`+ tamaño1 + `</label>
    </div>
    <div class="col">
      <input class="col" type="radio" id="tamaño2" name="tamaño" value="`+ tamaño2 + `">
      <label for="tamaño2">`+ tamaño2 + `</label>
    </div>
  `;
  if (event.target.id == "cuad") {
    div_fila.insertAdjacentHTML("beforeend", `
    <div class="col">
    <input class="col" type="radio" id="tamaño3" name="tamaño" value="`+ tamaño3 + `">
    <label for="tamaño3">`+ tamaño3 + `</label>
  </div>
    `);
  } else {
    if (event.target.id == "per" || event.target.id == "red") {
      div_fila.insertAdjacentHTML("beforeend", `
      <div class="col">
      <input class="col" type="radio" id="tamaño3" name="tamaño" value="`+ tamaño3 + `">
      <label for="tamaño3">`+ tamaño3 + `</label>
    </div>
      <div class="col">
    <input class="col" type="radio" id="tamaño4" name="tamaño" value="`+ tamaño4 + `">
    <label for="tamaño4">`+ tamaño4 + `</label>
  </div>
  <div class="col">
    <input class="col" type="radio" id="tamaño5" name="tamaño" value="`+ tamaño5 + `">
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
            <textarea class="col" name="descAdicional" id="descAdicional" placeholder="(Opcional)"></textarea>
          </div>  
    </div>
    `);
    document.getElementById("descAdicional").addEventListener("click", vaciarPlaceHolder);
  }
}
