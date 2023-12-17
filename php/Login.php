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
$consultemail = $connection->OperSql("SELECT `Email` FROM `cliente` WHERE `Email`= '$correo'");
$consultpass = $connection->OperSql("SELECT `Password` FROM `cliente` WHERE `Email`= '$correo'");
$email = mysqli_fetch_array($consultemail);
$pass = mysqli_fetch_array($consultpass);
//Parte necesaria para las credenciales
$consultId = $connection->OperSql("SELECT `Id_cliente` FROM `cliente` WHERE `Email`= '$correo'");
$Id = mysqli_fetch_array($consultId);
$connection->closeConnection();

if ($email != null) {
    if ($email['Email'] == $correo && $pass['Password'] == $contraseña) {
        if($random == $comparacion){
            //Login correcto
        $_SESSION['id'] = $Id['Id_cliente'];
        echo '<script>window.location = "../vistas/index.php";</script>';
        }else{
            $conexion->closeConnection();
            echo '<script>
            window.alert("Codigos incorrectos"); 
            window.location = "../vistas/Index.php";
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
