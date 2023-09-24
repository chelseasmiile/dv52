<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $orden = $request->input('orden', 'asc'); // Obtener el valor del filtro de orden

    $notas = Nota::orderBy('created_at', $orden)->get(); // Ordenar las notas por fecha

    return view('notas.index', compact('notas', 'orden')); // Pasar las notas y el orden a la vista
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
        try {
            $data = $request->validate([
                'titulo' => 'required',
                'texto_vista_previa' => 'required',
                'descripcion' => 'required',
                'fecha' => 'required|date',
                'imagen_nota' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if ($request->hasFile('imagen_nota')) {
                $imagePath = $request->file('imagen_nota')->store('imagenes_notas', 'public');
                $data['imagen_nota'] = $imagePath;
            }
    
            Nota::create($data);
    
            $ultimaNota = Nota::latest()->first();
    
            return redirect()->route('notas.index')->with('success', 'Nota creada exitosamente.')->with('ultimaNota', $ultimaNota);
        } catch (\Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            return redirect()->route('notas.create')->with('error', 'No se pudo crear la nota. Verifique que todos los campos sean correctos y vuelva a intentarlo.');
        }
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

    $nota = Nota::findOrFail($id);
    return view('notas.edit', compact('nota'));
}

public function update(Request $request, string $id)
{
    try {
        $nota = Nota::findOrFail($id);

        $request->validate([
            'titulo' => 'required',
            'texto_vista_previa' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'imagen_nota' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen_nota')) {
            $imagePath = $request->file('imagen_nota')->store('imagenes_notas', 'public');
            $nota->imagen_nota = $imagePath;
        }

        // Actualizar los campos individualmente
        $nota->titulo = $request->titulo;
        $nota->texto_vista_previa = $request->texto_vista_previa;
        $nota->descripcion = $request->descripcion;
        $nota->fecha = $request->fecha;

        $nota->save();

        return redirect()->route('notas.index')->with('success', 'Nota actualizada exitosamente');
    } catch (\Exception $e) {
        // Manejar la excepción y devolver un mensaje de error
        return redirect()->route('notas.edit', $id)->with('error', 'No se pudo actualizar la nota. Verifique que todos los campos sean correctos y vuelva a intentarlo.');
    }
}


public function destroy(string $id)
{
    $nota = Nota::findOrFail($id); // Obtener la nota a eliminar

    // Puedes hacer algún proceso adicional antes de eliminar la nota si es necesario

    $nota->delete();

    return redirect()->route('notas.index')->with('success', 'Nota eliminada exitosamente');
}

    public function download($id)
{
    $nota = Nota::findOrFail($id);
    
    return response()->download(storage_path('app/public/' . $nota->imagen_nota));
}
}
