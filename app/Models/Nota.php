<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $table = 'notas';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'titulo', 'texto_vista_previa', 'descripcion', 'fecha', 'imagen_nota'
    ];

    // Definir relaciones con otros modelos si es necesario
}
