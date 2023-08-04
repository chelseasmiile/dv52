<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SlidercreateController;
use App\Http\Controllers\QuienessomosController;

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

// Rutas para el inicio de sesión
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



Route::resource('inicio', SlidercreateController::class)->except(['show','destroy']);

Route::get('/', function () {
     return view('principal.index');
 })->name('inicio');

Route::get('comunicados', [ComunicadoController::class, 'index'])->name('comunicados.index');
Route::resource('comunicados', ComunicadoController::class)->except(['show','destroy']);
Route::get('comunicados/{id}/download', [ComunicadoController::class, 'download'])->name('comunicados.download');


// Route::get('Comunicados', function () {
//     return view('comunicados.index');
// })->name('comunicados');

Route::resource('contacto', ContactoController::class)->except(['show','destroy']);

// Route::get('Contacto', function () {
//     return view('contacto.index');
// })->name('contacto');

Route::resource('galerias', GaleriaController::class)->except(['show','destroy']);

// Route::get('Galerias', function () {
//     return view('galerias.index');
// })->name('galerias');

Route::get('Legislacion', function () {
    return view('legislacion.index');
})->name('legislacion');

Route::resource('notas', NotaController::class)->except(['show','destroy']);

// Route::get('Notas', function () {
//     return view('notas.index');
// })->name('notas');

Route::resource('quienessomos', QuienessomosController::class)->except(['show','destroy']);

// Route::get('QuienesSomos', function () {
//     return view('quienessomos.index');
// })->name('quienessomos');

Route::get('Servicios', function () {
    return view('servicios.index');
})->name('servicios');

Route::resource('videos', VideoController::class)->except(['show','destroy']);

// Route::get('Videos', function () {
//     return view('videos.index');
// })->name('videos');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
