<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditorController extends Controller
{
    //TABLA CLIENTES
    public function ver_auditoria()
    {
        // Obtener datos de auditoria
        $datos = DB::select("select * from auditoria");

        // Calcular datos para el gráfico de pastel
        $operacionesRealizadasData = [];
        foreach ($datos as $item) {
            $operacion = $item->operacion_realizada;

            if (isset($operacionesRealizadasData[$operacion])) {
                $operacionesRealizadasData[$operacion]++;
            } else {
                $operacionesRealizadasData[$operacion] = 1;
            }
        }

        // Pasar datos a la vista
        return view("/auditor/auditor_tbl_auditoria")
            ->with("datos", $datos)
            ->with("operacionesRealizadasData", $operacionesRealizadasData);
    }
    public function ver_clientes()
    {
        $datos=DB::select("select * from clientes");
        return view("/auditor/auditor_tbl_clientes")->with("datos",$datos);
    }
    public function ver_pedido()
    {
        $datos=DB::select("select * from pedido");
        return view("/auditor/auditor_tbl_pedido")->with("datos",$datos);
    }
    public function ver_detalles_pedido()
    {
        $datos=DB::select("select * from detalles_pedido");
        return view("/auditor/auditor_tbl_detalles_pedido")->with("datos",$datos);
    }
    public function ver_comprobante_venta()
    {
        $datos=DB::select("select * from comprobante_venta");
        return view("/auditor/auditor_tbl_comprobante_venta")->with("datos",$datos);
    }

}
