<?php

session_start();
$id_usuario= $_SESSION['id'];
  // Conexión a la base de datos
  $conn = mysqli_connect('localhost', 'root', 'root', 'db_pankey');


  // Verificar conexión

  
    if (!$conn) {
      die("Conexión fallida: " . mysqli_connect_error());
  }

  $sql= "SELECT p.*, Cantidad_Cliente, Id_Canasta_item FROM canasta_item ci LEFT JOIN canasta c ON c.Id_canasta = ci.Id_Canasta LEFT JOIN producto p ON ci.Codigo = p.Codigo WHERE c.Id_Usuario = '".$id_usuario."'";
//$sql="SELECT '".$id_usuario."'";
  
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