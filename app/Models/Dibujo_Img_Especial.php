<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dibujo_Img_Especial extends Model
{
    protected $primaryKey = 'dibujo_img_especial_id';
    protected $table = "dibujo_img_especial";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'dibujo_img_especial_id',
        'enlace'
    ];
    /**
     * Get the last ID of the "dibujo_img_especial" table.
     *
     * @return int The last dibujo_img_especial_id.
     */
    public static function getLastId()
    {
        $lastRecord = self::orderBy('dibujo_img_especial_id', 'desc')->first();
        return $lastRecord ? $lastRecord->dibujo_img_especial_id : 0;
    }
}
