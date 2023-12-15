<?php
$usuario= $_POST['user'];
$pass = $_POST['pass'];
if($pass== "admin" && $usuario=="admin@admin"){
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