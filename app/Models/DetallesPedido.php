<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesPedido extends Model
{
    protected $primaryKey = 'detalle_id';
    protected $table = "detalles_pedido";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'detalle_id',        
        'pedido_id',
        'id_varios',
        'pastel_id',
        'cantidad_pastel',
        'cantidad_varios',
        'dedicatoria',
        'especificacion_adicional'        
    ];

    public function getPastelesByPedido($pedido_id){
        // Usas el método select para indicar que solo quieres la columna pastel_id
        // Usas el método where para filtrar los detalles por el pedido_id que recibes como parámetro
        // Usas el método get para ejecutar la consulta y obtener una colección de resultados
        $pasteles = DetallesPedido::select('pastel_id')->where('pedido_id', $pedido_id)->get();
        // Devuelves la colección de pasteles o null si no hay ninguno
        return $pasteles;
    }
    public function getDetallesPedidoByPedido($pedido_id){
        $detalles_pedido=DetallesPedido::where('pedido_id',$pedido_id)->get();
        return $detalles_pedido;
    }
    public function getDetallesPedidoById($detalle_id){
        $detalles_pedido = DetallesPedido::where('detalle_id', $detalle_id)->first();

        // Devuelves el pastel encontrado o null si no hay ninguno
        return $detalles_pedido;
    }
}
