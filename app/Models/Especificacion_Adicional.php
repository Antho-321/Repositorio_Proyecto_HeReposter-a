<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especificacion_Adicional extends Model
{
    protected $primaryKey = 'especificacion_adicional_id';
    protected $table = "especificacion_adicional";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'especificacion_adicional_id',
        'descripcion',
        'enlace'
    ];
    /**
     * Get the last ID of the "especificacion_adicional" table.
     *
     * @return int The last especificacion_adicional_id.
     */
    public static function getLastId()
    {
        $lastRecord = self::orderBy('especificacion_adicional_id', 'desc')->first();
        return $lastRecord ? $lastRecord->especificacion_adicional_id : 0;
    }
}
