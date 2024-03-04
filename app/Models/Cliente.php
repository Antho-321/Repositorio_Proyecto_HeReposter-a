<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'cliente_id';
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'cliente_id',
        'cedula',
        'nombre_cliente',
        'telefono',
        'direccion_domicilio',
        'email',
        'clave'
    ];
    // Este es el método que te permite obtener un cliente por su email
    public function getClienteByEmail($email)
    {
        // Usas el método where para filtrar los pasteles por la columna img
        // y usas el método first para obtener el primero que cumpla la condición
        
        $cliente = Cliente::where('email', $email)->first();

        // Devuelves el pastel encontrado o null si no hay ninguno
        return $cliente;
    }
    public function getClienteById($cliente_id)
    {
        // Usas el método where para filtrar los pasteles por la columna img
        // y usas el método first para obtener el primero que cumpla la condición
        
        $pastel = Cliente::where('cliente_id', $cliente_id)->first();

        // Devuelves el pastel encontrado o null si no hay ninguno
        return $pastel;
    }
}
