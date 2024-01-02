<?php 
session_start();
include("../php/Conexion.php");
$id_comprobante_venta = $_GET['id_comprobante_venta'];
$id_pedido = $_GET['id_pedido'];
$total_pago = $_GET['total_pago'];
$fecha_entrega = $_GET['fecha_entrega'];
$hora_entrega = $_GET['hora_entrega'];
$cedula = $_GET['cedula'];
$nombre = $_GET['nombre'];
$direccion = $_GET['direccion'];
$telefono = $_GET['telefono'];
$id_cliente=$_SESSION['id'];

$conexion = new Conexion;
$conexion->OperSql("INSERT INTO `comprobante_venta`(`id_comprobante_venta`, `id_pedido`, `fecha_compra`, `total_pago`) VALUES ('$id_comprobante_venta','$id_pedido',CURRENT_DATE(),'$total_pago');");
$conexion->OperSql("UPDATE `pedido` SET `fecha_entrega`='$fecha_entrega',`hora_entrega`='$hora_entrega',`estado`='confirmado' WHERE `id_pedido`='$id_pedido';");
$conexion->OperSql("UPDATE `cliente` SET `cedula_cliente`='$cedula',`nombre_cliente`='$nombre',`direccion_domicilio`='$direccion',`telefono_movil`='$telefono' WHERE `id_cliente`='$id_cliente';");
$conexion->closeConnection();
?>