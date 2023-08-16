<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeria;
use Illuminate\Support\Facades\Storage;


class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $galerias = Galeria::all(); // Obtener todas las galerías desde la base de datos
    return view('galerias.index', compact('galerias'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galerias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'titulo' => 'required',
        'texto_vista_previa' => 'required',
        'descripcion' => 'required',
        'fecha' => 'required|date',
        'imagen_galeria' => 'required|image',
    ]);

    if ($request->hasFile('imagen_galeria')) {
        $imagePath = $request->file('imagen_galeria')->store('imagenes_galeria', 'public');
        $data['imagen_galeria'] = $imagePath;
    }

    Galeria::create($data);

    $ultimaGaleria = Galeria::latest()->first();

    return redirect()->route('galerias.index')->with('success', 'Galería creada exitosamente.')->with('ultimaGaleria', $ultimaGaleria);
}

    /**
     * Display the specified resource.
     */
    public function show(Galeria $galeria)
{
    return view('galerias.show', compact('galeria'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $galeria = Galeria::findOrFail($id);
        return view('galerias.edit', compact('galeria'));
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $galeria = Galeria::findOrFail($id);

        $data = $request->validate([
            'titulo' => 'required',
            'texto_vista_previa' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'imagen_galeria' => 'nullable|image', // Puedes hacer que la imagen sea opcional
        ]);

        if ($request->hasFile('imagen_galeria')) {
            // Eliminamos la imagen actual si hay una nueva imagen
            Storage::delete('public/' . $galeria->imagen_galeria);

            $imagePath = $request->file('imagen_galeria')->store('imagenes_galeria', 'public');
            $data['imagen_galeria'] = $imagePath;
        }

        $galeria->update($data);

        return redirect()->route('galerias.index')->with('success', 'Galería actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $galeria = Galeria::findOrFail($id);
        $galeria->delete();
        return redirect()->route('galerias.index')->with('success', 'Galería eliminada exitosamente.');
    }

    public function download($id)
    {
        $galeria = Galeria::findOrFail($id);
        $imagePath = $galeria->imagen_galeria;
    
        return response()->download(storage_path('app/public/' . $imagePath));
    }
}
