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
        //dd('Executing cerrarSesion');
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        $f = Auth::guard('web')->attempt($credentials, $request->filled('remember'));

        if ($f) {
            return redirect()->route('inicio'); // Redirige a la página de inicio después del inicio de sesión exitoso
        } else {
            return redirect()->route('inicio')->with('error', 'No se pudo iniciar sesión.'); // Redirige a la página de inicio con un mensaje de error
        }
    }

    
    public function cerrarSesion(Request $request)
    {
        Auth::logout();
    
        return redirect()->route('inicio'); // Redirige al usuario a la página de inicio después de cerrar sesión
    }




    public function logout(Request $request)
    {
        dd('Logout executed');
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('https://www.eneba.com/?af_id=operagx-desktop');
    }

    public function getAlta()
    {
        //dd('Executing cerrarSesion');
        return view('alta');
    }

    public function postAlta(Request $request)
{
    //dd('Executing cerrarSesion');
    $datos = $request->all();
    // Agrega esta línea para verificar los datos antes de crear el usuario
    //dd($datos);

    User::create([
        'username' => $datos['username'],
        'password' => Hash::make($datos['password']),
    ]);

    return redirect()->route('inicio');
}
}
