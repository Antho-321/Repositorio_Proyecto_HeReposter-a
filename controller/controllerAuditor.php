<?php
///////////////////////////////////////////////////////////////////////
//Componente controller que verifica la opcion seleccionada
//por el usuario, ejecuta el modelo y enruta la navegacion de paginas.
///////////////////////////////////////////////////////////////////////
require_once '../model/AuditorModel.php';
session_start();
$auditorModel = new AuditorModel();
$opcion = $_REQUEST['opcion'];
echo $opcion;
switch ($opcion) {
    case "listar":
        //obtenemos la lista de productos:
        $listado = $auditorModel->getListado();
        //y los guardamos en sesion:
        echo "TESTTT " . $listado;
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../vistas/principalAuditor.php');
        break;
    case "reporte":
        //obtenemos la lista de productos:
        if (isset($_REQUEST['nombre_tabla'])) {
            $nombre_tabla = $_REQUEST['nombre_tabla'];
            $nombre_accion = $_REQUEST['nombre_accion'];
            $listado = $auditorModel->getReporte($nombre_tabla,$nombre_accion);
            $_SESSION['nombre_tabla']=$nombre_tabla;
            $_SESSION['nombre_accion']=$nombre_accion;
        }else{
            if (isset($_SESSION['nombre_tabla'])) {
                $listado = $auditorModel->getReporte($_SESSION['nombre_tabla'],$_SESSION['nombre_consulta']);
            }else{
                $listado = $auditorModel->getReporte("canasta","INSERT");
            }
            
        }
        
        echo "testing";
        //$listado = $auditorModel->getReporte($nombre_tabla,$nombre_accion);
        //y los guardamos en sesion:
        //echo "TESTTT " . $listado;
        $_SESSION['reporte'] = serialize($listado);
        
        header('Location: ../vistas/reporteAuditor.php');
        break;
    // default:
    //     //si no existe la opcion recibida por el controlador, siempre
    //     //redirigimos la navegacion a la pagina index:
    //     header('Location: ../vistas/principalAuditor.php');
}
