<?php
session_start();
$usuario= $_POST['user'];
$pass = $_POST['pass'];
if($pass== "c@f3c0np@n" && $usuario=="luchitolondra522@gmail.com"){
    $_SESSION['correo_actual']="luchitolondra522@gmail.com";
    echo '<script>
    window.alert("Ingreso correcto"); 
    window.location = "../vistas/InicioAdministración.php";
    </script>';
}else{
    echo '<script>
    window.alert("Error en credenciales"); 
    window.location = "../vistas/admin.php";
    </script>';
}
?>