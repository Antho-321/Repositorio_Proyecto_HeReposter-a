<html>
<head> <!-- Incluir los archivos de Dropzone.js -->
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../styles/estilo_Drop.css" id="estilo">
</head>
<body> <!-- Crear el elemento HTML que será la dropzone -->
  <div class="dropzone" id="formDrop"> <!-- Quitar la clase dropzone -->
    <input type="url" placeholder="Ingresar enlace" id="ingreso_enlace" onclick="ingresarEnlace()">
    <input type="hidden" name="enlace" id="aux_IngresarEnlace">
  </div>
  <!-- Incluir tu archivo JavaScript personalizado -->
  <script src="../script/app.js"></script>
</body>
</html>