<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAuth extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'password'];

    // Define la tabla correspondiente
    protected $table = 'users';

    // Resto de tus relaciones, métodos, etc.
}
