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
    public function pasteles()
    {
        return $this->belongsToMany(Pastel::class, 'detalles_pedido', 'pedido_id', 'pastel_id')
                    ->withPivot('cantidad_pastel', 'dedicatoria');
    }
    public function getPedidoById($pedido_id){
        $pedido = Pedido::where('pedido_id', $pedido_id)->first();

        // Devuelves el pastel encontrado o null si no hay ninguno
        return $pedido;
    }
}
