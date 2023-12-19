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
        $sql = "select * from auditoria order by ID_AUDITORIA";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Reserva:
        $listado = array();
        foreach ($resultado as $res) {
            $auditor = new Auditor();
            $auditor->setID_AUDITORIA($res['ID_AUDITORIA']);
            $auditor->setCEDULA_USUARIO($res['CEDULA_USUARIO']);
            $auditor->setFECHA($res['FECHA']);
            $auditor->setHORA($res['HORA']);
            $auditor->setTABLA_AFECTADA($res['TABLA_AFECTADA']);
            $auditor->setOPERACION_REALIZADA($res['OPERACION_REALIZADA']);
            $auditor->setNOMBRE_USUARIO($res['NOMBRE_USUARIO']);
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
        $sql = "SELECT COUNT(*) AS CANTIDAD_OPERACION FROM auditoria WHERE OPERACION_REALIZADA = '$nombre_accion' AND TABLA_AFECTADA='$nombre_tabla' GROUP BY NOMBRE_USUARIO ORDER BY CANTIDAD_OPERACION DESC LIMIT 1;";
        $consulta_num_max = $pdo->query($sql);
        $sql = "CREATE OR REPLACE VIEW OPERACIONES AS SELECT COUNT(*) AS CANTIDAD_OPERACION FROM auditoria WHERE OPERACION_REALIZADA = '$nombre_accion' AND TABLA_AFECTADA='$nombre_tabla' GROUP BY NOMBRE_USUARIO ORDER BY CANTIDAD_OPERACION;";
        $creacionVista = $pdo->query($sql);
        $fila_num_max = $consulta_num_max->fetch(PDO::FETCH_ASSOC); // Esto devuelve un array asociativo con los nombres de las columnas como claves 
        $rango = $fila_num_max['CANTIDAD_OPERACION']; // Esto asigna el valor de la columna CANTIDAD_OPERACION a la variable $listado
        $reporte = new Reporte();
        $reporte->setNRO_DE_INSERCIONES($rango);

        $sql = "SELECT COUNT(*) CANTIDAD_OPERACION FROM OPERACIONES WHERE CANTIDAD_OPERACION BETWEEN ".$reporte->getNRO_DE_INSERCIONES()[2]." AND ".$reporte->getNRO_DE_INSERCIONES()[3].";";
        $consulta_cantidad_operacion = $pdo->query($sql);
        $array_cantidad_operacion=$consulta_cantidad_operacion->fetch(PDO::FETCH_ASSOC);
        $cantidad1_operacion=$array_cantidad_operacion['CANTIDAD_OPERACION'];

        $sql = "SELECT COUNT(*) CANTIDAD_OPERACION FROM OPERACIONES WHERE CANTIDAD_OPERACION BETWEEN ".$reporte->getNRO_DE_INSERCIONES()[1]." AND ".($reporte->getNRO_DE_INSERCIONES()[2]-1).";";
        $consulta_cantidad_operacion = $pdo->query($sql);
        $array_cantidad_operacion=$consulta_cantidad_operacion->fetch(PDO::FETCH_ASSOC);
        $cantidad2_operacion=$array_cantidad_operacion['CANTIDAD_OPERACION'];
        
        $sql = "SELECT COUNT(*) CANTIDAD_OPERACION FROM OPERACIONES WHERE CANTIDAD_OPERACION BETWEEN ".$reporte->getNRO_DE_INSERCIONES()[0]." AND ".($reporte->getNRO_DE_INSERCIONES()[1]-1).";";
        $consulta_cantidad_operacion = $pdo->query($sql);
        $array_cantidad_operacion=$consulta_cantidad_operacion->fetch(PDO::FETCH_ASSOC);
        $cantidad3_operacion=$array_cantidad_operacion['CANTIDAD_OPERACION'];

        //transformamos los registros en objetos de tipo Reserva:
        $reporte->setNRO_DE_USUARIOS(array($cantidad1_operacion,$cantidad2_operacion,$cantidad3_operacion));
        $listado = array();

       

        // foreach ($resultado as $res) {
        //     $auditor = new Auditor();
        //     $auditor->setID_AUDITORIA($res['ID_AUDITORIA']);
        //     $auditor->setCEDULA_USUARIO($res['CEDULA_USUARIO']);
        //     $auditor->setFECHA($res['FECHA']);
        //     $auditor->setHORA($res['HORA']);
        //     $auditor->setTABLA_AFECTADA($res['TABLA_AFECTADA']);
        //     $auditor->setOPERACION_REALIZADA($res['OPERACION_REALIZADA']);
        //     $auditor->setNOMBRE_USUARIO($res['NOMBRE_USUARIO']);
        array_push($listado, $reporte);
        // }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
}
