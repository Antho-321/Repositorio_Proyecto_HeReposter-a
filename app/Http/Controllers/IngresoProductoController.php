<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IngresoProductoController extends Controller
{
    public function store(Request $request){
        // Insertar un nuevo registro en la tabla productos
        DB::table('pastel')->insert([
            'categoria' => $request->input('categoria'),
            'tamano' => $request->input('tamano'),
            'masa' => $request->input('masa'),
            'sabor' => $request->input('sabor'),
            'cobertura' => $request->input('cobertura'),
            'relleno' => $request->input('relleno'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'porciones' => $request->input('porciones'),
            'img' => $request->input('img')
        ]);

        // Retornar una respuesta al usuario
        return view('InicioAdministración');
    }
}
