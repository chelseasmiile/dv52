<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Admin; // Asegúrate de importar el modelo Admin

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Personaliza el método para obtener el campo de inicio de sesión
    public function username()
    {
        return 'correo_electronico'; // Campo en la tabla administradores para el inicio de sesión
    }
}