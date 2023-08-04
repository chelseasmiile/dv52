<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Comunicado;

class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $comunicados = Comunicado::all(); // Obtén todos los comunicados desde la base de datos
    
    return view('comunicados.index', compact('comunicados')); // Pasa los comunicados a la vista
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comunicados.create');
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
        'archivo_pdf' => 'required|mimes:pdf', // Solo permite archivos PDF
    ]);

    $archivoPdf = $request->file('archivo_pdf');
    $rutaArchivo = $archivoPdf->store('archivos_pdf', 'public'); // Almacenar en storage/app/public/archivos_pdf

    $comunicado = new Comunicado($data);
    $comunicado->archivo_pdf = $rutaArchivo;
    $comunicado->save();

    return redirect()->route('comunicados.index')->with('success', 'Comunicado creado exitosamente.');
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

    public function download($id)
{
    $comunicado = Comunicado::findOrFail($id);
    
    return response()->download(storage_path('app/public/' . $comunicado->archivo_pdf));
}

}
