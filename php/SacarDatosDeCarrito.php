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
  $sql = "SELECT p.*, cantidad_cliente, dedicatoria, id_canasta, especificacion_adicional FROM pastel p, canasta c, pedido pe WHERE c.codigo_pastel=p.codigo_pastel AND c.id_pedido=pe.id_pedido AND pe.estado='pendiente' AND pe.id_cliente='$id_usuario';";
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