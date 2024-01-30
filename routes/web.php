<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PastelController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\VendedorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministradorController;

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

Route::get('/cliente.ingreso_carrito/{pastel}', [PedidoController::class, 'create'])->name('cliente.ingreso_carrito');
Route::controller(ClienteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/cliente/ingreso',  'ingreso')->name('cliente.ingreso');
    Route::post('/cliente/pastel_seleccionado', 'pastel_seleccionado')->name('cliente.pastel_seleccionado');
    Route::get('/cliente.sobre_nosotros', 'show')->name('cliente.sobre_nosotros');
    Route::get('/cliente.pasteles_personalizados', 'pasteles_personalizados')->name('cliente.pasteles_personalizados');
    Route::get('/cliente.categoria_seleccionada', 'categoria_seleccionada')->name('cliente.categoria_seleccionada');
    Route::get('/cliente.carrito', 'carrito')->name('cliente.carrito');
});

Route::view('/InicioAdministración', 'InicioAdministración');
Route::view('/ingreso_producto', 'ingreso_producto');
Route::get('actualizar_producto', function () {
    $pasteles = DB::select('select * from pastel');
    return view('actualizar_producto', ['pasteles' => $pasteles]);
});
Route::get('eliminar_producto', function () {
    $pasteles = DB::select('select * from pastel');
    return view('eliminar_producto', ['pasteles' => $pasteles]);
});
Route::post('/ingreso_producto', [PastelController::class, 'create'])->name('ingreso_producto');
Route::get('/actualizar_seleccionado', [PastelController::class, 'show'])->name('actualizar_seleccionado_get');
Route::put('/actualizar_seleccionado/{img}', [PastelController::class, 'update'])->name('actualizar_seleccionado_put');
Route::delete('/eliminar_seleccionado', [PastelController::class, 'destroy'])->name('eliminar_seleccionado');


// RUTAS DE KEVIN

Route::get("/vendedor_tbl_cliente", [VendedorController::class, "ver_clientes"])->name("vendedor_tbl_cliente");
Route::post("/vendedor_registrar_cliente", [VendedorController::class, "ingresar_clientes"])->name("vendedor_registrar_cliente");
Route::post("/vendedor_editar_cliente", [VendedorController::class, "editar_clientes"])->name("vendedor_editar_cliente");
Route::get("/vendedor_eliminar_cliente-{id}", [VendedorController::class, "eliminar_clientes"])->name("vendedor_eliminar_cliente");



Route::get("/vendedor_tbl_pedidos", [VendedorController::class, "ver_pedidos"])->name("vendedor_tbl_pedidos");
Route::post("/vendedor_registrar_pedidos", [VendedorController::class, "ingresar_pedidos"])->name("vendedor_registrar_pedidos");
Route::post("/vendedor_editar_pedidos", [VendedorController::class, "editar_pedidos"])->name("vendedor_editar_pedidos");
Route::get("/vendedor_eliminar_pedidos-{id}", [VendedorController::class, "eliminar_pedidos"])->name("vendedor_eliminar_pedidos");


Route::get("/vendedor_tbl_detalles_pedido", [VendedorController::class, "ver_detalles_pedido"])->name("vendedor_tbl_detalles_pedido");
Route::post("/vendedor_registrar_detalles_pedido", [VendedorController::class, "ingresar_detalles_pedido"])->name("vendedor_registrar_detalles_pedido");
Route::post("/vendedor_editar_detalles_pedido", [VendedorController::class, "editar_detalles_pedido"])->name("vendedor_editar_detalles_pedido");
Route::get("/vendedor_eliminar_detalles_pedido-{id}", [VendedorController::class, "eliminar_detalles_pedido"])->name("vendedor_eliminar_detalles_pedido");


Route::get("/auditor_tbl_auditoria",[AuditorController::class,"ver_auditoria"])->name("auditor_tbl_auditoria");
Route::get("/auditor_tbl_clientes",[AuditorController::class,"ver_clientes"])->name("auditor_tbl_clientes");
Route::get("/auditor_tbl_pedido",[AuditorController::class,"ver_pedido"])->name("auditor_tbl_pedido");
Route::get("/auditor_tbl_detalles_pedido",[AuditorController::class,"ver_detalles_pedido"])->name("auditor_tbl_detalles_pedido");
Route::get("/auditor_tbl_comprobante_venta",[AuditorController::class,"ver_comprobante_venta"])->name("auditor_tbl_comprobante_venta");


