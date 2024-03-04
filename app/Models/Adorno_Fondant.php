<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adorno_Fondant extends Model
{
    protected $primaryKey = 'adorno_fondant_id';
    protected $table = "adorno_fondant";
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'adorno_fondant_id',
        'enlace'
    ];
    /**
     * Get the last ID of the "adorno_fondant" table.
     *
     * @return int The last adorno_fondant_id.
     */
    public static function getLastId()
    {
        $lastRecord = self::orderBy('adorno_fondant_id', 'desc')->first();
        return $lastRecord ? $lastRecord->adorno_fondant_id : 0;
    }
}
