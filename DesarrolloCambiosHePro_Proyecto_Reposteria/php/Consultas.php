<?php

    require 'database.php';
    $db= new Database();
    $con = $db->conectar();

    $sql = $con-> prepare("SELECT Codigo, Categoría, Tamaño, Masa, Sabor, Cobertura, Relleno, Descripción, Precio, Img FROM producto ");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado);
?>


