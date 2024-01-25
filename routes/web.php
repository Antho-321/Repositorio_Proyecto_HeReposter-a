<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PastelController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\VendedorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\administradorController;

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


Route::resource('cliente', ClienteController::class);

Route::get('/cliente.ingreso_carrito/{pastel}', [PedidoController::class,'create'])->name('cliente.ingreso_carrito');
Route::controller(ClienteController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::post('/cliente/ingreso',  'ingreso')->name('cliente.ingreso');
    Route::post('/cliente/pastel_seleccionado', 'pastel_seleccionado')->name('cliente.pastel_seleccionado');
    Route::get('/cliente.sobre_nosotros', 'show')->name('cliente.sobre_nosotros');
    Route::get('/cliente.pasteles_personalizados', 'pasteles_personalizados')->name('cliente.pasteles_personalizados');
    Route::get('/cliente.categoria_seleccionada', 'categoria_seleccionada')->name('cliente.categoria_seleccionada');
    Route::get('/cliente.carrito', 'carrito')->name('cliente.carrito');
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
Route::get('/actualizar_seleccionado', [PastelController::class, 'show'])->name('actualizar_seleccionado_get');
Route::put('/actualizar_seleccionado/{img}', [PastelController::class, 'update'])->name('actualizar_seleccionado_put');
Route::delete('/eliminar_seleccionado', [PastelController::class, 'destroy'])->name('eliminar_seleccionado');


// RUTAS DE KEVIN

Route::get("/vendedor_tbl_cliente",[VendedorController::class,"ver_clientes"])->name("vendedor_tbl_cliente");
Route::post("/vendedor_registrar_cliente",[VendedorController::class,"ingresar_clientes"])->name("vendedor_registrar_cliente");
Route::post("/vendedor_editar_cliente",[VendedorController::class,"editar_clientes"])->name("vendedor_editar_cliente");
Route::get("/vendedor_eliminar_cliente-{id}",[VendedorController::class,"eliminar_clientes"])->name("vendedor_eliminar_cliente");



Route::get("/vendedor_tbl_pedidos",[VendedorController::class,"ver_pedidos"])->name("vendedor_tbl_pedidos");
Route::post("/vendedor_registrar_pedidos",[VendedorController::class,"ingresar_pedidos"])->name("vendedor_registrar_pedidos");
Route::post("/vendedor_editar_pedidos",[VendedorController::class,"editar_pedidos"])->name("vendedor_editar_pedidos");
Route::get("/vendedor_eliminar_pedidos-{id}",[VendedorController::class,"eliminar_pedidos"])->name("vendedor_eliminar_pedidos");


Route::get("/vendedor_tbl_detalles_pedido",[VendedorController::class,"ver_detalles_pedido"])->name("vendedor_tbl_detalles_pedido");
Route::post("/vendedor_registrar_detalles_pedido",[VendedorController::class,"ingresar_detalles_pedido"])->name("vendedor_registrar_detalles_pedido");
Route::post("/vendedor_editar_detalles_pedido",[VendedorController::class,"editar_detalles_pedido"])->name("vendedor_editar_detalles_pedido");
Route::get("/vendedor_eliminar_detalles_pedido-{id}",[VendedorController::class,"eliminar_detalles_pedido"])->name("vendedor_eliminar_detalles_pedido");


Route::get("/auditor_tbl_auditoria",[AuditorController::class,"ver_auditoria"])->name("auditor_tbl_auditoria");
Route::get("/auditor_tbl_clientes",[AuditorController::class,"ver_clientes"])->name("auditor_tbl_clientes");
Route::get("/auditor_tbl_pedido",[AuditorController::class,"ver_pedido"])->name("auditor_tbl_pedido");
Route::get("/auditor_tbl_detalles_pedido",[AuditorController::class,"ver_detalles_pedido"])->name("auditor_tbl_detalles_pedido");
Route::get("/auditor_tbl_comprobante_venta",[AuditorController::class,"ver_comprobante_venta"])->name("auditor_tbl_comprobante_venta");


// Rutas Administrador

Route::get('/clientesAdministrador', [administradorController::class,"ver_clientes"])->name("obtenerclientes");

