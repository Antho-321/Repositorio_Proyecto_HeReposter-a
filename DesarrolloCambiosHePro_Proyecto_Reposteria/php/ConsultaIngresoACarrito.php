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
$reqAdicional=$_GET['espAdicional'];
if (isset($_GET['id']) && isset($_GET['cantidad']) && isset($_SESSION['id'])) {
    $usuario = $_SESSION['id'];
    $data = array(
        'usuario' => "Ingresado"
    );
    $consulta = $conexion->OperSql("SELECT `Id_Canasta` FROM `canasta` WHERE `Id_Usuario`='$usuario';");
    $id_array = $consulta->fetch_array();
    //id de la canasta
    $id_canasta = $id_array['Id_Canasta'];
    ///////////////////////////
    $consulta = $conexion->OperSql("SELECT `Precio` FROM `producto` WHERE `Codigo`= '$id';");
    $precio_array = $consulta->fetch_array();
    //precio producto
    $precio = $precio_array['Precio'];
    //Insertar en el carrito
//Comprueba si el producto ya está añadido, si lo está, entonces solo aumenta la cantidad
    $consulta = $conexion->OperSql("SELECT `Codigo` FROM `canasta_item` WHERE `Codigo`='$id' AND `id_canasta`='$id_canasta';");
    $producto = $consulta->fetch_array();
    if (isset($producto)) {
        //Actualiza
        if ($carritoInfo == "Actualizar información") {
            $conexion->OperSql("UPDATE `canasta_item` SET `Subtotal`='$cantidad'*'$precio', `Cantidad_Cliente`='$cantidad', `Dedicatoria`='$dedicatoria', `Especificacion_adicional`='$reqAdicional' WHERE `Codigo`='$id';");
        } else {
            $conexion->OperSql("UPDATE `canasta_item` SET `Subtotal`=`Subtotal`+'$cantidad'*'$precio', `Cantidad_Cliente`=`Cantidad_Cliente`+'$cantidad', `Dedicatoria`='$dedicatoria', `Especificacion_adicional`='$reqAdicional' WHERE `Codigo`='$id';");
        }
    } else {
        //Inserta
        $conexion->OperSql("INSERT INTO `canasta_item`( `Id_canasta`, `Codigo`, `Cantidad_Cliente`, `Subtotal`, `Dedicatoria`, `Especificacion_adicional`) VALUES ('$id_canasta','$id','$cantidad','$precio'*'$cantidad','$dedicatoria','$reqAdicional');");
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