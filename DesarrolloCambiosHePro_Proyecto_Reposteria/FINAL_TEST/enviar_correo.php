<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  /*
  $para = $_POST["para"];
  $asunto = "EN OTRA PRUEBA";
  $cuerpo = "2SEGUIMOS TESTEANDO";
  $salida = shell_exec('node ULTIMO_TEST.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '"');
  */
  
  $v8 = new V8Js();
  $js = 'console.log("Hola, mundo!");';
  $v8->executeString($js);
}
?>