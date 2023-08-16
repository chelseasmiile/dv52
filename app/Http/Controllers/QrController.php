<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qr; // Importa el modelo Qr
use App\Models\Galeria;

class QrController extends Controller
{
    // Mostrar el formulario de creación
    public function create($galeria)
    {
        $galeria = Galeria::findOrFail($galeria);
        $galerias = Galeria::all(); // Agrega esta línea para definir $galerias
        return view('servicios.create', compact('galerias', 'galeria'));
    }


    // Almacenar un nuevo generador QR
    public function store(Request $request)
    {
        // Validación de la solicitud
        $request->validate([
            'identificador' => 'required',
            'titulo' => 'required',
            'fecha' => 'required|date',
            'descripcion' => 'required',
            'participantes' => 'required',
          
        ]);
        // Obtener el ID de la galería desde la solicitud
         $galeriaId = $request->input('galeria_id');
        
        // Crear un nuevo generador QR
        $qr = new Qr();
        $qr->identificador = $request->input('identificador');
        $qr->titulo = $request->input('titulo');
        $qr->fecha = $request->input('fecha');
        $qr->descripcion = $request->input('descripcion'); // Añadir descripción
        $qr->participantes = $request->input('participantes'); // Añadir participantes
        $qr->galeria_id = $galeriaId; // Asignar el ID de la galería
        
        $qr->save();
        
        return redirect()->route('galerias.index')->with('success', 'Generador QR creado exitosamente.');
    }
    public function index()
{
    $generadoresQR = Qr::all();
    return view('galerias.show', compact('generadoresQR'));
}
    

    
    // Mostrar los detalles de un generador QR específico
    public function show($id)
    {
        $generadorQR = Qr::findOrFail($id);
        return view('qr.show', compact('generadorQR'));
    }
    
    // Mostrar el formulario de edición para un generador QR
    public function edit($id)
    {
        $generadorQR = Qr::findOrFail($id);
        $galerias = Galeria::all(); // Obtener todas las galerías para el select
        return view('qr.edit', compact('generadorQR', 'galerias'));
    }
    
    // Actualizar un generador QR
    public function update(Request $request, $id)
    {
        // Validación de la solicitud
        $request->validate([
            'identificador' => 'required',
            'titulo' => 'required',
            'fecha' => 'required|date',
            'descripcion' => 'required',
            'participantes' => 'required',
        ]);
    
        $generadorQR = Qr::findOrFail($id);
        $generadorQR->identificador = $request->input('identificador');
        $generadorQR->titulo = $request->input('titulo');
        $generadorQR->fecha = $request->input('fecha');
        $generadorQR->descripcion = $request->input('descripcion');
        $generadorQR->participantes = $request->input('participantes');
        // Otros campos...
    
        // Obtener el ID de la galería desde la solicitud
        $galeriaId = $request->input('galeria_id');
        $generadorQR->galeria_id = $galeriaId;
    
        $generadorQR->save();
    
        return redirect()->route('qr.index')->with('success', 'Generador QR actualizado exitosamente.');
    }
    
    // Eliminar un generador QR
    public function destroy($id)
    {
        $generadorQR = Qr::findOrFail($id);
        $generadorQR->delete();
        return redirect()->route('qr.index')->with('success', 'Generador QR eliminado exitosamente.');
    }
}

