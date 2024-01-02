<?php
include("../php/Conexion.php");
$conexion= new Conexion;
session_start();
$correo = $_SESSION['correo'];
$contraseña = $_SESSION['contraseña'];
//Variable de comparación
$random = $_SESSION['random'];
$comparacion = $_POST['comparacion'];
//Comparación
if($random == $comparacion){
    $cedula = $conexion->OperSql("SELECT MAX(`id_cliente`) FROM `cliente`");
    $array_cedula=$cedula->fetch_array();
    $nueva_cedula=$array_cedula['MAX(`id_cliente`)'];
    if ($cedula==NULL) {
        $nueva_cedula = 1;    
    }else{
        $nueva_cedula = $nueva_cedula + 1;
    }
    $canasta = $conexion->OperSql("SELECT MAX(`id_canasta`) FROM `canasta`");
    $array_canasta=$canasta->fetch_array();
    $nueva_canasta=$array_canasta['MAX(`id_canasta`)'];
    if ($nueva_canasta==NULL) {
        $nueva_canasta = 1;    
    }else{
        $nueva_canasta = $nueva_canasta + 1;
    }
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);
    $conexion->OperSql("INSERT INTO `cliente`(`id_cliente`, `email`, `password`) VALUES ('$nueva_cedula','$correo','$hashed_password')"); 
    $conexion->closeConnection();
    echo '<script>
    window.alert("Usuario registrado exitosamente, inicie sesión por favor."); 
    window.location = "../vistas/index.php";
    </script>';
}else{
    $conexion->closeConnection();
    echo '<script>
    window.alert("Codigos incorrectos"); 
    window.location = "../vistas/index.php";
    </script>';
}
?>