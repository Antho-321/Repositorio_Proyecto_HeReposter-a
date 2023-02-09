<?php
//el luna es chevere y guapo
require("./Conexion.php");
$connection = new Conexion;

//ESTA ES OTRA MODIFICACIÓN
//Todo lo que envía el post a este lugar
$cedula = $_POST['Cedula'];
$nombre = $_POST['Nombre'];
$apellido = $_POST['Apellido'];
$direccion = $_POST['Direccion'];
$correo = $_POST['Correo'];
$contraseña = $_POST['Contraseña'];
$Rep_contraseña = $_POST['Rep_contraseña'];
//Uso de una operación en sql
$connection->OperSql("INSERT INTO `cliente`(`Cedula`, `Nombre`, `Apellido`, `Direccion`) VALUES ('$cedula','$nombre' ,'$apellido','$direccion')");
$connection->OperSql("INSERT INTO `usuario`(`Cedula`, `Email`,  `Password`) VALUES ('$cedula','$correo','$contraseña')");
echo '<script>window.location = "../html/VentanaDeRegistro.html";</script>';
$connection->closeConnection();
?>