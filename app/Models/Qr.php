<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Qr;
use App\Models\Galeria;

class Qr extends Model
{
    protected $table = 'generador_qr';

    protected $fillable = [
        'identificador', 'titulo', 'fecha', 'descripcion', 'participantes'
    ];

    public function galeria()
    {
        return $this->belongsTo(Galeria::class);
    }
}
