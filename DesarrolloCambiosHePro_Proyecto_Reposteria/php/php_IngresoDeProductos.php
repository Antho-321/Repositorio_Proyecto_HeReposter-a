<?php
if (isset($_POST['formulario'])) {
  $dir = 'C:/MAMP/htdocs/MisSitios/Repositorio_Proyecto_HeReposter-a/DesarrolloCambiosHePro_Proyecto_Reposteria/imagenes';
  $files = scandir($dir);
  $num_files = count($files) - 1; // debería restar 2 porque scandir() incluye los directorios "." y ".."
  $name = $_FILES['archivo']['name'];
  $tmp_name = $_FILES['archivo']['tmp_name'];
  $ruta = '../imagenes/' . $num_files . ".png";
  move_uploaded_file($tmp_name, $ruta);
}
?>