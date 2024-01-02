<?php
include 'DatabaseAuditor.php';
include 'Auditor.php';
include 'Reporte.php';
/**
 * Componente model para el manejo de productos.
 *
 * @author mrea
 */
class AuditorModel
{
    /**
     * Obtiene todos las reservas de la base de datos.
     * @return array
     */
    public function getListado()
    {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from auditoria order by id_auditoria";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Reserva:
        $listado = array();
        foreach ($resultado as $res) {
            $auditor = new Auditor();
            $auditor->setid_auditoria($res['id_auditoria']);
            $auditor->setcedula_usuario($res['cedula_usuario']);
            $auditor->setfecha($res['fecha']);
            $auditor->sethora($res['hora']);
            $auditor->settabla_afectada($res['tabla_afectada']);
            $auditor->setoperacion_realizada($res['operacion_realizada']);
            $auditor->setnombre_usuario($res['nombre_usuario']);
            array_push($listado, $auditor);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }

    public function getReporte($nombre_tabla,$nombre_accion)
    {

        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) AS cantidad_operacion FROM auditoria WHERE operacion_realizada = '$nombre_accion' AND tabla_afectada='$nombre_tabla' GROUP BY nombre_usuario ORDER BY cantidad_operacion DESC LIMIT 1;";
        $consulta_num_max = $pdo->query($sql);
        $sql = "CREATE OR REPLACE VIEW operaciones AS SELECT COUNT(*) AS cantidad_operacion FROM auditoria WHERE operacion_realizada = '$nombre_accion' AND tabla_afectada='$nombre_tabla' GROUP BY nombre_usuario ORDER BY cantidad_operacion;";
        $creacionVista = $pdo->query($sql);
        $fila_num_max = $consulta_num_max->fetch(PDO::FETCH_ASSOC); // Esto devuelve un array asociativo con los nombres de las columnas como claves 
        $rango = $fila_num_max['cantidad_operacion']; // Esto asigna el valor de la columna cantidad_operacion a la variable $listado
        $reporte = new Reporte();
        $reporte->setNRO_DE_INSERCIONES($rango);

        $sql = "SELECT COUNT(*) cantidad_operacion FROM operaciones WHERE cantidad_operacion BETWEEN ".$reporte->getNRO_DE_INSERCIONES()[2]." AND ".$reporte->getNRO_DE_INSERCIONES()[3].";";
        $consulta_cantidad_operacion = $pdo->query($sql);
        $array_cantidad_operacion=$consulta_cantidad_operacion->fetch(PDO::FETCH_ASSOC);
        $cantidad1_operacion=$array_cantidad_operacion['cantidad_operacion'];

        $sql = "SELECT COUNT(*) cantidad_operacion FROM operaciones WHERE cantidad_operacion BETWEEN ".$reporte->getNRO_DE_INSERCIONES()[1]." AND ".($reporte->getNRO_DE_INSERCIONES()[2]-1).";";
        $consulta_cantidad_operacion = $pdo->query($sql);
        $array_cantidad_operacion=$consulta_cantidad_operacion->fetch(PDO::FETCH_ASSOC);
        $cantidad2_operacion=$array_cantidad_operacion['cantidad_operacion'];
        
        $sql = "SELECT COUNT(*) cantidad_operacion FROM operaciones WHERE cantidad_operacion BETWEEN ".$reporte->getNRO_DE_INSERCIONES()[0]." AND ".($reporte->getNRO_DE_INSERCIONES()[1]-1).";";
        $consulta_cantidad_operacion = $pdo->query($sql);
        $array_cantidad_operacion=$consulta_cantidad_operacion->fetch(PDO::FETCH_ASSOC);
        $cantidad3_operacion=$array_cantidad_operacion['cantidad_operacion'];

        //transformamos los registros en objetos de tipo Reserva:
        $reporte->setNRO_DE_USUARIOS(array($cantidad1_operacion,$cantidad2_operacion,$cantidad3_operacion));
        $listado = array();

       

        // foreach ($resultado as $res) {
        //     $auditor = new Auditor();
        //     $auditor->setid_auditoria($res['id_auditoria']);
        //     $auditor->setcedula_usuario($res['cedula_usuario']);
        //     $auditor->setfecha($res['fecha']);
        //     $auditor->sethora($res['hora']);
        //     $auditor->settabla_afectada($res['tabla_afectada']);
        //     $auditor->setoperacion_realizada($res['operacion_realizada']);
        //     $auditor->setnombre_usuario($res['nombre_usuario']);
        array_push($listado, $reporte);
        // }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
}
