<?php
session_start();
include("../php/Conexion.php");
$conexion = new Conexion;
$contraseña = $_POST['nueva_contraseña'];
$Rep_contraseña = $_POST['rep_nueva_contraseña'];
$correo = $_SESSION['correo'];
$hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

if ($contraseña != $Rep_contraseña) {
    echo '<script>
    window.alert("ERROR DE RECUPERACIÓN: Las contraseñas no coinciden"); 
    window.location = "../vistas/index.php";
    </script>';
} else {
    $conexion->OperSql("UPDATE `cliente` SET `password`='$hashed_password' WHERE email='$correo';");
    $conexion->closeConnection();
    echo '<script>
    window.alert("Contraseña actualizada, por favor inicie sesión"); 
    window.location = "../vistas/index.php";
    </script>';
}
?> 