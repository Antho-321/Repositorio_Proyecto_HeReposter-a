<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'codigo_pastel';
    protected $table = "pastel";
    use HasFactory;
protected $fillable = ['codigo_pastel', 'categoria', 'tamano', 'masa', 'sabor', 'cobertura', 'relleno', 'descripcion', 'precio', 'porciones', 'img'];

}
