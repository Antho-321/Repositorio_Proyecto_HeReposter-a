<?php

namespace App\Http\Controllers;

use App\Models\Pastel;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $pastel->fill($request->all());

        $cliente = Session::get('cliente');
        $cliente_id = $cliente->cliente_id;
        $pedido = new Pedido();
        $pedido_search = $pedido->getPedidosNoConfirmadosPorCliente($cliente_id);
        if ($pedido_search->isEmpty()) {
            $pedido->cliente_id = $cliente_id;
            $pedido->pedido_confirmado = false;
            $pedido->save();
            $pedido_id=$pedido->pedido_id;
            $pastel->pedido_id = $pedido->pedido_id;
            Session::put('pedido', $pedido);
        } else {
            $pastel->pedido_id = $pedido_search[0]->pedido_id;
            $pedido_id=$pedido_search[0]->pedido_id;
            Session::put('pedido', $pedido_search[0]);
        }
        
        $pastel->save();
        $pasteles=$pastel->getPastelesByPedidoId($pedido_id);
        Session::put('pasteles_carrito', $pasteles);
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
