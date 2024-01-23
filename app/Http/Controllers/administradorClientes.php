<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class administradorClientes extends Controller
{
    public function index(){
        $datos=DB::select("select * from clientes;");
        return view('administrador.clientes')->with("datos", $datos);
        
    }
    
}
