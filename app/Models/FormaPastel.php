<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPastel extends Model
{
    protected $primaryKey = 'formas_id';
    protected $table = "formas";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [        
        'formas_id',    
        'formas_descripcion'   
    ];
    public static function getFormasDescripcion()
    {
        return self::select('formas_descripcion')->get();
    }
}
