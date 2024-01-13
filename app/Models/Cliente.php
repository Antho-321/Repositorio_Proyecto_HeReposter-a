<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'cliente_id';
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'cliente_id',
        'cedula',
        'nombre_cliente',
        'telefono',
        'direccion_domicilio',
        'email',
        'clave'
    ];
}
