<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'pedido_id';
    protected $table = "pedido";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'pedido_id',
        'cliente_id',
        'fecha_pedido',
        'fecha_entrega',
        'hora_entrega',
        'pedido_confirmado'
    ];
    public function getPedidosNoConfirmadosPorCliente($cliente_id)
    {
        $pedidos = Pedido::where([
            ['pedido_confirmado', false],
            ['cliente_id', $cliente_id]
        ])->get();
        return $pedidos;
    }

}
