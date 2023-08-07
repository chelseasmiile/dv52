<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createAdmin(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo_electronico' => 'required|email|unique:administradores',
            'contrasena' => 'required|string|min:8',
        ]);

        // Crear una instancia del modelo Admin y guardar los datos
        $admin = new Admin([
            'nombre' => $request->input('nombre'),
            'correo_electronico' => $request->input('correo_electronico'),
            'contrasena' => bcrypt($request->input('contrasena')),
        ]);

        $admin->save();

        // ... (Otras operaciones si es necesario, como asignar roles)

        return redirect()->route('admin.index')->with('success', 'Administrador creado exitosamente');
    }
}
