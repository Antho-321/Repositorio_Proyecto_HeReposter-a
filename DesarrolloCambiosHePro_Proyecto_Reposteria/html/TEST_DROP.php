<! DOCTYPE html>
<html>
<head>
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../styles/estilo_Drop.css" id="estilo">
</head>
<body>
  <div class="dropzone" id="formDrop" name="file">
    <input type="url" placeholder="Ingresar enlace" id="ingreso_enlace" onclick="ingresarEnlace()">
    <input type="hidden" name="enlace" id="aux_IngresarEnlace">
    <img src="https://www.allrecipes.com/thmb/uYYYU0k1f-1sE5WmRimImW2axbo=/1900x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/733878_Two-Ingredient-Pumpkin-Cake-banner-2000-119f528bc25340f9a07fba7ac7a072c7.jpg" alt="" id="myImage">
  </div>
  <script src="../script/app.js"></script>
</body>
</html>