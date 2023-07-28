<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'administradores';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'correo_electronico', 'contrasena'
    ];

    // Definir relaciones con otros modelos si es necesario
}