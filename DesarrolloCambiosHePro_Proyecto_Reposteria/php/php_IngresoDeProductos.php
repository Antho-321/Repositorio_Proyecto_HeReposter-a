<?php
if (isset($_POST['formulario'])) {
  //$ultimo_id_ingresado = SELECT MAX(id) FROM Productos;
  $ultimo_id_ingresado = 20;
  $id = $ultimo_id_ingresado + 1;
  $ingreso_enlace=$_POST['ingreso_enlace'];
  if ($ingreso_enlace=="si") {
    echo "ENLACE INGRESADO";
  }else{
    $name = $_FILES['archivo']['name'];
    $tmp_name = $_FILES['archivo']['tmp_name'];
    $ruta = '../imagenes/' . $id . ".png";
    move_uploaded_file($tmp_name, $ruta);
    echo "ARCHIVO INGRESADO";
  }
  //SI NO SE INGRESA UN ENLACE, EN LA COLUMNA DE LA DIRECCIÓN DE LA IMAGEN SE INGRESARÍA "../imagenes/ID_DE_IMAGEN.png"
}
?>