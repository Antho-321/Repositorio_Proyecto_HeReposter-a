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
    $id_cliente = $_SESSION['id'];
    $usuario = $_SESSION['id'];
    $data = array(
        'usuario' => "Ingresado"
    );
    ///////////////////////////
    $consulta = $conexion->OperSql("SELECT `precio` FROM `pastel` WHERE `codigo_pastel`= '$id';");
    $precio_array = $consulta->fetch_array();
    //precio producto
    $precio = $precio_array['precio'];
    //Insertar en el carrito
//Comprueba si el producto ya está añadido, si lo está, entonces solo aumenta la cantidad
    $consulta = $conexion->OperSql("SELECT p.codigo_pastel FROM pastel p, canasta c, pedido pe WHERE c.codigo_pastel=p.codigo_pastel AND c.id_pedido=pe.id_pedido AND pe.estado='pendiente' AND pe.id_cliente='$id_cliente' AND p.codigo_pastel='$id';");
    $producto = $consulta->fetch_array();
    if (isset($producto)) {
        //Actualiza
        if ($carritoInfo == "Actualizar información") {
            $conexion->OperSql("UPDATE `canasta` SET `subtotal`='$cantidad'*'$precio', `cantidad_cliente`='$cantidad', `dedicatoria`='$dedicatoria', `especificacion_adicional`='$reqAdicional' WHERE `codigo_pastel`='$id';");
        } else {
            $conexion->OperSql("UPDATE `canasta` SET `subtotal`=`subtotal`+'$cantidad'*'$precio', `cantidad_cliente`=`cantidad_cliente`+'$cantidad', `dedicatoria`='$dedicatoria', `especificacion_adicional`='$reqAdicional' WHERE `codigo_pastel`='$id';");
        }
    } else {
        //Inserta
        $consulta = $conexion->OperSql("SELECT IF(    (SELECT COUNT(*) FROM pedido WHERE id_cliente='$id_cliente' AND estado='pendiente') < 1     OR     (SELECT COUNT(*) FROM pedido WHERE id_cliente='$id_cliente') = (SELECT COUNT(*) FROM pedido WHERE estado = 'confirmado' AND id_cliente='$id_cliente'),     'true',     'false') AS resultado;");
        $array_creoPedido = $consulta->fetch_array();
        //id de la canasta
        $creoPedido = $array_creoPedido['resultado'];
        if ($creoPedido == 'true') {
            $consulta = $conexion->OperSql("SELECT COUNT(*) AS cantidad_pedidos FROM pedido;");
            $array_cantidadPedidos = $consulta->fetch_array();
            //id de la canasta
            $cantidadPedidos = $array_cantidadPedidos['cantidad_pedidos'];
            $id_pedido = $cantidadPedidos + 1;
            $conexion->OperSql("INSERT INTO `pedido`(`id_pedido`, `id_cliente`, `estado`) VALUES ('$id_pedido','$id_cliente','pendiente')");
            $conexion->OperSql("INSERT INTO `canasta`(`codigo_pastel`, `id_pedido`, `cantidad_cliente`, `subtotal`, `dedicatoria`, `especificacion_adicional`) VALUES ('$id','$id_pedido','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional')");
        } else {
            $consulta = $conexion->OperSql("SELECT id_pedido FROM pedido WHERE estado='pendiente' AND id_cliente='$id_cliente';");
            $array_id_pedido = $consulta->fetch_array();
            //id de la canasta
            $id_pedido = $array_id_pedido['id_pedido'];
            $conexion->OperSql("INSERT INTO `canasta`(`codigo_pastel`, `id_pedido`, `cantidad_cliente`, `subtotal`, `dedicatoria`, `especificacion_adicional`) VALUES ('$id','$id_pedido','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional')");
        }

        //$conexion->OperSql("INSERT INTO `canasta`( `Id_canasta`, `Codigo`, `cantidad_cliente`, `subtotal`, `dedicatoria`, `especificacion_adicional`) VALUES ('$id_canasta','$id','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional');");
        //$conexion->OperSql("INSERT INTO `canasta`( `Id_canasta`, `Codigo`, `cantidad_cliente`, `subtotal`, `dedicatoria`, `especificacion_adicional`) VALUES ('$id_canasta','$id','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional');");
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