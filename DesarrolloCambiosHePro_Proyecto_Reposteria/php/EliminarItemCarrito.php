<?php
include("../php/Conexion.php"); 
$conexion = new Conexion;
$id_canasta_item =$_POST['id_canasta_item'];
$conexion->OperSql("DELETE FROM `canasta_item` WHERE `Id_Canasta_item` = '$id_canasta_item';");
$conexion->closeConnection();
header('Location: ../html/CarritoDeCompras.php ');
?>