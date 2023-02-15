<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "db_pankey";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}
$query = "SELECT * FROM producto WHERE Codigo=2";
$result = mysqli_query($conn, $query);

if (!$result) {
  die("Error al ejecutar la consulta: " . mysqli_error($conn));
}
$row=mysqli_fetch_array($result);
echo $row[9];

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
mysqli_close($conn);
?>