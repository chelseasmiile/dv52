<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    use HasFactory;

    protected $table = 'generador_qr';

    protected $fillable = [
        'identificador',
        'titulo',
        'fecha',
        'descripcion',
        'participantes',
        'imagen_qr',
        'galeria_id'
    ];

    public function galeria()
    {
        return $this->belongsTo(Galeria::class);
    }
}
