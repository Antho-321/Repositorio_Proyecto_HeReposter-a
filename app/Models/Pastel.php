<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'codigo_pastel';
    protected $table = "pastel";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['codigo_pastel', 'categoria', 'tamano', 'masa', 'sabor', 'cobertura', 'relleno', 'descripcion', 'precio', 'porciones', 'img'];

    // Este es el método que te permite obtener un pastel por su imagen
    public function getPastelByImg($img)
    {
        // Usas el método where para filtrar los pasteles por la columna img
        // y usas el método first para obtener el primero que cumpla la condición
        
        $pastel = Pastel::where('img', $img)->first();

        // Devuelves el pastel encontrado o null si no hay ninguno
        return $pastel;
    }
}
