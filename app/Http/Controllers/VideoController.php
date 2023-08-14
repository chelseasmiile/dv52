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
    // dd("Reached the store method"); // Verifica si llega al método store
    
    $data = $request->validate([
        'titulo' => 'required',
        'youtube_video_id' => ['required', new YoutubeUrl],
        'descripcion' => 'required',
    ]);

    //dd("Validated input data");
    
    // Procesar y almacenar la miniatura
    if ($request->hasFile('miniatura')) {
        //dd("Miniatura file exists");
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

    //dd("Video data processed");

    Video::create($data);

    //dd("Video created");

    return redirect()->route('videos.index')->with('success', 'Video creado exitosamente');
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
