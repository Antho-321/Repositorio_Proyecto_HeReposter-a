<?php

$imagen = $_GET['imagen'];

// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', 'root', 'db_pankey');

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta a la base de datos
if (strpos($imagen, "http") !== false) {
    $sql = "DELETE FROM producto WHERE `Img`='".$imagen."'";
} else {
    $sql = "SELECT `Img` FROM producto";
}

$result = mysqli_query($conn, $sql);

// Verificar consulta
if (!$result) {
    die("Consulta fallida: " . mysqli_error($conn));
}

// Si se utilizó una consulta DELETE, enviar respuesta vacía
if (strpos($imagen, "http") !== false) {
    echo "";
} else {
    // Convertir resultados en formato JSON
    $jsonData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $jsonData[] = $row;
    }

    // Enviar respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($jsonData);
}

// Cerrar conexión
mysqli_close($conn);
?>