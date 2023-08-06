<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quienessomos extends Model
{
    use HasFactory;

    protected $table = 'quienessomos';
    protected $fillable = ['vision', 'mision', 'valores', 'imagen_vision', 'imagen_mision', 'imagen_valores'];
}