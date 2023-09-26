<?php

namespace App\Http\Controllers\Auth;

//librerias extras
use App\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\Throttleslogins;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
//librerias extras

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;




class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/logeo';
    

    // public function __construct(Guard $auth)
    // {
    //     //dd('Executing cerrarSesion');
    //     $this->auth = $auth;
    //     $this->middleware('guest')->except('getLogout');
    // }

    public function getLogeo()
    {
        //dd('Executing cerrarSesion');
        return view('logeo');
    }

    public function postLogeo(Request $request)
{
    try {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        $f = Auth::guard('web')->attempt($credentials, $request->filled('remember'));

        if ($f) {
            return redirect()->route('principal.index'); // Redirige a la página de inicio después del inicio de sesión exitoso
        } else {
            throw new \Exception('Credenciales incorrectas'); // Lanza una excepción personalizada si las credenciales son incorrectas
        }
    } catch (\Exception $e) {
        return view('badlogin');
    }
}
    public function cerrarSesion(Request $request)
    {
        Auth::logout();
    
        return redirect()->route('principal.index'); // Redirige al usuario a la página de inicio después de cerrar sesión
    }




    public function logout(Request $request)
    {
        dd('Logout executed');
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    

    }

    public function getAlta()
    {
       
        //dd('Executing cerrarSesion');
        return view('alta');
    }

    public function postAlta(Request $request)
{
    $datos = $request->all();

    User::create([
        'username' => $datos['username'],
        'email' => $datos['email'], // Agrega el campo "email" aquí
        'password' => Hash::make($datos['password']),
    ]);

    return redirect()->route('principal.index');
}

}
