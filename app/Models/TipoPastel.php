<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPastel extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'tipo_id';
    protected $table = "tipo";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'tipo_id',     
        'tipo_descripcion',
        'tipo_precio_base_volumen'         
    ];
}
