<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $para = $_POST["para"];
  $asunto = $_POST["asunto"];
  $cuerpo = $_POST["cuerpo"];
  $salida = shell_exec('node ULTIMO_TEST.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '"');
  echo $salida;
}
?>