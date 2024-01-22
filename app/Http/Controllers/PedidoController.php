<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pastel $pastel, Request $request)
{
    // Assuming you have set the fillable properties in the Pastel model
    $pastel->fill($request->all());

    // Retrieve the cliente object from the session
    $cliente = Session::get('cliente');
    $cliente_id = $cliente->cliente_id;

    // Use a transaction to ensure database integrity
    DB::transaction(function () use ($cliente_id, $pastel, $request) {
        // Find the first non-confirmed pedido for the cliente or create a new one
        $pedido = Pedido::firstOrCreate(
            ['cliente_id' => $cliente_id, 'pedido_confirmado' => false]
        );
    
        // Get cantidad and dedicatoria from the request
        $cantidad = $request->input('cantidad', 1); // Default to 1 if not provided
        $dedicatoria = $request->input('dedicatoria', ''); // Default to an empty string
    
        // Attach the pastel to the pedido with additional pivot data
        $pedido->pasteles()->attach($pastel->pastel_id, [
            'cantidad_pastel' => $cantidad,
            'dedicatoria' => $dedicatoria
        ]);
    
        // Load the pasteles relationship with pivot data
        $pedido->load(['pasteles' => function ($query) {
            $query->withPivot('cantidad_pastel', 'dedicatoria');
        }]);
    
        // Update the session
        Session::put('pedido', $pedido);
        Session::put('pasteles_carrito', $pedido->pasteles);
    });

    return view('cliente.carrito');
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
