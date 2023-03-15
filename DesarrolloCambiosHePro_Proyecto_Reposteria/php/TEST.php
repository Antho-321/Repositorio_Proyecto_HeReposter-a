<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$target_path = "C:/Users/Administrador/Desktop/";
if (!empty($_FILES)) {
  $temp_file = $_FILES['file']['tmp_name'];
  $target_file = $target_path . $_FILES['file']['name'];
  if (file_exists($target_path)) {
    if (esArchivoImagen($target_file)) {
      move_uploaded_file($temp_file, $target_file);
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
?>