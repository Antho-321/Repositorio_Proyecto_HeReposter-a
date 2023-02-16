<?php

$id = $_GET['id'];
$cantidad = $_GET['cantidad'];

  // Conexión a la base de datos
  $conn = mysqli_connect('localhost', 'root', 'root', 'db_pankey');


  // Verificar conexión

  
    if (!$conn) {
      die("Conexión fallida: " . mysqli_connect_error());
  }

  $sql= "SELECT '".$id."','".$cantidad."'";

  
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
