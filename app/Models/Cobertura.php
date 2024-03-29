<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'cobertura_id';
    protected $table = "cobertura";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'cobertura_id',        
        'cobertura_descripcion',
        'cobertura_precio_base_volumen'        
    ];
    public static function getCoberturasDescripcion(){
        // Adjust the select method to include both 'tipo_descripcion' and 'precio_base_volumen'
        return self::select('cobertura_descripcion', 'cobertura_precio_base_volumen')->get();
    }
}
