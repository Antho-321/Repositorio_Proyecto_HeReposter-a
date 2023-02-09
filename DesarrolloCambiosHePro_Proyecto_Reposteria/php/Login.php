<?php
//Conexión a la clase base 
require("./Conexion.php");
$connection = new Conexion;
//Crea variables para almacenar lo del usuario
$correo = $_POST['Correo'];
$contraseña = $_POST['Contraseña'];
//Crea variables para almacenar lo de la consulta
$consultemail = $connection->OperSql("SELECT `Email` FROM `usuario` WHERE `Email`= '$correo'");
$consultpass = $connection->OperSql("SELECT `Password` FROM `usuario` WHERE `Email`= '$correo'");
$email = mysqli_fetch_array($consultemail);
$pass = mysqli_fetch_array($consultpass);
if($email['Email']==$correo && $pass['Password']==$contraseña){
    echo "Login correcto";
}else{
    echo "Mejor matate";
}

?>