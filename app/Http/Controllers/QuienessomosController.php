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
        // Aquí obtendrías los registros de la base de datos y los pasarías a la vista
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

        $imagenVision = $request->file('imagen_vision')->store('quienessomos_imagenes', 'public');
        $imagenMision = $request->file('imagen_mision')->store('quienessomos_imagenes', 'public');
        $imagenValores = $request->file('imagen_valores')->store('quienessomos_imagenes', 'public');

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
}



