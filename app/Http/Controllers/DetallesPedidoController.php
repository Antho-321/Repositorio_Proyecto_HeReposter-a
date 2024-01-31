<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use App\Models\Pedido;
use App\Models\DetallesPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DetallesPedidoController extends Controller
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
    public function create()
    {
        //
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
    public function show(string $detalle_id)
    {
        return view('cliente.actualizar_pastel',compact('detalle_id'));
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
    public function update(Pastel $pastel, Request $request)
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

        // Check if the pastel is already in the detalles_pedido for the current pedido
        $detallePedido = DetallesPedido::where('pedido_id', $pedido->pedido_id)
            ->where('pastel_id', $pastel->pastel_id)
            ->first();

        if ($detallePedido) {
            // Update existing record by adding the new cantidad to the existing one
            $detallePedido->cantidad_pastel = $cantidad;
            $detallePedido->dedicatoria = $dedicatoria;
            $detallePedido->save();
        } else {
            // Attach the pastel to the pedido with additional pivot data
            $pedido->pasteles()->attach($pastel->pastel_id, [
                'cantidad_pastel' => $cantidad,
                'dedicatoria' => $dedicatoria
            ]);
        }
    });

    return view('cliente.carrito');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        DetallesPedido::find($id)->delete();
        return view('cliente.carrito');
    }
}
