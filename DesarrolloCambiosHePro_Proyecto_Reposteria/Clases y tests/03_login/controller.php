<?php
    //iniciar sesion web
    session_start();
    //recibir parámetros
    $usuario=$_REQUEST['usuario'];
    $clave=$_REQUEST['clave'];

    echo $usuario;
    echo "<br/>";
    echo $clave;

    //invocar al model
    include_once "./ModelLogin.php";
    $modelLogin=new ModelLogin();
    $resultado=$modelLogin->validarCredencial($usuario,$clave);

    //redirigir la navegación
    if($resultado==true){
        $_SESSION['usuario']=$usuario;
        $_SESSION['control_login']="OK";
        header('Location: menu.php');
    }else{
        header('Location: errorLogin.php');
    }
?>