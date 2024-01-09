<?php

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

Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/actualizar_seleccionado/{img}', [PastelController::class, 'show'])->where('img', '(http|https)://[A-Za-z0-9\.\-\/]+');
Route::put('/actualizar_seleccionado/{img}', [PastelController::class, 'update'])->name('actualizar_seleccionado');
Route::delete('/eliminar_seleccionado', [PastelController::class, 'destroy'])->name('eliminar_seleccionado');