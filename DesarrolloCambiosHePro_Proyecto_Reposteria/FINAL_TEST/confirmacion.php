<?php
include("../php/Conexion.php");
$correo = $_POST['Correo'];
$para = $correo;
//PARTE PARA CHECAR SI ESTA EN LA BASE DE DATOS
$conexion = new Conexion;
$array = $conexion->OperSql("SELECT `Password` FROM `usuario` WHERE `Email`= '$correo';");
$existe = mysqli_fetch_array($array);
$conexion->closeConnection();
if(!isset($existe)){
    echo '<script>
    window.alert("ERROR: Este Email no esta registrado"); 
    window.location = "../html/Index.php";
    </script>';
}else{
    $pass= $existe['Password'];
    $asunto = "Contraseña: " . $pass;
    $cuerpo = "<html>Su código por favor si</html>";
    $salida = shell_exec('node ULTIMO_TEST.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '"');
    echo '<script>
    window.alert("LA CONTRASEÑA SE HA ENVIADO A SU CORREO"); 
    window.location = "../html/Index.php";
    </script>';
}
?>
