<html>
<head>
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../styles/estilo_Drop.css" id="estilo">
</head>
<body>
  <div class="dropzone" id="formDrop">
    <input type="url" placeholder="Ingresar enlace" id="ingreso_enlace" onclick="ingresarEnlace()">
    <input type="hidden" name="enlace" id="aux_IngresarEnlace">
  </div>
  <script src="../script/app.js"></script>
</body>
</html>