<?php
session_start();
// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'anthonyluisluna225', 'anthonyluisluna225', 'db_pankey');
// Verificar conexión
if (!$conn) {
  die("Conexión fallida: " . mysqli_connect_error());
}
if (isset($_SESSION['id'])) {
  $id_usuario = $_SESSION['id'];
  $sql = "SELECT p.*, Cantidad_Cliente, Dedicatoria, Id_Canasta_item, Especificacion_adicional FROM canasta_item ci LEFT JOIN canasta c ON c.Id_canasta = ci.Id_Canasta LEFT JOIN producto p ON ci.Codigo = p.Codigo WHERE c.Id_Usuario = '" . $id_usuario . "'";
  $result = mysqli_query($conn, $sql);
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
} else {
  $data = array(
    'usuario' => "noIngresado"
  );
  $json_data = json_encode($data);
  echo $json_data;
}
mysqli_close($conn);
?>