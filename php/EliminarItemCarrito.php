<?php
include("../php/Conexion.php"); 
$conexion = new Conexion;
$id_canasta =$_POST['id_canasta'];
$eliminar_item =$_POST['eliminar_item'];
$conexion->OperSql("DELETE FROM `canasta` WHERE `Id_Canasta` = '$id_canasta';");
$conexion->closeConnection();
header('Location: ../vistas/CarritoDeCompras.php ');
?>