<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'detalle_id';
    protected $table = "detalles_pedido";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'detalle_id',           
        'pedido_id',            
        'tamanos_formas_id',    
        'tipo_id',              
        'relleno_id',           
        'cobertura_id',         
        'sabores_id',           
        'id_varios',            
        'cantidad',
        'precio',               
        'img',
        'especificacion_adicional',
        'categoria_id',
        'dedicatoria'         
    ];

    // Este es el método que permite obtener un pastel por su imagen
    public function getPastelByImg($img)
    {
        // Usas el método where para filtrar los pasteles por la columna img
        // y usas el método first para obtener el primero que cumpla la condición
        
        $pastel = Pastel::where('img', $img)->first();

        // Devuelves el pastel encontrado o null si no hay ninguno
        return $pastel;
    }
    // Este es el método que permite obtener el número de porciones de un pastel
    public function getNumPorcionesPastel()
    {      
        $tamanos_formas_id=$this->tamanos_formas_id;
        $tamano_forma = Tamano_Forma::where('tamanos_formas_id', $tamanos_formas_id)->first();
        $num_porciones=$tamano_forma->num_porciones;
        return $num_porciones;
    }
    // Este es el método que permite obtener el nombre del tipo de un pastel
    public function getTipoPastel()
    {      
        $tipo_id=$this->tipo_id;
        $tipo = TipoPastel::where('tipo_id', $tipo_id)->first();
        $nombre_tipo=$tipo->tipo_descripcion;
        return $nombre_tipo;
    }
    // Este es el método que permite obtener el nombre de la cobertura de un pastel
    public function getCoberturaPastel()
    {      
        $cobertura_id=$this->cobertura_id;
        $cobertura = Cobertura::where('cobertura_id', $cobertura_id)->first();
        $nombre_cobertura=$cobertura->cobertura_descripcion;
        return $nombre_cobertura;
    }
}
