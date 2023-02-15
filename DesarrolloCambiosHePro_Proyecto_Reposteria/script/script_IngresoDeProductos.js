let tamaño1, tamaño2, tamaño3, tamaño4, tamaño5;
let div_fila = document.createElement("div");
let div_col = document.createElement("div");
let tabla = document.querySelector(".tabla_info");
let h1 = document.getElementsByTagName("h1")[0];
let ingreso_enlace = document.getElementById("ingreso_enlace");
const fileInput = document.getElementById('file-input');
const imagePreview = document.getElementById('image-preview');
const searchString = window.location.search;
const searchParams = new URLSearchParams(searchString);
const param1Value = searchParams.get("param1");

if (param1Value != null) {
  imagePreview.src = param1Value;
  h1.innerHTML = "Actualización de productos";
  document.getElementsByTagName("form")[0].action = "../php/php_ActualizaciónDeProductos.php";
}

fileInput.addEventListener('change', () => {
  const file = fileInput.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => {
    imagePreview.src = reader.result;
  };
  document.querySelector("label[for='ingreso_enlace']").remove();
  document.getElementById("ingreso_enlace").remove();
  document.getElementById("verificacion_enlace").value = "no";
});

div_fila.className = "fila";
ingreso_enlace.addEventListener("click", colorTextoANegro);

ingreso_enlace.addEventListener('input', () => {
  if(ingreso_enlace.value!=""){
    isImage(ingreso_enlace.value).then((result) => {
      if (result) {
        console.log('Se ha ingresado una imagen');
        console.log("ENLACE VALIDO");
        document.querySelector("label[for='ingreso_enlace']").remove();
        document.getElementById("file-input").remove();
        imagePreview.src = document.getElementById("ingreso_enlace").value;
        document.getElementById("verificacion_enlace").value = "si";
        document.getElementById("imgNoValida").style.visibility = "hidden";
        document.getElementById("enviarFormulario").disabled = false;
      } else {
        console.log('Link no válido');
        document.getElementById("imgNoValida").style.visibility = "visible";
        document.getElementById("enviarFormulario").disabled = true;
      }
    });
  }else{
    document.getElementById("imgNoValida").style.visibility = "hidden";
        document.getElementById("enviarFormulario").disabled = false;
  }
  

});
function isImage(url) {
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



function colorTextoANegro(event) {
  let entrada_texto = event.target;
  entrada_texto.style.color = "black";
  console.log(entrada_texto.value);
  if (entrada_texto.value == "Ingresar enlace" || entrada_texto.value == "(Opcional)") {
    entrada_texto.value = "";
  }
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
        tamaño3 = "Mediana: 12-14 porciones";
        tamaño4 = "Grande (26-28 personas)";
        tamaño5 = "Extra grande (66-68 personas)";
      } else {
        tamaño1 = "Mini (5-6 personas)";
        tamaño2 = "Pequeña (10-12 personas)";
        tamaño3 = "Mediana: 16 porciones";
        tamaño4 = "Grande (30 personas)";
        tamaño5 = "Extra grande (70 personas)";
      }
    }
  }
  div_fila.innerHTML = `
    <p class="col">Tamaño:</p>
    <div class="col">
      <input class="col" type="radio" id="tamaño1">
      <label for="tamaño1">`+ tamaño1 + `</label>
    </div>
    <div class="col">
      <input class="col" type="radio" id="tamaño2">
      <label for="tamaño2">`+ tamaño2 + `</label>
    </div>
  `;
  if (event.target.id == "cuad") {
    div_fila.insertAdjacentHTML("beforeend", `
    <div class="col">
    <input class="col" type="radio" id="tamaño3">
    <label for="tamaño3">`+ tamaño3 + `</label>
  </div>
    `);
  } else {
    if (event.target.id == "per" || event.target.id == "red") {
      div_fila.insertAdjacentHTML("beforeend", `
    <div class="col">
    <input class="col" type="radio" id="tamaño3">
    <label for="tamaño3">`+ tamaño4 + `</label>
  </div>
  <div class="col">
    <input class="col" type="radio" id="tamaño3">
    <label for="tamaño3">`+ tamaño5 + `</label>
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
                            <input class="col" type="radio" id="normal" name="masa">
                            <label for="normal">Normal (Con receta propia)</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="biz" name="masa">
                            <label for="biz">Bizcochuelo</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="milh" name="masa">
                            <label for="milh">Milhojas</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Sabor:</p>
                        <div class="col">
                            <input class="col" type="radio" id="nar" name="sabor">
                            <label for="nar">Naranja</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="choc" name="sabor">
                            <label for="choc">Chocolate</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="narychoc" name="sabor">
                            <label for="narychoc">Naranja y chocolate (Marmoleada)</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Cobertura:</p>
                        <div class="col">
                            <input class="col" type="radio" id="crema" name="cobertura">
                            <label for="crema">Crema</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="fondant" name="cobertura">
                            <label for="fondant">Fondant</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Relleno:</p>
                        <div class="col">
                            <input class="col" type="radio" id="frutilla" name="relleno">
                            <label for="frutilla">Mermelada de frutilla</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="mora" name="relleno">
                            <label for="mora">Mermelada de mora</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="glass" name="relleno">
                            <label for="glass">Glass de frutilla con crema</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="napolitana" name="relleno">
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
                              <input id="precio" type="number" step="0.1">
                          </div>
                      </div>
                      <div class="fila">
                          <p class="col">Descripción adicional:</p>
                          <textarea class="col" name="descAdicional" id="descAdicional">(Opcional)</textarea>
                      </div>
  
                  </div>
    `);
    document.getElementById("descAdicional").addEventListener("click", colorTextoANegro);
  }
}
