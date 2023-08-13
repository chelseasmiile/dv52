<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

    protected $table = 'principal';

    protected $fillable = [
        'titulo', 'fecha', 'texto_vista_previa', 'imagen'
    ];

    // Definir relaciones con otros modelos si es necesario
}
