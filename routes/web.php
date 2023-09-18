<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\QuienessomosController;
use App\Http\Controllers\ImagenGaleriaController;

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

Route::get('/galerias/create', [GaleriaController::class, 'create'])->name('galerias.create');


Route::get('/principal', [PrincipalController::class, 'index'])->name('inicio');
Route::get('/principal/create', [PrincipalController::class, 'create'])->name('principal.create');
Route::get('/principal/{id}/edit', 'PrincipalController@edit')->name('principal.edit');
Route::resource('/', PrincipalController::class)->except(['destroy']);
Route::put('/principal/{id}', [PrincipalController::class, 'update'])->name('principal.update');
Route::get('/principal/{id}/edit', [PrincipalController::class, 'edit'])->name('principal.edit');



// Route::get('/principal', [PrincipalController::class, 'index'])->name('inicio');

// Route::resource('/', PrincipalController::class)->except(['destroy']);

// Route::get('/principal/create', [PrincipalController::class, 'create'])->name('principal.create');

// Route::put('/principal/{id}', [PrincipalController::class, 'update'])->name('principal.update');

// Route::get('/principal/{id}/edit', 'PrincipalController@edit')->name('principal.edit');



// Route::get('/principal', [PrincipalController::class, 'index'])->name('inicio');

    Route::get('logeo', [LoginController::class, 'getLogeo']);
    Route::post('logeo', [LoginController::class, 'postLogeo']);
    Route::get('/cerrar-sesion', [LoginController::class, 'cerrarSesion'])->name('cerrar-sesion');




Route::get('alta', [LoginController::class, 'getAlta']);
Route::post('alta', [LoginController::class, 'postAlta']);
Route::get('/cerrar-sesion', [LoginController::class, 'cerrarSesion'])->name('cerrar-sesion');



// Route::get('/', function () {
//      return view('principal.index');
//  })->name('inicio');

Route::get('comunicados', [ComunicadoController::class, 'index'])->name('comunicados.index');
Route::resource('comunicados', ComunicadoController::class)->except(['show','destroy']);
Route::get('comunicados/{id}/download', [ComunicadoController::class, 'download'])->name('comunicados.download');
Route::get('comunicados/{id}', [ComunicadoController::class, 'show'])->name('comunicados.show');
Route::get('comunicados/create', [ComunicadoController::class, 'create'])->name('comunicados.create');
Route::resource('comunicados', ComunicadoController::class)->except(['show']);
Route::put('comunicados/{id}', [ComunicadoController::class, 'update'])->name('comunicados.update');




Route::resource('notas', NotaController::class);
Route::get('notas/{id}/download', [NotaController::class, 'download'])->name('notas.download');
Route::get('/notas', [NotaController::class, 'index'])->name('notas.index');
Route::put('notas/{id}', [NotaController::class, 'update'])->name('notas.update');
Route::get('/notas/create', [NotaController::class, 'create'])->name('notas.create'); // Agregar esta línea


Route::get('galerias/{galeria}', [GaleriaController::class, 'show'])->name('galerias.show');
Route::get('servicios/create', 'QrController@create')->name('servicios.create');
Route::post('qrs', 'QrController@store')->name('qrs.store');
Route::get('servicios/create', [QrController::class, 'create'])->name('servicios.create');
Route::post('qrs', [QrController::class, 'store'])->name('qrs.store');
Route::get('servicios/create/{galeria}', [QrController::class, 'create'])->name('servicios.create');
Route::get('qrs/create/{galeria}', [QrController::class, 'create'])->name('qrs.create');




// Route::get('Comunicados', function () {
//     return view('comunicados.index');
// })->name('comunicados');

Route::resource('contacto', ContactoController::class)->except(['show','destroy']);

// Route::get('Contacto', function () {
//     return view('contacto.index');
// })->name('contacto');



Route::get('/galerias/create', [GaleriaController::class, 'create'])->name('galerias.create');
Route::get('galerias/{galeria}', [GaleriaController::class, 'show'])->name('galerias.show');
Route::resource('galerias', GaleriaController::class);
Route::get('/galerias/{id}/edit', [GaleriaController::class, 'edit'])->name('galerias.edit');
Route::get('/galerias/update', [GaleriaController::class, 'update'])->name('galerias.update');
Route::delete('/galerias/{id}', [GaleriaController::class, 'destroy'])->name('galerias.destroy');
Route::get('/galerias/{id}/download', [GaleriaController::class, 'download'])->name('galerias.download');



Route::post('/galerias/{galeria}/add-image', [GaleriaController::class, 'addImage'])->name('galerias.addImage');


Route::post('/galerias/{galeriaId}/add-image', [ImagenGaleriaController::class, 'store'])->name('imagenes_galeria.store');




Route::post('/upload-image', 'ImagenGaleriaController@store')->name('upload.image');
Route::post('/upload-image', [ImagenGaleriaController::class, 'store'])->name('upload.image');

// Route::get('Galerias', function () {
//     return view('galerias.index');
// })->name('galerias');

Route::get('Legislacion', function () {
    return view('legislacion.index');
})->name('legislacion');



// Route::get('Notas', function () {
//     return view('notas.index');
// })->name('notas');

Route::resource('quienessomos', QuienessomosController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

// Route::get('QuienesSomos', function () {
//     return view('quienessomos.index');
// })->name('quienessomos');

Route::get('Servicios', function () {
    return view('servicios.index');
})->name('servicios');

Route::resource('videos', VideoController::class);

// Route::get('Videos', function () {
//     return view('videos.index');
// })->name('videos');



// Route::post('/principal/create', [PrincipalController::class, 'create'])->name('principal.create');
// Route::get('/principal', [PrincipalController::class, 'index'])->name('principal.index');
// Route::resource('principal', PrincipalController::class)->except(['show']);
//Route::get('/principal/create', 'PrincipalController@create')->name('principal.create');


Route::post('/sliders/{id}/asignar', 'PrincipalController@asignar')->name('asignar.slider');
Route::get('/principal', 'PrincipalController@index')->name('principal.index');
Route::post('/principal', 'PrincipalController@store')->name('principal.store');
//Route::put('/principal/{id}', 'PrincipalController@update')->name('principal.update');
Route::delete('/principal/{id}', 'PrincipalController@destroy')->name('principal.destroy');
Route::post('/principal/{id}/asignar', 'PrincipalController@asignar')->name('principal.asignar');
Route::get('/principal', [PrincipalController::class, 'index'])->name('principal.index'); // Add this line
Route::post('/principal', [PrincipalController::class, 'store'])->name('principal.store'); // Add this line
Route::delete('/principal/{id}', [PrincipalController::class, 'destroy'])->name('principal.destroy');

Route::get('servicios/create', 'QrController@create')->name('servicios.create');
Route::post('qrs', 'QrController@store')->name('qrs.store');
Route::get('servicios/create', [QrController::class, 'create'])->name('servicios.create');
Route::post('qrs', [QrController::class, 'store'])->name('qrs.store');
Route::get('servicios/create/{galeria}', [QrController::class, 'create'])->name('servicios.create');
Route::get('qrs/create/{galeria}', [QrController::class, 'create'])->name('qrs.create');


