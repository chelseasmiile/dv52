<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'titulo', 'vista_previa_video', 'descripcion'
    ];

    // Definir relaciones con otros modelos si es necesario
}
