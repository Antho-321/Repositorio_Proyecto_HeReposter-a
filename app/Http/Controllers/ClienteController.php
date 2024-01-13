<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        DB::table('clientes')->insert([
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
