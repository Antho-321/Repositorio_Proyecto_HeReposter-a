<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamano_Forma extends Model
{
    protected $primaryKey = 'tamanos_formas_id';
    protected $table = "tamanos_formas";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [        
        'tamanos_formas_id',    
        'tamano_id',    
        'formas_id',    
        'num_porciones',    
        'altura',    
        'longitud1',    
        'longitud2'    
    ];
}
