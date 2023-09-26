<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use App\Rules\YoutubeUrl;
use Illuminate\Support\Facades\Http;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $videos = Video::all();

    foreach ($videos as $video) {
        // $video->thumbnailUrl = $this->getYoutubeThumbnailUrl($video->youtube_video_id);
    }

    return view('videos.index', compact('videos'));
}

// public function getYoutubeThumbnailUrl($videoId)
// {
//         $key = 'TU_API_KEY'; // Reemplaza con tu API Key de YouTube
//         $response = Http::get("https://www.googleapis.com/youtube/v3/videos", [
//             'key' => $key,
//             'part' => 'snippet',
//             'id' => $videoId,
//         ]);

//         $thumbnailUrl = '';

//         if ($response->successful()) {
//             $data = $response->json();
//             if (isset($data['items'][0]['snippet']['thumbnails']['medium']['url'])) {
//                 $thumbnailUrl = $data['items'][0]['snippet']['thumbnails']['medium']['url'];
//             }
//         }

//         return $thumbnailUrl;
//     }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    //dd("Reached the create view"); // Agrega este dd para verificar si llega aquí
    return view('videos.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'titulo' => 'required',
                'youtube_video_id' => ['required', new YoutubeUrl],
                'descripcion' => 'required',
            ]);
    
            // Procesar y almacenar la miniatura
            if ($request->hasFile('miniatura')) {
                $imagePath = $request->file('miniatura')->store('imagenes_miniatura', 'public');
                $data['miniatura'] = $imagePath;
            }
    
            // Extraer el ID del video de la URL completa de YouTube
            $urlParts = parse_url($data['youtube_video_id']);
            if ($urlParts && isset($urlParts['query'])) {
                parse_str($urlParts['query'], $queryParameters);
                if (isset($queryParameters['v'])) {
                    $data['youtube_video_id'] = $queryParameters['v'];
                }
            }
    
            Video::create($data);
    
            return view('videoexitoso');
        } catch (\Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            return redirect()->route('videos.create')->with('error', 'No se pudo crear el video. Verifique que todos los campos sean correctos y vuelva a intentarlo.');
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
    public function edit($id)
{
    $video = Video::findOrFail($id); // Buscar el video por su ID

    return view('videos.edit', compact('video')); // Pasar el video a la vista de edición
}

    
public function update(Request $request, $id)
{
    try {
        // Validación de los datos del formulario
        $request->validate([
            'titulo' => 'required',
            'youtube_video_id' => 'required',
            'miniatura' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Puedes ajustar las reglas según tus necesidades
            'descripcion' => 'required',
        ]);

        // Encuentra el video que deseas actualizar según el ID proporcionado
        $video = Video::findOrFail($id);

        // Actualiza los campos del video con los datos del formulario
        $video->titulo = $request->input('titulo');
        $video->youtube_video_id = $request->input('youtube_video_id');
        $video->descripcion = $request->input('descripcion');

        // Si se cargó una nueva miniatura, guárdala
        if ($request->hasFile('miniatura')) {
            $miniatura = $request->file('miniatura');
            $rutaMiniatura = $miniatura->store('miniaturas', 'public');
            $video->miniatura = $rutaMiniatura;
        }

        // Guarda los cambios en el video
        $video->save();

        return view('videoexitoso');
    } catch (\Exception $e) {
        // Manejar la excepción y devolver un mensaje de error
        return redirect()->route('videos.edit', $id)->with('error', 'No se pudo actualizar el video. Verifique que todos los campos sean correctos y vuelva a intentarlo.');
    }
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $video = Video::findOrFail($id);

    // Eliminar miniatura del almacenamiento si existe
    if ($video->miniatura && Storage::disk('public')->exists($video->miniatura)) {
        Storage::disk('public')->delete($video->miniatura);
    }

    $video->delete();

    return redirect()->route('videos.index')->with('success', 'Video eliminado exitosamente');
}

public function boot()
{
    Validator::extend('youtube_url', function ($attribute, $value, $parameters, $validator) {
        $pattern = '/^(https?:\/\/)?(www\.)?youtu\.?be(?:\.com)?\/?(watch\?v=)?([a-zA-Z0-9_-]{11})$/';
        return preg_match($pattern, $value);
    });
}


}
