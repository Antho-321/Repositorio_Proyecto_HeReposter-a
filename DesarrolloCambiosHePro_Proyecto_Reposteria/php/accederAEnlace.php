<?php
header("Access-Control-Allow-Origin: *");
$url = $_GET['enlace'];
$ch = curl_init ();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, true);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true); // Debe establecerse en verdadero para que PHP siga cualquier encabezado "Location:"
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$a = curl_exec ($ch); // $a contendrá todos los encabezados
$url = curl_getinfo ($ch, CURLINFO_EFFECTIVE_URL); // Esto es lo que necesita, le devolverá el último URL efectivo
$data = array(
    'enlace' => $url
  );
  $json_data = json_encode($data);
  echo $json_data;
?>