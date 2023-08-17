<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeria;
use Illuminate\Support\Facades\Storage;
use App\Models\ImagenGaleria;


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
        'categoria' => 'required',
        'titulo' => 'required',
        'texto_vista_previa' => 'required',
        'descripcion' => 'required',
        'fecha' => 'required|date',
        'participantes' => 'required',
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
    public function show($id)
    {
        $galeria = Galeria::findOrFail($id);
       // dd($galeria->imagenes); // Verifica si las imágenes están siendo cargadas correctamente
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
            'categoria' => 'required',
        'titulo' => 'required',
        'texto_vista_previa' => 'required',
        'descripcion' => 'required',
        'fecha' => 'required|date',
        'participantes' => 'required',
        'imagen_galeria' => 'required|image',
    
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

    public function addImage(Request $request, $id)
    {
        // Validaciones y procesamiento de la imagen

        $galeria = Galeria::findOrFail($id);

        // Imprimir para depuración
        dd('Iniciando proceso de añadir imagen');

        $imagenPath = $request->file('imagen')->store('imagenes_galeria_add', 'public');

        // Imprimir para depuración
        dd('Imagen subida correctamente');

        $imagen = new ImagenGaleria(['imagen' => $imagenPath]);
        $galeria->imagenes()->save($imagen);

        // Imprimir para depuración
        dd('Imagen guardada en la base de datos');

        return redirect()->route('galerias.show', $galeria)->with('success', 'Imagen agregada exitosamente.');
    }


}
