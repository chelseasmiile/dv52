<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    use HasFactory;
    protected $table = 'galeria';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'titulo', 'texto_vista_previa', 'descripcion', 'fecha', 'imagen_galeria'
    ];

    public function imagenes()
{
    return $this->hasMany(ImagenGaleria::class);
}


    // Definir relaciones con otros modelos si es necesario
}
