<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal.index');
})->name('inicio');

Route::get('Comunicados', function () {
    return view('comunicados.index');
})->name('comunicados');

Route::get('Contacto', function () {
    return view('contacto.index');
})->name('contacto');

Route::get('Galerias', function () {
    return view('galerias.index');
})->name('galerias');

Route::get('Legislacion', function () {
    return view('legislacion.index');
})->name('legislacion');

Route::get('Notas', function () {
    return view('notas.index');
})->name('notas');

Route::get('QuienesSomos', function () {
    return view('quienessomos.index');
})->name('quienessomos');

Route::get('Servicios', function () {
    return view('servicios.index');
})->name('servicios');

Route::get('Videos', function () {
    return view('videos.index');
})->name('videos');

Route::resource('contacto', ContactoController::class)->except(['show','destroy']);