// Rutas Administrador
//Cliente
Route::get('/AdministradorClientesIndex', [AdministradorController::class, "indexCliente"])->name("AdministradorClientesIndex");
Route::post('/AdministradorClientesIngresar', [AdministradorController::class, "createCliente"])->name("AdministradorClientesIngresar");
Route::post('/AdministradorClientesActualizar', [AdministradorController::class, "updateCliente"])->name("AdministradorClientesActualizar");
Route::get('/AdministradorClientesEliminar-{id}', [AdministradorController::class, "deleteCliente"])->name("AdministradorClientesEliminar");

//Categoria
Route::get('/AdministradorCategoriaIndex', [AdministradorController::class, "indexCategoria"])->name("AdministradorCategoriaIndex");
Route::post('/AdministradorCategoriaIngresar', [AdministradorController::class, "createCategoria"])->name("AdministradorCategoriaIngresar");
Route::post('/AdministradorCategoriaActualizar', [AdministradorController::class, "updateCategoria"])->name("AdministradorCategoriaActualizar");
Route::get('/AdministradorCategoriaEliminar-{id}', [AdministradorController::class, "deleteCategoria"])->name("AdministradorCategoriaEliminar");

//Cobertura
Route::get('/AdministradorCoberturaIndex', [AdministradorController::class, "indexCobertura"])->name("AdministradorCoberturaIndex");
Route::post('/AdministradorCoberturaIngresar', [AdministradorController::class, "createCobertura"])->name("AdministradorCoberturaIngresar");
Route::post('/AdministradorCoberturaActualizar', [AdministradorController::class, "updateCobertura"])->name("AdministradorCoberturaActualizar");
Route::get('/AdministradorCoberturaEliminar-{id}', [AdministradorController::class, "deleteCobertura"])->name("AdministradorCoberturaEliminar");

//Comprobante
Route::get('/AdministradorComprobanteVentaIndex', [AdministradorController::class, "indexComprobanteVenta"])->name("AdministradorComprobanteVentaIndex");
Route::post('/AdministradorComprobanteVentaIngresar', [AdministradorController::class, "createComprobanteVenta"])->name("AdministradorComprobanteVentaIngresar");
Route::post('/AdministradorComprobanteVentaActualizar', [AdministradorController::class, "updateComprobanteVenta"])->name("AdministradorComprobanteVentaActualizar");
Route::get('/AdministradorComprobanteVentaEliminar-{id}', [AdministradorController::class, "deleteComprobanteVenta"])->name("AdministradorComprobanteVentaEliminar");

//Detalle pedido
Route::get('/AdministradorDetallePedidoIndex', [AdministradorController::class, "indexDetallePedido"])->name("AdministradorDetallePedidoIndex");
Route::post('/AdministradorDetallePedidoIngresar', [AdministradorController::class, "createDetallePedido"])->name("AdministradorDetallePedidoIngresar");
Route::post('/AdministradorDetallePedidoActualizar', [AdministradorController::class, "updateDetallePedido"])->name("AdministradorDetallePedidoActualizar");
Route::get('/AdministradorDetallePedidoEliminar-{id}', [AdministradorController::class, "deleteDetallePedido"])->name("AdministradorDetallePedidoEliminar");

//Formas
Route::get('/AdministradorFormasIndex', [AdministradorController::class, "indexFormas"])->name("AdministradorFormasIndex");
Route::post('/AdministradorFormasIngresar', [AdministradorController::class, "createFormas"])->name("AdministradorFormasIngresar");
Route::post('/AdministradorFormasActualizar', [AdministradorController::class, "updateFormas"])->name("AdministradorFormasActualizar");
Route::get('/AdministradorFormasEliminar-{id}', [AdministradorController::class, "deleteFormas"])->name("AdministradorFormasEliminar");

//Pastel
Route::get('/AdministradorPastelIndex', [AdministradorController::class, "indexPastel"])->name("AdministradorPastelIndex");
Route::post('/AdministradorPastelIngresar', [AdministradorController::class, "createPastel"])->name("AdministradorPastelIngresar");
Route::post('/AdministradorPastelActualizar', [AdministradorController::class, "updatePastel"])->name("AdministradorPastelActualizar");
Route::get('/AdministradorPastelEliminar-{id}', [AdministradorController::class, "deletePastel"])->name("AdministradorPastelEliminar");

//Pedidos
Route::get('/AdministradorPedidosIndex', [AdministradorController::class, "indexPedidos"])->name("AdministradorPedidosIndex");
Route::post('/AdministradorPedidosIngresar', [AdministradorController::class, "createPedidos"])->name("AdministradorPedidosIngresar");
Route::post('/AdministradorPedidosActualizar', [AdministradorController::class, "updatePedidos"])->name("AdministradorPedidosActualizar");
Route::get('/AdministradorPedidosEliminar-{id}', [AdministradorController::class, "deletePedidos"])->name("AdministradorPedidosEliminar");

