<?php
$para = "bd6787101@gmail.com";
$asunto = "EN OTRA PRUEBA";
$cuerpo = "2SEGUIMOS TESTEANDO";
$salida = shell_exec('node ULTIMO_TEST.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '"');
echo "<h1>INGRESE CORREO<h1>";
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $para = $_POST["para"];
//   $asunto = "EN OTRA PRUEBA";
//   $cuerpo = "2SEGUIMOS TESTEANDO";
//   $salida = shell_exec('node ULTIMO_TEST.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '"');
//   echo "<h1>INGRESE CORREO<h1>";
// }
?>