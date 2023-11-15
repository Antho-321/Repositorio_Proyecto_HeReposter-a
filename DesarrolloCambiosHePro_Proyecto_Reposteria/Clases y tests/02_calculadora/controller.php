<?php
    //iniciamos la sesión (se establece un espacio en el servidor para lo que hace el usuario):
    session_start();
    //instanciar el modelo:
    include_once './Calculadora.php';
    $calculadora = new Calculadora();

    //recibir parámetros:
    $num1=$_REQUEST['num1'];
    $num2=$_REQUEST['num2'];
    $calculadora->iniciar($num1,$num2);
    //realizar los calculos:
    $suma=$calculadora->sumar();
    $resta=$calculadora->restar();
    //guardarlos en sesion
    $_SESSION['suma']=$suma;
    $_SESSION['resta']=$resta;
    //redireccionar navegacion a la siguiente vista:
    
    header('Location: resultado.php');
?>