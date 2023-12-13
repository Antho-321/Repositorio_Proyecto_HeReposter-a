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
  $sql = "SELECT p.*, CANTIDAD_CLIENTE, DEDICATORIA, ID_CANASTA, ESPECIFICACION_ADICIONAL FROM producto p, canasta c, pedido pe WHERE c.CODIGO_PRODUCTO=p.CODIGO_PRODUCTO AND c.ID_PEDIDO=pe.ID_PEDIDO AND pe.ESTADO='pendiente' AND pe.ID_CLIENTE='$id_usuario';";
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