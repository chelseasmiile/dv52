<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    use HasFactory;
    protected $table = 'archivos';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'archivo_pdf'
    ];

    // Definir relaciones con otros modelos si es necesario
}
