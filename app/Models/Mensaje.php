<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
    protected $table = 'mensajes';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'Nombre', 'Correo'

    ];

    public static function attributeNames(){
        return ['Nombre'=>'Nombre', 'Correo'=>'Correo'];
    }
}
