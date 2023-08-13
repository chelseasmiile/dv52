<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $notas = Nota::all(); // Obtén todas las notas desde la base de datos
    
    return view('notas.index', compact('notas')); // Pasa las notas a la vista
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notas.create');
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
        'imagen_nota' => 'required|image',
    ]);

    if ($request->hasFile('imagen_nota')) {
        $imagePath = $request->file('imagen_nota')->store('imagenes_notas', 'public');
        $data['imagen_nota'] = $imagePath;
    }

    Nota::create($data);

    $ultimaNota = Nota::latest()->first();

    return redirect()->route('notas.index')->with('success', 'Nota creada exitosamente.')->with('ultimaNota', $ultimaNota);
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
    $nota = Nota::findOrFail($id);
    
    return response()->download(storage_path('app/public/' . $nota->imagen_nota));
}
}
