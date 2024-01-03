<?php

$imagen = $_GET['imagen'];

// Conexión a la base de datos
$host = "localhost";
$user = "anthonyluisluna225";
$pass = "anthonyluisluna225";
$dbname = "db_pankey";
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Consulta a la base de datos
if (strpos($imagen, "http") !== false || strpos($imagen, "../") !== false) {
    $consulta = mysqli_query($conn, "DELETE FROM `pastel` WHERE `img`='$imagen'");
} else {
    $consulta = mysqli_query($conn, "SELECT `img` FROM pastel");
}

// Si se utilizó una consulta DELETE, enviar respuesta vacía
if (strpos($imagen, "http") !== false || strpos($imagen, "../") !== false) {
    if (strpos($imagen, "../") !== false) {
        if (file_exists($imagen)) { // Verifica si el archivo existe
            if (unlink($imagen)) { // Elimina el archivo utilizando unlink()
                $resultado = "Archivo eliminado con éxito";
            } else {
                $resultado = "No se pudo eliminar el archivo";
            }
        } else {
            $resultado = "El archivo no existe";
        }
    } else {
        $resultado = "eliminado";
    }
    $data = array(
        'producto' => $resultado
    );
} else {
    while ($id_array = $consulta->fetch_assoc())
        $userinfo[] = $id_array;
    // Convertir resultados en formato JSON
    $data = array(
        $userinfo
    );
}
$json_data = json_encode($data);

// Imprimir resultado en formato JSON
echo $json_data;

// Cerrar conexión
mysqli_close($conn);

?>
