<?php
    //iniciar sesion
    session_start();
    //recibir parámetros
    $nombres=$_REQUEST['nombres'];
    $curso=$_REQUEST['curso'];
    $nota1=$_REQUEST['nota1'];
    $nota2=$_REQUEST['nota2'];
    //procesamiento con el Model
    include_once "./ModelCertificado.php";
    $model = new ModelCertificado();
    $resultado=$model->registrarDatos($nombres,$curso,$nota1,$nota2);
    $_SESSION['resultado']=$resultado;

    //redireccionar la navegacion
    header('Location: certificado.php');
?>