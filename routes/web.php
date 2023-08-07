<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QuienessomosController;
use App\Http\Controllers\PrincipalController;


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

Route::post('register', [RegisterController::class, 'createUser'])->name('register');



Route::resource('principal', PrincipalController::class)->except(['show']);

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('principal.index');
    } else {
        return view('principal.index-user');
    }
})->name('inicio');

// Rutas de autenticación (login, registro, recuperación de contraseña, etc.)
Auth::routes();

// Rutas protegidas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas para administradores
    Route::resource('principal', PrincipalController::class)->except(['show']);
    Route::resource('comunicados', ComunicadoController::class)->except(['show']);
    
    // Otras rutas para administradores...
});


Route::get('comunicados', [ComunicadoController::class, 'index'])->name('comunicados.index');
Route::resource('comunicados', ComunicadoController::class)->except(['show','destroy']);
Route::get('comunicados/{id}/download', [ComunicadoController::class, 'download'])->name('comunicados.download');

Route::resource('contacto', ContactoController::class)->except(['show','destroy']);

Route::resource('galerias', GaleriaController::class)->except(['show','destroy']);

Route::get('Legislacion', function () {
    return view('legislacion.index');
})->name('legislacion');

Route::resource('notas', NotaController::class)->except(['show']);

Route::resource('quienessomos', QuienessomosController::class)->only(['index', 'create', 'store']);

Route::get('Servicios', function () {
    return view('servicios.index');
})->name('servicios');

Route::resource('videos', VideoController::class)->except(['show','destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
