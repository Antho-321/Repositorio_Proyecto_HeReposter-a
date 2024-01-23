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
}