//Rellenos
Route::get('/AdministradorRellenosIndex', [AdministradorController::class, "indexRellenos"])->name("AdministradorRellenosIndex");
Route::post('/AdministradorRellenosIngresar', [AdministradorController::class, "createRellenos"])->name("AdministradorRellenosIngresar");
Route::post('/AdministradorRellenosActualizar', [AdministradorController::class, "updateRellenos"])->name("AdministradorRellenosActualizar");
Route::get('/AdministradorRellenosEliminar-{id}', [AdministradorController::class, "deleteRellenos"])->name("AdministradorRellenosEliminar");

//Roles
Route::get('/AdministradorRolesIndex', [AdministradorController::class, "indexRoles"])->name("AdministradorRolesIndex");
Route::post('/AdministradorRolesIngresar', [AdministradorController::class, "createRoles"])->name("AdministradorRolesIngresar");
Route::post('/AdministradorRolesActualizar', [AdministradorController::class, "updateRoles"])->name("AdministradorRolesActualizar");
Route::get('/AdministradorRolesEliminar-{id}', [AdministradorController::class, "deleteRoles"])->name("AdministradorRolesEliminar");

//Sabores
Route::get('/AdministradorSaboresIndex', [AdministradorController::class, "indexSabores"])->name("AdministradorSaboresIndex");
Route::post('/AdministradorSaboresIngresar', [AdministradorController::class, "createSabores"])->name("AdministradorSaboresIngresar");
Route::post('/AdministradorSaboresActualizar', [AdministradorController::class, "updateSabores"])->name("AdministradorSaboresActualizar");
Route::get('/AdministradorSaboresEliminar-{id}', [AdministradorController::class, "deleteSabores"])->name("AdministradorSaboresEliminar");

//Tamano
Route::get('/AdministradorTamanoIndex', [AdministradorController::class, "indexTamano"])->name("AdministradorTamanoIndex");
Route::post('/AdministradorTamanoIngresar', [AdministradorController::class, "createTamano"])->name("AdministradorTamanoIngresar");
Route::post('/AdministradorTamanoActualizar', [AdministradorController::class, "updateTamano"])->name("AdministradorTamanoActualizar");
Route::get('/AdministradorTamanoEliminar-{id}', [AdministradorController::class, "deleteTamano"])->name("AdministradorTamanoEliminar");

//Tamano Formas
Route::get('/AdministradorTamanosFormasIndex', [AdministradorController::class, "indexTamanosFormas"])->name("AdministradorTamanosFormasIndex");
Route::post('/AdministradorTamanosFormasIngresar', [AdministradorController::class, "createTamanosFormas"])->name("AdministradorTamanosFormasIngresar");
Route::post('/AdministradorTamanosFormasActualizar', [AdministradorController::class, "updateTamanosFormas"])->name("AdministradorTamanosFormasActualizar");
Route::get('/AdministradorTamanosFormasEliminar-{id}', [AdministradorController::class, "deleteTamanosFormas"])->name("AdministradorTamanosFormasEliminar");

//Tipo
Route::get('/AdministradorTipoIndex', [AdministradorController::class, "indexTipo"])->name("AdministradorTipoIndex");
Route::post('/AdministradorTipoIngresar', [AdministradorController::class, "createTipo"])->name("AdministradorTipoIngresar");
Route::post('/AdministradorTipoActualizar', [AdministradorController::class, "updateTipo"])->name("AdministradorTipoActualizar");
Route::get('/AdministradorTipoEliminar-{id}', [AdministradorController::class, "deleteTipo"])->name("AdministradorTipoEliminar");

//Usuarios
Route::get('/AdministradorUsuariosIndex', [AdministradorController::class, "indexUsuarios"])->name("AdministradorUsuariosIndex");
Route::post('/AdministradorUsuariosIngresar', [AdministradorController::class, "createUsuarios"])->name("AdministradorUsuariosIngresar");
Route::post('/AdministradorUsuariosActualizar', [AdministradorController::class, "updateUsuarios"])->name("AdministradorUsuariosActualizar");
Route::get('/AdministradorUsuariosEliminar-{id}', [AdministradorController::class, "deleteUsuarios"])->name("AdministradorUsuariosEliminar");

//Varios
Route::get('/AdministradorVariosIndex', [AdministradorController::class, "indexVarios"])->name("AdministradorVariosIndex");
Route::post('/AdministradorVariosIngresar', [AdministradorController::class, "createVarios"])->name("AdministradorVariosIngresar");
Route::post('/AdministradorVariosActualizar', [AdministradorController::class, "updateVarios"])->name("AdministradorVariosActualizar");
Route::get('/AdministradorVariosEliminar-{id}', [AdministradorController::class, "deleteVarios"])->name("AdministradorVariosEliminar");

