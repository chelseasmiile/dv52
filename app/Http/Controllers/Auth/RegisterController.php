<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\Role;

class RegisterController extends AdminController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    // ...

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User  // Cambia esto al modelo correcto si es diferente
     */
    public function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


    $user->assignRole('administrador'); // Asignar el rol de administrador

    return redirect()->route('login')->with('status', '¡Registro exitoso! Por favor, inicia sesión.');
}


    public function store(Request $request)
{
    // Validar los datos del formulario de registro
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:administradores',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Obtener los datos del formulario
    $data = $request->all();

    // Crear el usuario utilizando el método create()
    $user = Admin::create([
        'nombre' => $data['nombre'],
        'correo_electronico' => $data['email'],
        'contrasena' => Hash::make($data['password']),
    ]);

    // Asignar el rol de administrador
    $user->roles()->attach(Role::where('nombre_del_rol', 'administrador')->first());

    return redirect()->route('principal.index')->with('success', 'Administrador creado exitosamente.');
}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

public function register(Request $request)
{
    // Validar los datos del formulario de registro
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:administradores',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Obtener los datos del formulario
    $data = $request->all();

    // Crear el usuario utilizando el método create()
    $user = Admin::create([
        'nombre' => $data['nombre'],
        'correo_electronico' => $data['email'],
        'contrasena' => Hash::make($data['password']),
    ]);

    // Asignar el rol de administrador
    $user->roles()->attach(Role::where('nombre_del_rol', 'administrador')->first());

    return $user;
}



}
