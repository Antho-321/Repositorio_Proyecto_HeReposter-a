<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $primaryKey = 'comprobante_id';
    protected $table = "comprobante_venta";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'comprobante_id',        
        'pedido_id',
        'fecha_entrega',
        'hora_entrega',
        'total_pago'       
    ];
}
