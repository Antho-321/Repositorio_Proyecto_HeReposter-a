<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PastelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', [ClienteController::class, 'index'])->name('home');
Route::resource('cliente', ClienteController::class);
Route::post('/cliente/ingreso', [ClienteController::class, 'ingreso'])->name('cliente.ingreso');

Route::view('/InicioAdministración','InicioAdministración');
Route::view('/ingreso_producto','ingreso_producto');
Route::get('actualizar_producto',function(){
    $pasteles = DB::select('select * from pastel');
    return view('actualizar_producto',['pasteles'=>$pasteles]);
});
Route::get('eliminar_producto',function(){
    $pasteles = DB::select('select * from pastel');
    return view('eliminar_producto',['pasteles'=>$pasteles]);
});
Route::post('/ingreso_producto',[PastelController::class,'create'])->name('ingreso_producto');
Route::get('/actualizar_seleccionado', [PastelController::class, 'show'])->name('actualizar_seleccionado_get');
Route::put('/actualizar_seleccionado/{img}', [PastelController::class, 'update'])->name('actualizar_seleccionado_put');
Route::delete('/eliminar_seleccionado', [PastelController::class, 'destroy'])->name('eliminar_seleccionado');