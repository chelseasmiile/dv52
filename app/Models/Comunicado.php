<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    use HasFactory;
    
    protected $table = 'comunicados';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'titulo', 'texto_vista_previa', 'descripcion', 'fecha', 'archivo_pdf', 'imagen_comunicados'
    ];

    // Definir relaciones con otros modelos si es necesario
}
