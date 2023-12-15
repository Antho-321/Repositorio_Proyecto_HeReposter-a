<?php
include("../php/Conexion.php");
$correo = $_POST['Correo'];
$para = $correo;
//PARTE PARA CHECAR SI ESTA EN LA BASE DE DATOS
$conexion = new Conexion;
$array = $conexion->OperSql("SELECT `Password` FROM `cliente` WHERE `Email`= '$correo';");
$existe = mysqli_fetch_array($array);
$conexion->closeConnection();
if(!isset($existe)){
    echo '<script>
    window.alert("ERROR: Este Email no esta registrado"); 
    window.location = "../html/Index.php";
    </script>';
}else{
    $pass= $existe['Password'];
    $asunto = "Recuperación de cuenta";
    $cuerpo = "Contraseña";
    $texto2="Hemos recibido una solicitud de recuperación de contraseña para tu cuenta en nuestro sitio web de pastelería utilizando tu dirección de correo electrónico. Tu contraseña es la siguiente:";
    $texto3="Si no has solicitado la recuperación de contraseña, por favor ignora este mensaje o ponte en contacto con nosotros para solucionarlo. Gracias por elegir Pankey para disfrutar de nuestras deliciosas opciones de pastelería.";
    $salida = shell_exec('node ULTIMO_TEST.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '" "' . $asunto . '" "' . $texto2 . '" "' . $texto3 . '" "' . $pass . '"');
    echo '<script>
    window.alert("LA CONTRASEÑA SE HA ENVIADO A SU CORREO"); 
    window.location = "../html/Index.php";
    </script>';
}
?>
