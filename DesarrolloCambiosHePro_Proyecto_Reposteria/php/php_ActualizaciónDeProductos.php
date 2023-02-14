<?php
if (isset($_POST['formulario'])) {
  //$registros = 
  $registros=20;
  $id=$registros+1;
  $name = $_FILES['archivo']['name'];
  $tmp_name = $_FILES['archivo']['tmp_name'];
  $ruta = '../imagenes/' . $id . ".png";
  move_uploaded_file($tmp_name, $ruta);
}
?>