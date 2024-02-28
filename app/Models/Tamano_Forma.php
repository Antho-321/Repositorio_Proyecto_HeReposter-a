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
    public function tamano()
    {
        return $this->belongsTo(TamanoPastel::class, 'tamano_id', 'tamano_id');
    }

    public function forma()
    {
        return $this->belongsTo(FormaPastel::class, 'formas_id', 'formas_id');
    }
    public static function getDetailedDescriptions()
    {
        return self::with(['tamano', 'forma'])
            ->get()
            ->map(function ($tamanoForma) {
                return [
                    'formas_descripcion' => $tamanoForma->forma->formas_descripcion,
                    'tamano_descripcion' => $tamanoForma->tamano->tamano_descripcion,
                    'num_porciones' => $tamanoForma->num_porciones,
                    'altura' => $tamanoForma->altura,
                    'longitud1' => $tamanoForma->longitud1,
                    'longitud2' => $tamanoForma->longitud2,
                    'naranja_chocolate' => $tamanoForma->naranja_chocolate,
                    'naranja_maracuya' => $tamanoForma->naranja_maracuya
                ];
            });
    }

}
