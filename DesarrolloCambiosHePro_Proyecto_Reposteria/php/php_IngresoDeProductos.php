<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $archivo = $_POST['archivo'];
  echo $archivo;
  //test
}
?>