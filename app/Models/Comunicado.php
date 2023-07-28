<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    use HasFactory;
    protected $table = 'comunicados';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'titulo', 'texto_vista_previa', 'descripcion', 'fecha', 'archivo_pdf'
    ];

    // Definir relaciones con otros modelos si es necesario
}
