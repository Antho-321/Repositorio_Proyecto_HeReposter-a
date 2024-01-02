<?php
session_start();//<- Las sesiones se utilizan para guardar datos del usuario logueado
//INCLUYE EL ARCHIVO CON LA CLASE CONEXION QUE HICE PARA HACER CONSULTAS SIN TANTO CODIGO
//Y CREA UN OBJETO DE ESA CLASE
include("../php/Conexion.php");
$conexion = new Conexion;
//Primero obtenemos las variables del usuario logueado
$id_usuario= $_SESSION['id']; 
//Obtenemos todo lo del carrito
$aux=$conexion->OperSql("SELECT `id_canasta` FROM `canasta` WHERE `id_usuario` = '$id_usuario';");
$aux= $aux->fetch_array();
//Aqui esta la variable que contiene el id de la canasta
$id_canasta= $aux['id_canasta'];
//Con esto conseguimos todos los pastels del carrito de este usuario, y los agrega en una matriz
$aux=$conexion->OperSql("SELECT  `Codigo`, `Cantidad_Cliente`, `Subtotal` FROM `canasta_item` WHERE `Id_canasta`= '$id_canasta';");
$Matriz_carrito= $aux->fetch_all();//este no estoy muy seguro si mete en una matriz todo
//Con Esta parte podrás consultar acerca de un pastel
$aux=$conexion->OperSql("SELECT  `Masa`, `Sabor`, `Cobertura`, `Relleno`, `Img` FROM `pastel` WHERE `Codigo` = 'AQUI VA EL CODIGO DEL pastel';");//Aqui va el codigo del pastel, que puedes obtener con la matriz de arriba


$conexion->closeConnection();//HASTA AHI SERÍA LA LOGICA BASE PARA QUE LE HAGAS
?>