<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAuth extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'password', 'email'];

    // Define la tabla correspondiente
    protected $table = 'users';

    // Resto de tus relaciones, métodos, etc.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }
}
