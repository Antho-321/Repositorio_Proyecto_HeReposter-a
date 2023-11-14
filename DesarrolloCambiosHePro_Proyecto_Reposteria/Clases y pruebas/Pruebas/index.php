<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="../../styles/estilo_PastelesPersonalizados.css" id="estilo" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
    <title>Pankey</title>
</head>
<body>

<div class="dropzone" id="formDrop">
                                
                            </div>

</body>
<script>
  Dropzone.autoDiscover = false;
  formDrop1 = configurarDropZone("", "");
  var dropzone1 = new Dropzone("div#formDrop", formDrop1);
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
        }else{
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
</script>
</html>
