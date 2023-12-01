<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
header("Access-Control-Allow-Origin: *");
try {
  function getBase64Image($original_url)
  {
    $query = parse_url($original_url, PHP_URL_QUERY); // Obtener la parte de la consulta de la URL
    parse_str($query, $params); // Convertir la consulta en un array asociativo
    $url = $params['url']; // Obtener el valor del parámetro url

    // Obtener el contenido HTML de la página web
    $html = file_get_contents($url);
    // Crear una instancia de la clase DOMDocument
    $dom = new DOMDocument();
    // Cargar el contenido HTML en el objeto DOM
    $dom->loadHTML($html);
    //Buscar todas las etiquetas img en el contenido HTML
    $images = $dom->getElementsByTagName("img");
    // Obtener el primer elemento del array $images
    $node = $images->item(0);
    // Comprobar si el elemento es de tipo DOMElement
    if ($node instanceof DOMElement) {
      // Obtener el valor del atributo src de la etiqueta img
      $image_url = $node->getAttribute("src");
      // Continuar con el resto de la función original
      $image = file_get_contents($image_url);
      $type = mime_content_type($image_url);
      $base64 = base64_encode($image);
      return "data:$type;base64,$base64";
    }
  }


  // Obtener los datos del cuerpo de la solicitud
  $data = json_decode(file_get_contents('php://input'), true);
  $imagen = $data['imagen'];
  $data = array(
    //'enlace_obtenido' => getBase64Image($imagen),
    'enlace_original' => $imagen
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
