<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Quienessomos;



class QuienessomosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén los registros de la base de datos
        $quienessomosList = Quienessomos::all();
    
        return view('quienessomos.index', compact('quienessomosList'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quienessomos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'vision' => 'required',
        'mision' => 'required',
        'valores' => 'required',
        'imagen_vision' => 'required|image|mimes:jpeg,png,jpg,gif',
        'imagen_mision' => 'required|image|mimes:jpeg,png,jpg,gif',
        'imagen_valores' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);

    $imagenVision = $request->file('imagen_vision')->store('quienessomos_imagenes/vision', 'public');
    $imagenMision = $request->file('imagen_mision')->store('quienessomos_imagenes/mision', 'public');
    $imagenValores = $request->file('imagen_valores')->store('quienessomos_imagenes/valores', 'public');

    $quienessomos = new Quienessomos($data);
    $quienessomos->imagen_vision = $imagenVision;
    $quienessomos->imagen_mision = $imagenMision;
    $quienessomos->imagen_valores = $imagenValores;
    $quienessomos->save();

    return redirect()->route('quienessomos.index')->with('success', 'Información de Quienes Somos creada exitosamente.');
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
        $quienessomos = Quienessomos::findOrFail($id);
        return view('quienessomos.edit', compact('quienessomos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $quienessomos = Quienessomos::findOrFail($id);

    $data = $request->validate([
        'vision' => 'required',
        'mision' => 'required',
        'valores' => 'required',
        'imagen_vision' => 'image|mimes:jpeg,png,jpg,gif',
        'imagen_mision' => 'image|mimes:jpeg,png,jpg,gif',
        'imagen_valores' => 'image|mimes:jpeg,png,jpg,gif',
    ]);

    if ($request->hasFile('imagen_vision')) {
        $imagenVision = $request->file('imagen_vision')->store('quienessomos_imagenes', 'public');
        $data['imagen_vision'] = $imagenVision;
    }

    if ($request->hasFile('imagen_mision')) {
        $imagenMision = $request->file('imagen_mision')->store('quienessomos_imagenes', 'public');
        $data['imagen_mision'] = $imagenMision;
    }

    if ($request->hasFile('imagen_valores')) {
        $imagenValores = $request->file('imagen_valores')->store('quienessomos_imagenes', 'public');
        $data['imagen_valores'] = $imagenValores;
    }

    $quienessomos->update($data);

    return redirect()->route('quienessomos.index')->with('success', 'Información de Quienes Somos actualizada exitosamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quienessomos = Quienessomos::findOrFail($id);
        $quienessomos->delete();

        return redirect()->route('quienessomos.index')->with('success', 'Información de Quienes Somos eliminada exitosamente.');
    }
}



