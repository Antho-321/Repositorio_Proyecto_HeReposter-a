<?php
session_start();
//Conexión a la clase base 
require("./Conexion.php");
$connection = new Conexion;
//Crea variables para almacenar lo del usuario
$correo = $_POST['Correo'];
$contraseña = $_POST['Contraseña'];
//Crea variables para almacenar lo de la consulta y operar con ellos
$consultemail = $connection->OperSql("SELECT `Email` FROM `usuario` WHERE `Email`= '$correo'");
$consultpass = $connection->OperSql("SELECT `Password` FROM `usuario` WHERE `Email`= '$correo'");
$email = mysqli_fetch_array($consultemail);
$pass = mysqli_fetch_array($consultpass);
//Parte necesaria para las credenciales
$consultId = $connection->OperSql("SELECT `Id_Usuario` FROM `usuario` WHERE `Email`= '$correo'");
$Id = mysqli_fetch_array($consultId);
$connection->closeConnection();
if ($email != null) {
    if ($email['Email'] == $correo && $pass['Password'] == $contraseña) {
        //Login correcto
        $_SESSION['id'] = $Id['Id_Usuario'];
        echo '<script>window.location = "../html/Index.php";</script>';
    } else {
        echo '<script>
        window.alert("ERROR DE INGRESO: contraseña incorrecta"); 
        window.location = "../html/Index.php";
        </script>';
    }
} else {
    echo '<script>
        window.alert("ERROR DE INGRESO: correo no registrado"); 
        window.location = "../html/Index.php";
        </script>';
}
