<?php

$imagen = $_GET['imagen'];

// Conexión a la base de datos
include("../php/Conexion.php");
$conexion= new Conexion;
// Consulta a la base de datos
if (strpos($imagen, "http") !== false||strpos($imagen, "../") !== false) {
    //$sql = "DELETE FROM pastel WHERE `Img`='$imagen'";
    
    $consulta= $conexion->OperSql("DELETE FROM `pastel` WHERE `img`='$imagen'");
    //$consulta= $conexion->OperSql("SELECT '$imagen'");
} else {
    //$sql = "SELECT `Img` FROM pastel";
    $consulta= $conexion->OperSql("SELECT `img` FROM pastel");


//id de la canasta

}



// Si se utilizó una consulta DELETE, enviar respuesta vacía

if (strpos($imagen, "http") !== false||strpos($imagen, "../") !== false) {
    if(strpos($imagen, "../") !== false){
        if (file_exists($imagen)) { // Verifica si el archivo existe
            if (unlink($imagen)) { // Elimina el archivo utilizando unlink()
              $resultado= "Archivo eliminado con éxito";
            } else {
                $resultado= "No se pudo eliminar el archivo";
            }
          } else {
            $resultado= "El archivo no existe";
          }
    }else{
        $resultado="eliminado";
    }
    $data = array(
        'producto' => $resultado
    ); 
    
 } else {
    while ($id_array= $consulta->fetch_assoc())
    $userinfo[] = $id_array;
    // Convertir resultados en formato JSON
    $data = array(
        $userinfo
    ); 
}
$json_data = json_encode($data);

// Imprimir resultado en formato JSON
//echo $json_data;
echo $json_data;
// Cerrar conexión

?>