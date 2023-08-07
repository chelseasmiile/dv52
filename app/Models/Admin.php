<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'administradores';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nombre', 'email', 'password'
    ];

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password; // Cambia esto al campo correcto de contraseña
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getAuthIdentifierName()
    {
        return 'id'; // Cambia esto al nombre del campo que identifica al usuario
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Cambia esto al nombre del campo de token de recordar
    }

}