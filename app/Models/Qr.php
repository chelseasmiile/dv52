<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    use HasFactory;
    protected $table = 'generador_qr';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'identificador', 'titulo', 'fecha', 'descripcion', 'participantes', 'imagen_qr'
    ];

    // Definir relaciones con otros modelos si es necesario
}
