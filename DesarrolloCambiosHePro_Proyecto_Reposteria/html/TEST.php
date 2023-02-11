<!DOCTYPE html>
<html>
<body>

<?php
function miFuncion() {
  echo "¡Has seleccionado un archivo!";
}
?>

<form action="#" method="post" enctype="multipart/form-data">
  <input type="file" name="archivo" onchange="miFuncion()">
  <input type="submit" value="Enviar">
</form>

</body>
</html>