<?php
  // Conexión a la base de datos
  $conn = mysqli_connect('localhost', 'root', 'root', 'db_pankey');

// Recibir la variable "num" desde la petición fetch
  $num = $_GET['num'];

  // Verificar conexión
  if (!$conn) {
      die("Conexión fallida: " . mysqli_connect_error());
  }

  // Consulta a la base de datos
  $sql = "SELECT `Img` FROM producto LIMIT ".$num.",1";
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