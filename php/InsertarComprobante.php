<?php 
include("../php/Conexion.php");
$id_comprobante_venta = $_GET['id_comprobante_venta'];
$id_pedido = $_GET['id_pedido'];
$total_pago = $_GET['total_pago'];
$conexion = new Conexion;
$conexion->OperSql("INSERT INTO `comprobante_venta`(`ID_COMPROBANTE_VENTA`, `ID_PEDIDO`, `FCOMPRA`, `TOTAL_PAGO`) VALUES ('$id_comprobante_venta','$id_pedido',CURRENT_DATE(),'$total_pago');");
$conexion->OperSql("UPDATE `pedido` SET `ESTADO`='confirmado' WHERE `ID_PEDIDO`='$id_pedido';");
$conexion->closeConnection();
?>