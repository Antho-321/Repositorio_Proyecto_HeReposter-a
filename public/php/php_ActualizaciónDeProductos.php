<?php
$enlace = "";
$host = "localhost";
$user = "anthonyluisluna225";
$pass = "anthonyluisluna225";
$dbname = "db_pankey";
$target_path = "../imagenes/Productos/";
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}
if (isset($_POST['formulario'])) {
  $anterior_enlace=$_POST['ant_enlace'];
  $categoría=$_POST['lista_categoría'];
  $ingreso_enlace=$_POST['ingreso_enlace'];
  if (strpos($categoría, '_') !== false) {
    $categoría = str_replace("_", " ", $categoría);
  }
  $query = "SELECT codigo_pastel FROM pastel WHERE img='" . $anterior_enlace . "'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $id = $row[0];
  if($ingreso_enlace!="si"){
    if($ingreso_archivo="si"){
      $enlace = $_POST['enlace'];
    }else{
      $enlace=$anterior_enlace;
    }
  }else{
    $enlace = $_POST['enlace'];
  }
  $forma = $_POST['forma'];
  $tamaño = $_POST['tamaño'];
  $masa = $_POST['masa'];
  $sabor = $_POST['sabor'];
  $cobertura = $_POST['cobertura'];
  $relleno = $_POST['relleno'];
  $precio = $_POST['precio'];
  $descAdicional = $_POST['descAdicional'];
  ////////////////////////////////////////////////////SEPARA LAS porciones DEL TAMAÑO/////////////////////////////////////////7

  $posinicial = strpos($tamaño, "(");
  $tam = substr($tamaño, 0, $posinicial - 1);
  $longitud = (strpos($tamaño, "personas") - $posinicial) - 1;
  $porciones = substr($tamaño, $posinicial + 1, $longitud);

  /////////////////////////////77///////////////////////////ENVIAR A LA TABLA pastelS/////////////////////////////////7/////////////////////

  $sql = "UPDATE `pastel` SET `codigo_pastel`='" . $id . "',`categoria`='" . $categoría . "',`tamano`='" . $tam . "',`masa`='" . $masa . "',`sabor`='" . $sabor . "',`cobertura`='" . $cobertura . "',`relleno`='" . $relleno . "',`descripcion`='" . $descAdicional . "',`precio`='" . $precio . "',`porciones`='" . $porciones . "',`img`='" . $enlace . "' WHERE `codigo_pastel`='" . $id . "'";
  // Ejecutar la consulta SQL
  if ($conn->query($sql) === TRUE) {
    // echo '<script>
    // window.alert("INGRESADO CORRECTAMENTE"); 
    // window.location = "../vistas/InicioAdministración.php";
    // </script>';
  } else {
    echo "Error al insertar los datos: " . $conn->error;
  }

  // Cerrar la conexión
  $conn->close();



  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}



?>