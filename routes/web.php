<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AgregarPaqueteClienteController;

use App\Http\Controllers\PagoController;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('role:admin');
    Route::get('/empleado', [EmpleadoController::class, 'index'])->name('empleado.index')->middleware('role:empleado');
});


Route::resource('users', UserController::class)->middleware('auth', 'role:admin');
Route::resource('paquetes', PaqueteController::class)->middleware('auth', 'role:admin');
Route::resource('clientes', ClienteController::class)->middleware('auth', 'role:admin');
Route::resource('agregar_paquete_cliente', AgregarPaqueteClienteController::class)->middleware('auth', 'role:admin');
Route::resource('pagos', PagoController::class)->middleware('auth', 'role:admin');

Route::resource('accesos', AccesoController::class)->middleware('auth', 'role:admin');
Route::get('accesos/fetch-cliente/{cliente}', [AccesoController::class, 'fetchClienteData']);
Route::post('/accesos/buscar-cliente', [AccesoController::class, 'buscarClientePorClaveAcceso'])->name('accesos.buscar-cliente');
Route::post('/accesos', [AccesoController::class, 'store'])->name('accesos.store');
Route::post('/accesos', [AccesoController::class, 'store'])->name('accesos.store');
Route::resource('visitas', VisitaController::class)->middleware('auth', 'role:admin');
// Archivo: routes/web.php

Route::get('/admin/index', [AdminController::class, 'dashboard'])->name('admin.index');
