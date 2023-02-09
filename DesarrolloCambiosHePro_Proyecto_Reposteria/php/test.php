<?php
//Conexión a la clase base 
require("./Conexion.php");
$connection = new Conexion;
//Crea variables para almacenar lo del usuario
$email;
$email = $connection->OperSql("SELECT `Email` FROM `usuario` WHERE `Email`= 'bd6787101@gmail.com'");
$consulta = mysqli_fetch_array($email);
echo $consulta['Email'];
$connection->closeConnection();
?>