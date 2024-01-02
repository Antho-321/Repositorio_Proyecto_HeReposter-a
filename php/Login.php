<?php
session_start();
//Conexión a la clase base 
require("./Conexion.php");
$connection = new Conexion;
$random = $_SESSION['random'];
$comparacion = $_POST['comparacion'];
//Crea variables para almacenar lo del cliente
$correo = $_SESSION['correo'];
$contraseña = $_SESSION['contraseña'];
//Crea variables para almacenar lo de la consulta y operar con ellos
$consultemail = $connection->OperSql("SELECT `email` FROM `cliente` WHERE `email`= '$correo'");
$consultpass = $connection->OperSql("SELECT `password` FROM `cliente` WHERE `email`= '$correo'");
$email = mysqli_fetch_array($consultemail);
$pass = mysqli_fetch_array($consultpass);
//Parte necesaria para las credenciales
$consultId = $connection->OperSql("SELECT `id_cliente` FROM `cliente` WHERE `email`= '$correo'");
$Id = mysqli_fetch_array($consultId);
$connection->closeConnection();

if ($email != null) {
    if ($email['email'] == $correo && password_verify($contraseña, $pass['password'])) {
        if($random == $comparacion){
            //Login correcto
        $_SESSION['id'] = $Id['id_cliente'];
        echo '<script>window.location = "../vistas/index.php";</script>';
        }else{
            $conexion->closeConnection();
            echo '<script>
            window.alert("Codigos incorrectos"); 
            window.location = "../vistas/index.php";
            </script>';
        }

        
    } else {
        echo '<script>
        window.alert("ERROR DE INGRESO: contraseña incorrecta"); 
        window.location = "../vistas/index.php";
        </script>';
    }
} else {
    echo '<script>
        window.alert("ERROR DE INGRESO: correo no registrado"); 
        window.location = "../vistas/index.php";
        </script>';
}
