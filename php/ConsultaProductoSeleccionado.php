<?php

$imagen = $_GET['imagen'];

// Conexión a la base de datos
try {
  $conn = mysqli_connect('localhost', 'anthonyluisluna225', 'anthonyluisluna225', 'db_pankey');
} catch (Exception $e) {
  // Enviar un JSON con el error
  $data = array('error' => $e->getMessage());
  header('Content-Type: application/json');
  echo json_encode($data);
  die();
}

// Consulta a la base de datos
if (strpos($imagen, "http") !== false || strpos($imagen, "../") !== false) {
  $sql = "SELECT * FROM `producto` WHERE `IMG` = '" . $imagen . "'";
} else {
  if ($imagen == "") {
    $sql = "SELECT `Img` FROM producto";
  } else {
    $sql = "SELECT `Img` FROM `producto` WHERE `Categoria` = '" . $imagen . "'";
  }
}

$result = mysqli_query($conn, $sql);

// Verificar consulta
if (!$result) {
  // Enviar un JSON con el error
  $data = array('error' => mysqli_error($conn));
  header('Content-Type: application/json');
  echo json_encode($data);
  die();
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
