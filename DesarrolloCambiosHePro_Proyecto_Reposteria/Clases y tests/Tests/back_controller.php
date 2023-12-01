<?php
try {
  function obtener_enlace_imagen($google_url)
  {
    // Use file_get_contents to get the HTML content of the Google URL
  $html = file_get_contents($google_url);
  // Use preg_match to extract the image URL from the HTML content
  // The image URL is assumed to be within double quotes after imgurl=
  if (preg_match('/imgurl="([^"]+)"/', $html, $matches)) {
    // Return the first match
    return $matches[1];
  } else {
    // Return null if no match is found
    return null;
  }
  }

  // Obtener los datos del cuerpo de la solicitud
  $data = json_decode(file_get_contents('php://input'), true);
  $imagen = $data['imagen'];
  $data = array(
    'enlace' => obtener_enlace_imagen($imagen)
  );
  header('Content-Type: application/json');
  $json_data = json_encode($data);
  echo $json_data;
} catch (Exception $e) {
  $data = array('error' => $e->getMessage());
  header('Content-Type: application/json');
  echo json_encode($data);
  die();
}
?>