<?php

//////////////////////////////////////////////////////77RECIBIR LINK DE JAVASCRIPT////////////////////////////////////////////////////////////////////

// Recibimos los datos enviados desde JavaScript
$datos = json_decode(file_get_contents('php://input'), true);



// Hacemos algo con los datos recibidos



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Establecer la conexión a la base de datos
$enlace="";
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "db_pankey";




$conexion = mysqli_connect($host, $user, $pass, $dbname);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die('No se pudo conectar: ' . mysqli_connect_error());
}

// Definir el ID de la fila a eliminar
src = $datos;

// Preparar la sentencia SQL
$sql = "DELETE FROM producto WHERE Img = $datos";

// Ejecutar la sentencia SQL
if (mysqli_query($conexion, $sql)) {
    echo "La fila se eliminó correctamente";
} else {
    echo "Error al eliminar la fila: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);



?>