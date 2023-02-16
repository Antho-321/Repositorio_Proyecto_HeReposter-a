<?php
session_start();
include("../php/Conexion.php");
$conexion = new Conexion;
$cedula= $_SESSION['cedula'];
$id_usuario= $_SESSION['id'];
$aux= $conexion->OperSql("SELECT `Nombre`, `Apellido` FROM `cliente` WHERE `Cedula` = '$cedula';");
$aux= $aux->fetch_array();
$nombre= $aux['Nombre']." ".$aux['Apellido'];
//Obtiene el id de su canasta
$aux=$conexion->OperSql("SELECT `Id_Canasta` FROM `canasta` WHERE `Id_Usuario` = '$id_usuario';");
$aux= $aux->fetch_array();
$id_canasta= $aux['Id_Canasta'];
//Obtiene el correo
$aux= $conexion->OperSql("SELECT `Email` FROM `usuario` WHERE `Cedula`= '$cedula';");
$aux= $aux->fetch_array();
$correo= $aux['Email'];
//Obtiene la dirección
$aux= $conexion->OperSql("SELECT `Direccion` FROM `cliente` WHERE `Cedula`= '$cedula';");
$aux= $aux->fetch_array();
$direccion = $aux['Direccion'];
//Parte en la que va a obtener los dados 
$aux= $conexion->OperSql("SELECT  `Codigo`, `Cantidad_Cliente`, `Subtotal` FROM `canasta_item` WHERE `Id_canasta` = '$id_canasta';");
$arreglo= $aux->fetch_all(PDO::FETCH_ASSOC);// arreglo de los datos a poner en la factura
//Consulta de ayuda para el foreach




//defino variables
$total =0;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    </div>
    <div id="app" class="col-11">

        <h2>Factura</h2>

        <div class="row my-3">
            <div class="col-10">
                <h1>Pankey</h1>
                <p>Ibarra</p>
                <p>Tobías Mena y Atahualpa</p>
                <p>Sector del coliseo "la bola amarilla"</p>
            </div>
            <div class="col-2">
                <img src="../imagenes/LOGO_PANKEY1.png" width="200px" height="200px" />
            </div>
        </div>

        <hr />

        <div class="row fact-info mt-3">
            <div class="col-3">
                <h5>Facturar a</h5>
                <p>
                    <?php echo $nombre?><br>
                    <?php echo $cedula?>
                </p>
            </div>
            <div class="col-3">
                <h5>Enviar a</h5>
                <p>
                    <?php echo $direccion ?> <br>
                    <?php echo $correo?>
                </p>
            </div>
            <div class="col-3">
                <h5>N° de factura</h5>
                <h5>Fecha de emisión</h5>
            </div>
            <div class="col-3">
                <h5>103</h5>
                <p>
                    <?php echo date("Y-m-d"); ?>
                </p>
            </div>
        </div>

        <div class="row my-5">
            <table class="table table-borderless factura">
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th>Codigo</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arreglo as $row){   ?>

                    <tr>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[2]." $"; ?></td>
                        <td><?php echo $row[1]*$row[2]." $"; ?></td>
                     
                    </tr>
                    <?php $total+=  $row[1]*$row[2]; ?>
                    <?php }?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Total Factura</th>
                        <th><?php echo $total." $"; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="cond row">
            <div class="col-12 mt-3">
                <h4>GRACIAS POR SU COMPRA</h4>
                <p>Recuerde acercarse a retirar su pedido</p>
                <p>
                    Banco Pichincha
                    <br />
                    Compra digital
                    <br />
                    Código SWIFT: PICHECEQXXX
                </p>
            </div>
        </div>
    </div>
    <!-- partial -->

</body>

</html>