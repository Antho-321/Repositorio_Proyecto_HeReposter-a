<?php
session_start();
include("../php/Conexion.php");
$conexion = new Conexion;
//id del producto
$id = $_GET['id'];
//cantidad del cliente
$cantidad = $_GET['cantidad'];
//dedicatoria para el pastel
$dedicatoria = $_GET['dedicatoria'];
$carritoInfo = $_GET['carritoInfo'];
$reqAdicional = $_GET['espAdicional'];
if (isset($_GET['id']) && isset($_GET['cantidad']) && isset($_SESSION['id'])) {
    $id_cliente=$_SESSION['id'];
    $usuario = $_SESSION['id'];
    $data = array(
        'usuario' => "Ingresado"
    );
    ///////////////////////////
    $consulta = $conexion->OperSql("SELECT `PRECIO` FROM `producto` WHERE `CODIGO_PRODUCTO`= '$id';");
    $precio_array = $consulta->fetch_array();
    //precio producto
    $precio = $precio_array['PRECIO'];
    //Insertar en el carrito
//Comprueba si el producto ya está añadido, si lo está, entonces solo aumenta la cantidad
    $consulta = $conexion->OperSql("SELECT p.CODIGO_PRODUCTO FROM producto p, canasta c, pedido pe WHERE c.CODIGO_PRODUCTO=p.CODIGO_PRODUCTO AND c.ID_PEDIDO=pe.ID_PEDIDO AND pe.ESTADO='pendiente' AND pe.ID_CLIENTE='$id_cliente' AND p.CODIGO_PRODUCTO='$id';");
    $producto = $consulta->fetch_array();
    if (isset($producto)) {
        //Actualiza
        if ($carritoInfo == "Actualizar información") {
            $conexion->OperSql("UPDATE `canasta` SET `Subtotal`='$cantidad'*'$precio', `Cantidad_Cliente`='$cantidad', `Dedicatoria`='$dedicatoria', `Especificacion_adicional`='$reqAdicional' WHERE `CODIGO_PRODUCTO`='$id';");
        } else {
            $conexion->OperSql("UPDATE `canasta` SET `Subtotal`=`Subtotal`+'$cantidad'*'$precio', `Cantidad_Cliente`=`Cantidad_Cliente`+'$cantidad', `Dedicatoria`='$dedicatoria', `Especificacion_adicional`='$reqAdicional' WHERE `CODIGO_PRODUCTO`='$id';");
        }
    } else {
        //Inserta
        $consulta = $conexion->OperSql("SELECT IF(    (SELECT COUNT(*) FROM pedido WHERE ID_CLIENTE='$id_cliente') = 0     OR     (SELECT COUNT(*) FROM pedido WHERE ID_CLIENTE='$id_cliente') = (SELECT COUNT(*) FROM pedido WHERE ESTADO = 'CONFIRMADO' AND ID_CLIENTE='$id_cliente'),     'true',     'false') AS resultado;");
        $array_creoPedido = $consulta->fetch_array();
        //id de la canasta
        $creoPedido = $array_creoPedido['resultado'];
        if ($creoPedido=='true') {
            $consulta = $conexion->OperSql("SELECT COUNT(*) AS cantidad_pedidos FROM pedido;");
            $array_cantidadPedidos = $consulta->fetch_array();
            //id de la canasta
            $cantidadPedidos = $array_cantidadPedidos['cantidad_pedidos'];
            $id_pedido=$cantidadPedidos+1;
            $conexion->OperSql("INSERT INTO `pedido`(`ID_PEDIDO`, `ID_CLIENTE`, `ESTADO`) VALUES ('$id_pedido','$id_cliente','pendiente')");
            $conexion->OperSql("INSERT INTO `canasta`(`CODIGO_PRODUCTO`, `ID_PEDIDO`, `CANTIDAD_CLIENTE`, `SUBTOTAL`, `DEDICATORIA`, `ESPECIFICACION_ADICIONAL`) VALUES ('$id','$id_pedido','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional')");
        }else{
            $consulta = $conexion->OperSql("SELECT c.ID_PEDIDO FROM canasta c, pedido p WHERE c.ID_PEDIDO=p.ID_PEDIDO AND p.ESTADO='pendiente' AND p.ID_CLIENTE='$id_cliente' GROUP BY c.ID_PEDIDO;");
            $array_id_pedido = $consulta->fetch_array();
            //id de la canasta
            $id_pedido = $array_id_pedido['ID_PEDIDO'];
            $conexion->OperSql("INSERT INTO `canasta`(`CODIGO_PRODUCTO`, `ID_PEDIDO`, `CANTIDAD_CLIENTE`, `SUBTOTAL`, `DEDICATORIA`, `ESPECIFICACION_ADICIONAL`) VALUES ('$id','$id_pedido','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional')");
        }

        //$conexion->OperSql("INSERT INTO `canasta`( `Id_canasta`, `Codigo`, `Cantidad_Cliente`, `Subtotal`, `Dedicatoria`, `Especificacion_adicional`) VALUES ('$id_canasta','$id','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional');");
        //$conexion->OperSql("INSERT INTO `canasta`( `Id_canasta`, `Codigo`, `Cantidad_Cliente`, `Subtotal`, `Dedicatoria`, `Especificacion_adicional`) VALUES ('$id_canasta','$id','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional');");
    }
} else {
    $data = array(
        'usuario' => "noIngresado"
    );
 }
// Convertir arreglo a JSON
$json_data = json_encode($data);
//echo $json_data;
echo $json_data;
//se cierra la conexión
$conexion->closeConnection();
?>