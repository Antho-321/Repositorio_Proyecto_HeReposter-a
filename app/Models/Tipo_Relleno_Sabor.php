<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Relleno_Sabor extends Model
{
    protected $primaryKey = 'tipo_relleno_sabor_id';
    protected $table = "tipo_relleno_sabor";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [        
        'tipo_relleno_sabor_id',    
        'tipo_id',    
        'rellenos',    
        'sabores_id' 
    ];
    public function tipo()
    {
        return $this->belongsTo(TipoPastel::class, 'tipo_id', 'tipo_id');
    }

    public function sabor()
    {
        return $this->belongsTo(Sabor::class, 'sabores_id', 'sabores_id');
    }
    public static function getRellenosSaboresDetails()
{
    return self::with(['tipo', 'sabor'])
               ->orderBy('tipo_relleno_sabor_id')
               ->get()
               ->map(function ($tipoRellenoSabor) {
                   // Check if the sabor relation is loaded and is not null
                   $saboresDescripcion = $tipoRellenoSabor->sabor ? $tipoRellenoSabor->sabor->sabores_descripcion : 'N/A'; // Use 'N/A' or any placeholder you prefer

                   return [
                       'tipo_descripcion' => $tipoRellenoSabor->tipo ? $tipoRellenoSabor->tipo->tipo_descripcion : 'N/A', // Similarly handle nullable 'tipo'
                       'rellenos' => $tipoRellenoSabor->rellenos,
                       'sabores_descripcion' => $saboresDescripcion,
                   ];
               });
}


}
