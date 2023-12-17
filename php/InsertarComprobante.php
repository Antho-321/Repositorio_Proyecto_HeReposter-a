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
$conexion->OperSql("INSERT INTO `comprobante_venta`(`ID_COMPROBANTE_VENTA`, `ID_PEDIDO`, `FCOMPRA`, `TOTAL_PAGO`) VALUES ('$id_comprobante_venta','$id_pedido',CURRENT_DATE(),'$total_pago');");
$conexion->OperSql("UPDATE `pedido` SET `FECHA_ENTREGA`='$fecha_entrega',`HORA_ENTREGA`='$hora_entrega',`ESTADO`='confirmado' WHERE `ID_PEDIDO`='$id_pedido';");
$conexion->OperSql("UPDATE `cliente` SET `CEDULA_CLIENTE`='$cedula',`NOMBRE_CLIENTE`='$nombre',`DIRECCION_DOMICILIO`='$direccion',`TELEFONO_MOVIL`='$telefono' WHERE `ID_CLIENTE`='$id_cliente';");
$conexion->closeConnection();
?>