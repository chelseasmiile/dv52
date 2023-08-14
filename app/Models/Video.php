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
        'titulo', 'descripcion', 'youtube_video_id', 'miniatura'
    ];

    // Definir relaciones con otros modelos si es necesario
}
