<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'pastel_id';
    protected $table = "pastel";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'pastel_id',                     
        'tamanos_formas_id',    
        'tipo_id',              
        'relleno_id',           
        'cobertura_id',         
        'sabores_id',                  
        'precio',               
        'img',
        'categoria_id'        
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
    // Este es el método que permite obtener un conjunto de pasteles por su categoria
    public function getPastelesByCategoria($categoria_descripcion)
    {
        // Usas el método where para filtrar los pasteles por la columna img
        // y usas el método first para obtener el primero que cumpla la condición
        $categoria_search = new Categoria();
        $categoria_id = $categoria_search->getCategoriaId($categoria_descripcion);
        $pasteles = Pastel::where('categoria_id', $categoria_id)->get();
        // Devuelves el pastel encontrado o null si no hay ninguno
        return $pasteles;
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
    // Este es el método que permite obtener el nombre del sabor de un pastel
    public function getSaborPastel()
    {      
        $sabores_id=$this->sabores_id;
        $sabores = Sabor::where('sabores_id', $sabores_id)->first();
        $nombre_sabor=$sabores->sabores_descripcion;
        return $nombre_sabor;
    }
    // Este es el método que permite obtener el nombre del sabor de un pastel
    public function getRellenoPastel()
    {      
        $relleno_id=$this->relleno_id;
        $relleno = Relleno::where('relleno_id', $relleno_id)->first();
        $nombre_relleno=$relleno->relleno_descripcion;
        return $nombre_relleno;
    }
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'detalles_pedido', 'pastel_id', 'pedido_id');
    }
}
