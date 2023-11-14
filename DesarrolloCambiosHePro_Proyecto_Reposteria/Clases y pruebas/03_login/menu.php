<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú principal</title>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['control_login'])){
        $control_login=$_SESSION['control_login'];
        if($control_login!="OK"){
            echo "Error, no  ha iniciado login";
        }else{
            $usuario=$_SESSION['usuario'];
        echo "<h2>Bienvenido al sistema</h2><h3>$usuario</h3>";
        }
    }else{
        echo "Error2, no ha iniciado login";
        echo "<a href='index.php'>Ir a Login</a>";
    }
    ?>
    
</body>
</html>