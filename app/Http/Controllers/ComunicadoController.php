<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Comunicado;

class ComunicadoController extends Controller
{
    public function index(Request $request)
{
    $orden = $request->input('orden', 'asc'); // Obtén el valor de 'orden' del request, o 'asc' por defecto
    $comunicados = Comunicado::orderBy('created_at', $orden)->get();

    return view('comunicados.index', compact('comunicados', 'orden'));
}

    public function create()
    {
        return view('comunicados.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'texto_vista_previa' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'archivo_pdf' => 'required|mimes:pdf',
            'imagen_comunicados' => 'required|image',
        ]);
    
        if ($request->hasFile('imagen_comunicados')) {
            $imagenComunicados = $request->file('imagen_comunicados');
            $rutaImagen = $imagenComunicados->store('imagenes_comunicados', 'public');
            $data['imagen_comunicados'] = $rutaImagen;
        }
    
        $archivoPdf = $request->file('archivo_pdf');
        $rutaArchivo = $archivoPdf->store('archivos_pdf_comunicados', 'public'); // Cambio en la ruta
        
        $comunicado = new Comunicado($data);
        $comunicado->archivo_pdf = $rutaArchivo;
        $comunicado->save();
    
        return redirect()->route('comunicados.index')->with('success', 'Comunicado creado exitosamente.');
    }
    

   

public function edit($id)
{
    $comunicado = Comunicado::findOrFail($id);
    return view('comunicados.edit', compact('comunicado'));
}


    public function download($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        return response()->download(storage_path('app/public/' . $comunicado->archivo_pdf));
    }


    public function update(Request $request, string $id)
    {
        try {
            $comunicado = Comunicado::findOrFail($id);
    
            $data = $request->validate([
                'titulo' => 'required',
                'texto_vista_previa' => 'required',
                'descripcion' => 'required',
                'fecha' => 'required|date',
                'imagen_comunicados' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'archivo_pdf' => 'nullable|mimes:pdf',
            ]);
    
            if ($request->hasFile('imagen_comunicados')) {
                $imagen = $request->file('imagen_comunicados');
                $rutaImagen = $imagen->store('imagenes_comunicados', 'public');
                $comunicado->imagen_comunicados = $rutaImagen;
            }
        
            if ($request->hasFile('archivo_pdf')) {
                $archivoPdf = $request->file('archivo_pdf');
                $rutaArchivo = $archivoPdf->store('archivos_pdf_comunicados', 'public');
                $comunicado->archivo_pdf = $rutaArchivo;
            }
        
            $comunicado->titulo = $data['titulo'];
            $comunicado->texto_vista_previa = $data['texto_vista_previa'];
            $comunicado->descripcion = $data['descripcion'];
            $comunicado->fecha = $data['fecha'];
        
            $comunicado->save();
        
            return redirect()->route('comunicados.index')->with('success', 'Comunicado actualizado exitosamente.');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    

    
    public function show($id)
{
    $comunicado = Comunicado::findOrFail($id);
    
    return response()->download(storage_path('app/public/' . $comunicado->archivo_pdf));
}

public function destroy($id)
{
    $comunicado = Comunicado::findOrFail($id);
    $comunicado->delete();
    return redirect()->route('comunicados.index')->with('success', 'Comunicado eliminado exitosamente.');
}
}
