<?php

$imagen = $_GET['imagen'];

  // Conexión a la base de datos
  $conn = mysqli_connect('localhost', 'root', 'root', 'db_pankey');

// Recibir la variable "num" desde la petición fetch


  //print($num);

  // Verificar conexión

  
    if (!$conn) {
      die("Conexión fallida: " . mysqli_connect_error());
  }

  // Consulta a la base de datos
  if (strpos($imagen, "http") !== false||strpos($imagen, "../") !== false) {
    $sql = "SELECT * FROM `producto` WHERE `Img` = '".$imagen."'";
  }else{
    if($imagen==""){
      $sql = "SELECT `Img` FROM producto";
    }else{
      $sql = "SELECT `Img` FROM `producto` WHERE `Categoría` = '".$imagen."'";
    }
    
  }
  
  $result = mysqli_query($conn, $sql);

  // Verificar consulta
  if (!$result) {
      die("Consulta fallida: " . mysqli_error($conn));
  }
 // Convertir resultados en formato JSON
 $jsonData = array();
 while ($row = mysqli_fetch_assoc($result)) {
   $jsonData[] = $row;
 }

 // Enviar respuesta en formato JSON
 header('Content-Type: application/json');
 echo json_encode($jsonData);
  
  // Cerrar conexión
  mysqli_close($conn);
  ?>
