<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PastelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pastel = Pastel::orderBy('codigo_pastel', 'DESC')->get();
        return view('pastel.index', compact('pastel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'categoria' => 'required',
            'tamano' => 'required',
            'masa' => 'required',
            'sabor' => 'required',
            'cobertura' => 'required',
            'relleno' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'porciones' => 'required',
            'img' => 'required'
        ]);
        Pastel::create($request->all());
        return redirect()->route('pastel.index')->with('success', 'Registro
creado satisfactoriamente');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigo_pastel)
    {


        // Buscar el pastel por su código o lanzar una excepción si no existe
        $pastel = Pastel::findOrFail($codigo_pastel);
        // Actualizar los atributos con un solo array de valores
        $pastel->update([
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

        // // Retornar una respuesta al usuario con el modelo actualizado y la variable img
        return view('/InicioAdministración');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $img = $request->input('img'); // Directly use the img parameter

        // Ensure the URL is decoded
        $img = urldecode($img);

        return view('/actualizar_seleccionado', compact('img'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $codigo_pastel)
    {
        // Busca el pastel por el campo codigo_pastel
        $pastel = Pastel::where('codigo_pastel', $codigo_pastel)->first();

        return view('pastel.edit', compact('pastel'));
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $img = $request->input('img');
        // Busca el pastel por el atributo img
        $pastel = Pastel::where('img', $img)->first();
        // Delete the product
        $pastel->delete();

        // Redirect to a certain route after deletion
        return view('/InicioAdministración');
    }
}
