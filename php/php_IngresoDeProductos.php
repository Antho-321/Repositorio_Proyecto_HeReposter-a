<?php
$enlace="";
$host = "localhost";
$user = "anthonyluisluna225";
$pass = "anthonyluisluna225";
$dbname = "db_pankey";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}


if (isset($_POST['formulario'])) {
  $query = "SELECT MAX(codigo_pastel) FROM pastel";
  $result = mysqli_query($conn, $query);
  $row=mysqli_fetch_array($result);
  $ultimo_id_ingresado = $row[0];
  $id = $ultimo_id_ingresado + 1;
  $categoría=$_POST['lista_categoría'];
  $ingreso_enlace=$_POST['ingreso_enlace'];
  $forma=$_POST['forma'];
  $tamaño=$_POST['tamaño'];
  $masa=$_POST['masa'];
  $sabor=$_POST['sabor'];
  $cobertura=$_POST['cobertura'];
  $relleno=$_POST['relleno'];
  $precio=$_POST['precio'];
  $descAdicional=$_POST['descAdicional'];
  if (strpos($categoría, '_') !== false) {
    $categoría=str_replace("_", " ", $categoría);
} 
  if ($ingreso_enlace=="si") {
    $enlace=$_POST['enlace'];
    
  }else{
    //$tmp_name = $_FILES['file']['tmp_name'];
    $ruta = '../imagenes/Productos/' . $id . ".png";
    //move_uploaded_file($tmp_name, $ruta);
    $enlace=$ruta;
    echo "ARCHIVO INGRESADO";
  }

  ////////////////////////////////////////////////////SEPARA LAS porciones DEL TAMAÑO/////////////////////////////////////////7

$delimiter="(";
  $chars = explode($delimiter, $tamaño);
  $tam=$chars[0];

  preg_match_all('!\d+!', $tamaño, $matches);
  $porciones= $matches[0]; //separa el numero en una cadena de texto
if (isset($porciones[1])){
  $porciones=$porciones[0]."-".$porciones[1];
}else{
  $porciones=$porciones[0];
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77

 


  // echo "ID: ".$id."; CATEGORÍA: ".$categoría."; ENLACE: ".$enlace."; FORMA: ".$forma."; TAMAÑO: ".$tam."; porciones: ".$porciones."; masa: ".$masa."; sabor: ".$sabor."; cobertura: ".$cobertura."; relleno: ".$relleno."; precio: ".$precio."; DESCRIPCIÓN ADICIONAL: ".$descAdicional;



 /////////////////////////////77///////////////////////////ENVIAR A LA TABLA pastelS/////////////////////////////////7/////////////////////
 
 $sql = "INSERT INTO pastel (codigo_pastel, categoria, tamano, masa, sabor, cobertura, relleno, descripcion, precio, porciones, img) 
 VALUES ('$id', '$categoría', '$tam', '$masa', '$sabor', '$cobertura', '$relleno', '$descAdicional', '$precio', '$porciones', '$enlace')";
 // Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
  echo '<script>
  window.alert("INGRESADO CORRECTAMENTE"); 
  window.location = "../vistas/InicioAdministración.php";
  </script>';
} else {
  echo "Error al insertar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();



 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

}



?>

