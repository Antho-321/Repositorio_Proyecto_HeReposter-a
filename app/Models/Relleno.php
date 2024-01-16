<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relleno extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'relleno_id';
    protected $table = "rellenos";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'relleno_id', 
        'relleno_descripcion',
        'relleno_altura',
        'relleno_precio_base_volumen'    
    ];
}
