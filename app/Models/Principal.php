<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

    protected $table = 'principal';

    protected $fillable = [
        'slider1','slider2','slider3','imagen_s1','imagen_s2','imagen_s3',
    ];

    // Definir relaciones con otros modelos si es necesario
}
