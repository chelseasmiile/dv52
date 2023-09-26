<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('Imagen subida correctamente');
        $usuarios = users::orderBy('name')->get();
        $usr_current = Auth::user();
        return view('users.index')->with('usuarios', $usuarios)
            ->with('usuario', $usr_current);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('Imagen subida correctamente');
        $usr_current = Auth::user();
        return view('users.create')->with('usuario', $usr_current);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    dd('Imagen subida correctamente');
    $datos = $request->all();
    users::create([
        'username' => $datos['username'],
        'password' => Hash::make($datos['password']),
    ]);
    
    // Redirige a la URL de YouTube después de crear el usuario
    return redirect('https://www.youtube.com/watch?v=UWV41yEiGq0');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usua = users::find($id);
        $usr_current = Auth::user();
        return view('users.read')->with('usua', $usua)
            ->with('usuario', $usr_current);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = users::find($id);
        $usr_current = Auth::user();
        return view('users.edit')->with('usu', $usuario)
            ->with('usuario', $usr_current);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $usuario = users::find($id);
        $usuario->update($datos);
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = users::find($id);
        $usuario->delete();
        return redirect('/users');
    }
}
