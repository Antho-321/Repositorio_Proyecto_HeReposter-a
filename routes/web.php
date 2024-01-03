<?php

use App\Http\Controllers\PastelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngresoProductoController;

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

Route::resource('/pastel', PastelController::class);

Route::post('/ingreso_producto',[PastelController::class,'create'])->name('ingreso_producto');
Route::put('/actualizar_producto',[PastelController::class,'update'])->name('actualizar_producto');
