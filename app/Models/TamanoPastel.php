<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamanoPastel extends Model
{
    protected $primaryKey = 'tamano_id';
    protected $table = "tamano";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [        
        'tamano_id',    
        'tamano_descripcion'  
    ];
    public static function getTamanosDescripcion(){
        return self::select('tamano_descripcion')->get();
    }
}
