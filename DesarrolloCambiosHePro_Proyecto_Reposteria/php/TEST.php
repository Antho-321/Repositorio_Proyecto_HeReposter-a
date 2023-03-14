<?php

// Habilitar el reporte de todos los errores
error_reporting(E_ALL);

// Mostrar los errores en el navegador
ini_set('display_errors', 1);

$target_path = "C:/Users/Administrador/Desktop/";
if (!empty($_FILES)) {

  $temp_file = $_FILES['file']['tmp_name'];
  
  $target_file = $target_path . $_FILES['file']['name'];

  if (file_exists($target_path)) {
    move_uploaded_file($temp_file, $target_file);
  } else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  }
} elseif (!empty($_POST['enlace'])) {

  $url = $_POST['enlace'];
  $file_name = basename($url);

  $context = stream_context_create(array(
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      ),
      'http' => array(
        'ignore_errors' => true,
      )
   ));


   $content = file_get_contents($url,false,$context);

   if ($content !== false) {


     file_put_contents($target_path . '/' . $file_name , $content);
   } else {
     header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
   }
}
?>