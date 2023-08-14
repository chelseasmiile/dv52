<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class YoutubeUrl implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
{
    // Verificar si el valor es una URL válida de YouTube y contiene el ID del video
    // Ejemplo de lógica: (puede que necesites ajustar esto)
   // dd("Validating URL: " . $value); // Agrega este dd para verificar si se ejecuta la validación
    $urlParts = parse_url($value);
    if ($urlParts && isset($urlParts['query'])) {
        parse_str($urlParts['query'], $queryParameters);
        if (isset($queryParameters['v'])) {
            // Aquí podrías agregar más validaciones si lo necesitas
            return true;
        }
    }
    return false;
}

    public function message()
    {
        return 'El campo :attribute debe ser una URL válida de YouTube.';
    }
}