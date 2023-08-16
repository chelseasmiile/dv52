<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\ImagenGaleria;
use Illuminate\Support\Facades\Storage;

class ImagenGaleriaController extends Controller
{
    

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta las reglas de validación según tus necesidades
            'galeriaId' => 'required|exists:galeria,id', // Asegura que el ID de galería exista en la tabla "galerias"
        ]);
    
        // Obtener el ID de la galería desde la solicitud
        $galeriaId = $request->input('galeriaId');
    
        // Obtener la galería
        $galeria = Galeria::findOrFail($galeriaId);
    
        // Procesar y guardar la imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes_galeria_add', 'public');
    
            $imagen = new ImagenGaleria(['imagen' => $imagenPath]);
            $galeria->imagenes()->save($imagen);
    
            return redirect()->route('galerias.show', $galeria)->with('success', 'Imagen agregada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Debe seleccionar una imagen.');
        }
    }



}
