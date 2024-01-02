<?php
//Parte de registro
//Variable que obtiene todos los datos 
$ArrayData;
//Todo lo que envía el post a este lugar
$cedula = $_POST['Cedula'];
$nombre = $_POST['Nombre'];
$apellido = $_POST['Apellido'];
$direccion = $_POST['Direccion'];
$correo = $_POST['Correo'];
$contraseña = ($_POST['Contraseña']) ;
$Rep_contraseña = $_POST['Rep_contraseña'];
$ArrayData = array($cedula,$nombre,$apellido,$direccion,$correo,$contraseña);
//Mete todo en este campo
if($contraseña==$Rep_contraseña){
    echo '<script>window.location = "../php/CorreoConfirmación.php";</script>';
}else{
    echo '<script>
    window.alert("Las contraseñas no coinciden"); 
    window.location = "../vistas/index.php";
    </script>';
}
?>