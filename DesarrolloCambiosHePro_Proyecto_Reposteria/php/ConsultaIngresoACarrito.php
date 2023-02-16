<?php
session_start();
include("../php/Conexion.php");
$conexion= new Conexion;
//id del producto
$id = $_GET['id'];
//cantidad del cliente
$cantidad = $_GET['cantidad'];
//id del usuario
$usuario = $_SESSION['id'];
//////////////////////////
$aux= $conexion->OperSql("SELECT `Id_Canasta` FROM `canasta` WHERE `Id_Usuario`='$usuario';");
$aux= $aux->fetch_array();
//id de la canasta
$id_canasta= $aux['Id_Canasta'];
///////////////////////////
$aux= $conexion->OperSql("SELECT `Precio` FROM `producto` WHERE `Codigo`= '$id';");
$aux= $aux->fetch_array();
//precio producto
$precio= $aux['Precio'];
//Insertar en el carrito
//Comprueba si el producto ya está añadido, si lo está, entonces solo aumenta la cantidad
$aux= $conexion->OperSql("SELECT `Codigo` FROM `canasta_item` WHERE `Codigo`='$id' AND `id_canasta`='$id_canasta';");
$aux= $aux->fetch_array();
if(isset($aux)){
//Actualiza
$conexion->OperSql("UPDATE `canasta_item` SET `Subtotal`=`Subtotal`+'$cantidad'*'$precio', `Cantidad_Cliente`=`Cantidad_Cliente`+'$cantidad' WHERE `Codigo`='$id';");
}else{
//Inserta
$conexion->OperSql("INSERT INTO `canasta_item`( `Id_canasta`, `Codigo`, `Cantidad_Cliente`, `Subtotal`) VALUES ('$id_canasta','$id','$cantidad','$precio'*'$cantidad');");
}
//se cierra la conexión
$conexion->closeConnection();
?>
