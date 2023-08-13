<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    
    protected $table = 'notas';
    protected $fillable = [
        'titulo', 'texto_vista_previa', 'descripcion', 'fecha', 'imagen_nota'
    ];
    
    // Los timestamps se mantienen habilitados por defecto
}