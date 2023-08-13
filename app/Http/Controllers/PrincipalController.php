<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $sliders = Principal::all();
    
    return view('principal.index', compact('sliders'));
}

    public function create()
    {
        return view('principal.create');
    }

    public function store(Request $request)
    {
        // Validar y almacenar los datos del formulario
        $data = $request->validate([
            'titulo' => 'required',
            'fecha' => 'required|date',
            'texto_vista_previa' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Asegúrate de ajustar las validaciones según tus necesidades
        ]);

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('public/images');
            $data['imagen'] = $imagePath;
        }

        Principal::create($data);

        return redirect()->route('inicio.index')->with('success', 'Slider creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Principal::findOrFail($id);
        return view('inicio.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $data = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            // Agregar más validaciones si es necesario
        ]);

        // Actualizar el slider en la base de datos
        $slider = Principal::findOrFail($id);
        $slider->update($data);

        return redirect()->route('inicio.index')->with('success', 'Slider actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Principal::findOrFail($id);
        $slider->delete();

        return redirect()->route('inicio.index')->with('success', 'Slider eliminado exitosamente.');
    }
}
