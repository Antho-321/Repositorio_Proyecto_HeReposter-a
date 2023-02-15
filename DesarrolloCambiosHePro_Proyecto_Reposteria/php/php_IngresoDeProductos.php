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
  $query = "SELECT MAX(Codigo) FROM producto";
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
    //echo 'El string contiene el caracter "_".';
} 
  if ($ingreso_enlace=="si") {
    $enlace=$_POST['enlace'];
    
  }else{
    $name = $_FILES['archivo']['name'];
    $tmp_name = $_FILES['archivo']['tmp_name'];
    $ruta = '../imagenes/' . $id . ".png";
    move_uploaded_file($tmp_name, $ruta);
    $enlace=$ruta;
    echo "ARCHIVO INGRESADO";
  }

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
 
 $sql = "INSERT INTO producto (Codigo, Categoría, Tamaño, Masa, Sabor, Cobertura, Relleno, Descripción, Precio, Porciones, Img) 
 VALUES ('$id', '$categoría', '$tam', '$masa', '$sabor', '$cobertura', '$relleno', '$descAdicional', '$precio', '$porciones', '$enlace')";
 // Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
  echo '<script>
  window.alert("INGRESADO CORRECTAMENTE"); 
  window.location = "../html/InicioAdministración.php";
  </script>';
} else {
  echo "Error al insertar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();



 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  //$query = "INSERT INTO producto (Codigo,)";
  //$result = mysqli_query($conn, $query);
  
  //SI NO SE INGRESA UN ENLACE, EN LA COLUMNA DE LA DIRECCIÓN DE LA IMAGEN SE INGRESARÍA "../imagenes/ID_DE_IMAGEN.png"
}
// $query = "SELECT * FROM producto WHERE Codigo=2";
// $result = mysqli_query($conn, $query);

// if (!$result) {
//   die("Error al ejecutar la consulta: " . mysqli_error($conn));
// }else{
//   //echo "¡PRODUCTO INGRESADO!";
//   $row=mysqli_fetch_array($result);
//   echo "TEST CONSULTA: ".$row[9];
// }


?>

