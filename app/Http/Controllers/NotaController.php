<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    public function index()
    {
        $notas = Nota::all();
        return view('notas.index', compact('notas'));
    }

    public function create()
    {
        return view('notas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'texto_vista_previa' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'imagen_nota' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imagenNota = $request->file('imagen_nota')->store('notas_imagenes', 'public');

        $nota = new Nota($data);
        $nota->imagen_nota = $imagenNota;
        $nota->save();

        return redirect()->route('notas.index')->with('success', 'Nota creada exitosamente.');
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
    public function destroy($id)
    {
        // Lógica para eliminar la nota
        Nota::destroy($id);
        return redirect()->route('notas.index')->with('success', 'Nota eliminada exitosamente.');
    }
}
