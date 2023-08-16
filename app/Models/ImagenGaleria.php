<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImagenGaleria;

class ImagenGaleria extends Model
{
    protected $table = 'imagenes_galeria'; // Nombre correcto de la tabla
    protected $fillable = [
        'imagen',
    ];

    public function galeria()
    {
        return $this->belongsTo(Galeria::class);
    }
}