<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

    protected $table = 'principal';

    protected $fillable = [
        'slider1','imagen_s1',
    ];

    // Definir relaciones con otros modelos si es necesario
}
