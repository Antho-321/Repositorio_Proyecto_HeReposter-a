<?php
$enlace="";
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "db_pankey";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}


if (isset($_POST['formulario'])) {
  $anterior_enlace=$_POST['ant_enlace'];
  $categoría=$_POST['lista_categoría'];
  $ingreso_enlace=$_POST['ingreso_enlace'];
  if (strpos($categoría, '_') !== false) {
    $categoría=str_replace("_", " ", $categoría);
    //echo 'El string contiene el caracter "_".';
} 
$enlace=$_POST['enlace'];
  // if ($ingreso_enlace=="si") {
  //   $enlace=$_POST['enlace'];
    
  // }else{
  //   $name = $_FILES['archivo']['name'];
  //   $tmp_name = $_FILES['archivo']['tmp_name'];
  //   $ruta = '../imagenes/' . $id . ".png";
  //   move_uploaded_file($tmp_name, $ruta);
  //   $enlace=$ruta;
  //   echo "ARCHIVO INGRESADO";
  // }
  $query = "SELECT Codigo FROM producto WHERE Img='".$anterior_enlace."'";
  $result = mysqli_query($conn, $query);
  $row=mysqli_fetch_array($result);
  $id = $row[0];
  
  $forma=$_POST['forma'];
  $tamaño=$_POST['tamaño'];
  $masa=$_POST['masa'];
  $sabor=$_POST['sabor'];
  $cobertura=$_POST['cobertura'];
  $relleno=$_POST['relleno'];
  $precio=$_POST['precio'];
  $descAdicional=$_POST['descAdicional'];
  ////////////////////////////////////////////////////SEPARA LAS PORCIONES DEL TAMAÑO/////////////////////////////////////////7

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

 


  // echo "ID: ".$id."; CATEGORÍA: ".$categoría."; ENLACE: ".$enlace."; FORMA: ".$forma."; TAMAÑO: ".$tam."; PORCIONES: ".$porciones."; MASA: ".$masa."; SABOR: ".$sabor."; COBERTURA: ".$cobertura."; RELLENO: ".$relleno."; PRECIO: ".$precio."; DESCRIPCIÓN ADICIONAL: ".$descAdicional;



 /////////////////////////////77///////////////////////////ENVIAR A LA TABLA PRODUCTOS/////////////////////////////////7/////////////////////
 
 $sql = "UPDATE `producto` SET `Codigo`='".$id."',`Categoría`='".$categoría."',`Tamaño`='".$tam."',`Masa`='".$masa."',`Sabor`='".$sabor."',`Cobertura`='".$cobertura."',`Relleno`='".$relleno."',`Descripción`='".$descAdicional."',`Precio`='".$precio."',`Porciones`='".$porciones."',`Img`='".$enlace."' WHERE `Codigo`='".$id."'";
 // Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
  // echo '<script>
  // window.alert("INGRESADO CORRECTAMENTE"); 
  // window.location = "../html/InicioAdministración.php";
  // </script>';
} else {
  echo "Error al insertar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();



 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

}



?>

