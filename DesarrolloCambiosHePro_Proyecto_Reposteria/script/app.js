let dzSize, dzProgress, previsualizacion;
let ingreso_enlace = document.getElementById("ingreso_enlace");
Dropzone.autoDiscover = false;
const dropzone = new Dropzone("div#formDrop", {
  url: "../php/TEST.php",
  dictDefaultMessage: `<p id="txtDrop">Arrastra tu imagen, presiona aquí para subirla o ingresa su enlace:</p>
    <input type="url" placeholder="Ingresar enlace" name="enlace" id="input2">
    `,
  maxFiles: 1,
  init: function () {
    this.on("maxfilesexceeded", function (file) {
      this.removeFile(file);
      alert("¡Solo se puede subir un archivo!");
      document.getElementById("txtDrop").style="z-index: -1; position: absolute; color: white;";
      document.getElementById("input2").style="position: absolute;";
    });
    this.on("sending", function (file, xhr, data) {

      ingreso_enlace = document.getElementById("ingreso_enlace");
      if (ingreso_enlace != undefined) {
        ingreso_enlace.remove();
      }

      data.append("type_chooser", "1");
    });
    this.on("addedfile", function(file) {
      if (file.name.includes("http")) {
        dzSize=file.previewElement.querySelector(".dz-size");
        dzProgress = file.previewElement.querySelector(".dz-progress");
        previsualizacion=file.previewElement.querySelector("img");
        previsualizacion.src = file.name;
        previsualizacion.style="width: 100%; height: 100%;";        
        dzProgress.style="display: none;";
        dzSize.style="display: none;";
        ingreso_enlace.style="z-index: -1;";
        this.options.maxFiles=0;
      }else{
        console.log("NO INCLUYE HTTP");
      }
      //file.previewElement.querySelector("img").src = "music-box-outline.svg";
    });
  },
  renameFile: function (file) {
    let str1 = file.name;
    let str2 = str1.substring(str1.lastIndexOf("."));
    return "HOLA" + "_" + str2;
  }
});


dropzone.on("addedfile", file => {
  console.log(`Archivo añadido: ${file.name}`);
});
dropzone.on("success", (file, response) => {
  console.log(`Archivo subido con éxito: ${file.name}`);
  console.log(`Respuesta del servidor: ${response}`);
});
dropzone.on("error", (file, error) => {
  console.log(`Error al subir el archivo: ${file.name}`);
  console.log(`Mensaje de error: ${error}`);
});
function ingresarEnlace() {
  ingreso_enlace.placeholder = "";
}

ingreso_enlace.addEventListener("input", function () {
  document.getElementById("input2").value = ingreso_enlace.value;
  if (ingreso_enlace.checkValidity()) {

    var file = { name: ingreso_enlace.value };

    dropzone.emit("addedfile", file);
    //dropzone.createThumbnailFromUrl(file, ingreso_enlace.value);
  }
});

