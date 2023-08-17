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
        'categoria','titulo', 'texto_vista_previa', 'descripcion', 'fecha','participantes' ,'imagen_galeria'
    ];


    public function imagenes()
{
    return $this->hasMany(ImagenGaleria::class);
}

public function qr()
    {
        return $this->hasOne(Qr::class);
    }


    // Definir relaciones con otros modelos si es necesario
}
