<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'sabores_id';
    protected $table = "sabores";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'sabores_id',           
        'sabores_descripcion',
        'sabores_precio_base_volumen'        
    ];
}
