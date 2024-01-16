<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'categoria_id';
    protected $table = "categoria";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'categoria_id',  
        'categoria_descripcion'
    ];
    public function getCategoriaId($categoria_descripcion)
    {        
        $categoria = Categoria::where('categoria_descripcion', $categoria_descripcion)->first();
        // Devuelves el pastel encontrado o null si no hay ninguno
        $id=$categoria->categoria_id;
        return $id;
    }
}
