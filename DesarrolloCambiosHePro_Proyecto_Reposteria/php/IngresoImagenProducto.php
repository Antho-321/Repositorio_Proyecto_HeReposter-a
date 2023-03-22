<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "db_pankey";
$conn = mysqli_connect($host, $user, $pass, $dbname);
$target_path = "../imagenes/Productos/";
if (!$conn) {
  die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}

if (!empty($_FILES)) {
  $query = "SELECT MAX(Codigo) FROM producto";
  $result = mysqli_query($conn, $query);
  $row=mysqli_fetch_array($result);
  $ultimo_id_ingresado = $row[0];
  $id = $ultimo_id_ingresado + 1;
  $tmp_name = $_FILES['file']['tmp_name'];
  $target_file = $target_path . $_FILES['file']['name'];
  if (file_exists($target_path)) {
    if (esArchivoImagen($target_file)) {
    $ruta = $target_path . $id . ".png";
    move_uploaded_file($tmp_name, $ruta);
    }
  } else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  }
} elseif (!empty($_POST['enlace'])) {
  $url = $_POST['enlace'];
  $file_name = basename($url);
  $context = stream_context_create(array(
    "ssl" => array(
      "verify_peer" => false,
      "verify_peer_name" => false,
    ),
    'http' => array(
      'ignore_errors' => true,
    )
  ));
  $content = file_get_contents($url, false, $context);
  if ($content !== false) {
    file_put_contents($target_path . '/' . $file_name, $content);
  } else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  }
}
function esArchivoImagen($archivo) {
  $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
  $extensiones_imagen = array("jpg", "jpeg", "gif", "png", "bmp", "tiff", "tif");
  if (in_array($extension, $extensiones_imagen)) {
    return true;
  } else {
    return false;
  }
}
$conn->close();
?>