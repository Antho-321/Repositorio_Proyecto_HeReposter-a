<?php
include("../php/Conexion.php");
$conexion= new Conexion;
session_start();
$cedula = $_SESSION['cedula'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$direccion = $_SESSION['direccion'];
$correo = $_SESSION['correo'];
$contraseña = $_SESSION['contraseña'];
//Variable de comparación
$random = $_SESSION['random'];
$comparacion = $_POST['comparacion'];
//Comparación
if($random == $comparacion){
    $conexion->OperSql("INSERT INTO `cliente`(`Cedula`, `Nombre`, `Apellido`, `Direccion`) VALUES ('$cedula','$nombre','$apellido','$direccion')");
    $conexion->OperSql("INSERT INTO `usuario`(`Cedula`, `Email`, `Password`) VALUES ('$cedula','$correo','$contraseña')");
    $id_usuario = $conexion->OperSql("SELECT `Id_Usuario` FROM `Usuario` WHERE `Cedula`='$cedula';");
    $id_user = $id_usuario->fetch_array();
    $idd= $id_user['Id_Usuario'];
    $conexion->OperSql("INSERT INTO `canasta`(`Id_Usuario`) VALUES ('$idd');");
    $conexion->closeConnection();
    echo '<script>
    window.alert("Usuario registrado exitosamente, inicie sesión por favor"); 
    window.location = "../html/Index.php";
    </script>';
}else{
    $conexion->closeConnection();
    echo '<script>
    window.alert("Codigos incorrectos"); 
    window.location = "../html/Index.php";
    </script>';
}
?>