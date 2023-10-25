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
    $cedula = $conexion->OperSql("SELECT MAX(`Id_Usuario`) FROM `usuario`");
    $array_cedula=$cedula->fetch_array();
    $nueva_cedula=$array_cedula['MAX(`Id_Usuario`)'];
    if ($cedula==NULL) {
        $nueva_cedula = 1;    
    }else{
        $nueva_cedula = $nueva_cedula + 1;
    }
    $canasta = $conexion->OperSql("SELECT MAX(`Id_Canasta`) FROM `canasta`");
    $array_canasta=$canasta->fetch_array();
    $nueva_canasta=$array_canasta['MAX(`Id_Canasta`)'];
    if ($nueva_canasta==NULL) {
        $nueva_canasta = 1;    
    }else{
        $nueva_canasta = $nueva_canasta + 1;
    }
    $conexion->OperSql("INSERT INTO `usuario`(`Id_Usuario`, `Email`, `Password`) VALUES ('$nueva_cedula','$correo','$contraseña')"); 
    $conexion->OperSql("INSERT INTO `canasta`(`Id_Canasta`, `Id_Usuario`) VALUES ('$nueva_canasta','$nueva_cedula');");
    $conexion->closeConnection();
    echo '<script>
    window.alert("Usuario registrado exitosamente, inicie sesión por favor."); 
    window.location = "../html/Index.php";
    </script>';
}else{
    $conexion->closeConnection();
    echo '<script>
    window.alert("Codigos incorrectos"); 
    window.location = "../html/Index.php";
    </script>';
}
?>