<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministradorController extends Controller
{
    /**
     * Tabla Clientes
     * Visualizar Clientes
     */
    public function indexCliente()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Cliente
     */
    public function createCliente(Request $request)
    {
        try {
            $sql = DB::insert("insert into clientes (cedula, nombre_cliente, telefono, direccion_domicilio, email, clave)
        values (?,?,?,?,?,?)", [
                $request->txtCedula,
                $request->txtNombre,
                $request->txtTelefono,
                $request->txtDireccion,
                $request->txtCorreo,
                $request->txtPassword,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Cliente registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Clientes
     */
    public function updateCliente(Request $request)
    {
        try {
            $sql = DB::update("update clientes set cedula=? , nombre_cliente=? , telefono=? , direccion_domicilio=? , email=?, clave=? where cliente_id=?", [
                $request->txtCedula,
                $request->txtNombre,
                $request->txtTelefono,
                $request->txtDireccion,
                $request->txtCorreo,
                $request->txtPassword,
                $request->txtCodigo,

            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Cliente modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR CLIENTE");
        }
    }

    /**
     * Eliminar Cliente 
     */
    public function deleteCliente($id)
    {
        try {
            $sql = DB::delete("delete from clientes where cliente_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el cliente");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR CLIENTE");
        }
    }

    /**
     * Tabla Categoria
     * Visualizar Categoria
     */
    public function indexCategoria()
    {
        $datos = DB::select("select * from categoria");
        return view("/administrador/categoria")->with("datos", $datos);
    }

    /**
     * Ingresar Categoria
     */
    public function createCategoria(Request $request)
    {
        try {
            $sql = DB::insert("insert into categoria (categoria_descripcion)
        values (?)", [
                $request->txtCategoriaDescripcion,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Categoria registrada");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Categoria
     */
    public function updateCategoria(Request $request)
    {
        try {
            $sql = DB::update("update categoria set categoria_descripcion=? where categoria_id=?", [
                $request->txtCategoriaId,
                $request->txtCategoriaDescripcion,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Categoria modificada");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR CATEGORIA");
        }
    }

    /**
     * Eliminar Categoria
     */
    public function deleteCategoria($id)
    {
        try {
            $sql = DB::delete("delete from categoria where categoria_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado la categoria");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR CATEGORIA");
        }
    }

    /**
     * Tabla Cobertura
     * Visualizar Cobertura
     */
    public function indexCobertura()
    {
        $datos = DB::select("select * from cobertura");
        return view("/administrador/cobertura")->with("datos", $datos);
    }

    /**
     * Ingresar Cobertura
     */
    public function createCobertura(Request $request)
    {
        try {
            $sql = DB::insert("insert into cobertura (cobertura_descripcion, cobertura_precio_base_volumen)
        values (?,?)", [
                $request->txtCoberturaDescripcion,
                $request->txtCoberturaPrecio,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Cobertura registrada");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Cobertura
     */
    public function updateCobertura(Request $request)
    {
        try {
            $sql = DB::update("update cobertura set cobertura_descripcion=? , cobertura_precio_base_volumen=? where cobertura_id=?", [
                $request->txtCoberturaId,
                $request->txtCoberturaDescripcion,
                $request->txtCoberturaPrecio,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Cobertura modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR COBERTURA");
        }
    }

    /**
     * Eliminar Cobertura
     */
    public function deleteCobertura($id)
    {
        try {
            $sql = DB::delete("delete from cobertura where cobertura_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado la cobertura");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR COBERTURA");
        }
    }

    /**
     * Tabla ComprobanteVenta
     * Visualizar ComprobanteVenta
     */
    public function indexComprobanteVenta()
    {
        $datos = DB::select("select * from comprobante_venta");
        return view("/administrador/comprobante_venta")->with("datos", $datos);
    }

    /**
     * Ingresar ComprobanteVenta
     */
    public function createComprobanteVenta(Request $request)
    {
        try {
            $sql = DB::insert("insert into comprobante_venta (pedido_id, lugar, fecha, cantidad, concepto, cedula_vendedor)
        values (?,?,?,?,?,?)", [
                $request->txtPedidoId,
                $request->txtLugar,
                $request->txtFecha,
                $request->txtCantidad,
                $request->txtContexto,
                $request->txtCedulaV,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Comrobante registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar ComprobanteVenta
     */
    public function updateComprobanteVenta(Request $request)
    {
        try {
            $sql = DB::update("update comprobante_venta set pedido_id=?, lugar=?, fecha=?, cantidad=?, concepto=?, cedula_vendedor=? where comprobante_id=?", [
                $request->txtComrobanteId,
                $request->txtPedidoId,
                $request->txtLugar,
                $request->txtFecha,
                $request->txtCantidad,
                $request->txtContexto,
                $request->txtCedulaV,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Comprobante modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR COMPROBANTE");
        }
    }

    /**
     * Eliminar ComprobanteVenta
     */
    public function deleteComprobanteVenta($id)
    {
        try {
            $sql = DB::delete("delete from comprobante_venta where comprobante_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el comprobante");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR COMPROBANTE");
        }
    }

    /**
     * Tabla DetallePedido
     * Visualizar DetallePedido
     */
    public function indexDetallePedido()
    {
        $datos = DB::select("select * from detalles_pedido");
        return view("/administrador/detalle_pedido")->with("datos", $datos);
    }

    /**
     * Ingresar DetallePedido
     */
    public function createDetallePedido(Request $request)
    {
        try {
            $sql = DB::insert("insert into detalles_pedido (pedido_id, id_varios, pastel_id, cantidad_pastel, cantidad_varios, dedicatoria, especificacion_adicional)
        values (?,?,?,?,?,?,?)", [
                $request->txtPedidoId,
                $request->txtVariosId,
                $request->txtPastelId,
                $request->txtCantidadPastel,
                $request->txtCantidadVarios,
                $request->txtDedicatoria,
                $request->txtEspecificacionAdicional,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Detalles del pastel registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar DetallePedido
     */
    public function updateDetallePedido(Request $request)
    {
        try {
            $sql = DB::update("update detalles_pedido set pedido_id=?, id_varios=?, pastel_id=?, cantidad_pastel=?, cantidad_varios=?, dedicatoria=?, especificacion_adicional=? where detalle_id=?", [
                $request->txtDetalleId,
                $request->txtPedidoId,
                $request->txtVariosId,
                $request->txtPastelId,
                $request->txtCantidadPastel,
                $request->txtCantidadVarios,
                $request->txtDedicatoria,
                $request->txtEspecificacionAdicional,

            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Detalles del pastel modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR DETALLES");
        }
    }

    /**
     * Eliminar DetallePedido
     */
    public function deleteDetallePedido($id)
    {
        try {
            $sql = DB::delete("delete from detalles_pedido where detalle_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el detalle del pastel");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR DETALLES");
        }
    }

    /**
     * Tabla Formas
     * Visualizar Formas
     */
    public function indexFormas()
    {
        $datos = DB::select("select * from formas");
        return view("/administrador/formas")->with("datos", $datos);
    }

    /**
     * Ingresar Formas
     */
    public function createFormas(Request $request)
    {
        try {
            $sql = DB::insert("insert into formas (formas_descripcion)
        values (?)", [
                $request->txtDescripcion,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Forma registrada");
        } else {
            return back()->with("incorrecto", "ERROR AL Forma");
        }
    }

    /**
     * Actualizar Formas
     */
    public function updateFormas(Request $request)
    {
        try {
            $sql = DB::update("update formas set formas_descripcion=? where formas_id=?", [
                $request->txtFormasId,
                $request->txtDescripcion,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Forma modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR FORMA");
        }
    }

    /**
     * Eliminar Formas
     */
    public function deleteFormas($id)
    {
        try {
            $sql = DB::delete("delete from formas where formas_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado la forma");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR FORMA");
        }
    }

    /**
     * Tabla Pastel
     * Visualizar Pastel
     */
    public function indexPastel()
    {
        $datos = DB::select("select * from pastel");
        return view("/administrador/pastel")->with("datos", $datos);
    }

    /**
     * Ingresar Pastel
     */
    public function createPastel(Request $request)
    {
        try {
            $sql = DB::insert("insert into pastel (tamanos_formas_id, tipo_id, relleno_id, cobertura_id, sabores_id, precio, img, categoria_id)
        values (?,?,?,?,?,?,?,?)", [
                $request->txtTamanosFormasId,
                $request->txtTipoId,
                $request->txtRellenoId,
                $request->txtCoberturaId,
                $request->txtSaboresId,
                $request->txtPrecio,
                $request->txtImg,
                $request->txtCategoriaId,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Pastel registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Pastel
     */
    public function updatePastel(Request $request)
    {
        try {
            $sql = DB::update("update pastel set tamanos_formas_id=?, tipo_id=?, relleno_id=?, cobertura_id=?, sabores_id=?, precio=?, img=?, categoria_id=? where pastel_id=?", [
                $request->txtPastelId,
                $request->txtTamanosFormasId,
                $request->txtTipoId,
                $request->txtRellenoId,
                $request->txtCoberturaId,
                $request->txtSaboresId,
                $request->txtPrecio,
                $request->txtImg,
                $request->txtCategoriaId,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Pastel modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR PASTEL");
        }
    }

    /**
     * Eliminar Pastel
     */
    public function deletePastel($id)
    {
        try {
            $sql = DB::delete("delete from pastel where pastel_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el pastel");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR PASTEL");
        }
    }

    /**
     * Tabla Pedidos
     * Visualizar Pedidos
     */
    public function indexPedidos()
    {
        $datos = DB::select("select * from pedido");
        return view("/administrador/pedidos")->with("datos", $datos);
    }

    /**
     * Ingresar Pedidos
     */
    public function createPedidos(Request $request)
    {
        try {
            $sql = DB::insert("insert into pedido (cliente_id, fecha_pedido, fecha_entrega, hora_entrega, pedido_confirmado)
        values (?,?,?,?,?)", [
                $request->txtClienteId,
                $request->txtFechaPedido,
                $request->txtFechaEntrega,
                $request->txtHoraEntrega,
                $request->txtPedidoConfirmado,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Pedido registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Pedidos
     */
    public function updatePedidos(Request $request)
    {
        try {
            $sql = DB::update("update pedido set cliente_id=?, fecha_pedido=?, fecha_entrega=?, hora_entrega=?, pedido_confirmado=? where pedido_id=?", [
                $request->txtPedidoId,
                $request->txtClienteId,
                $request->txtFechaPedido,
                $request->txtFechaEntrega,
                $request->txtHoraEntrega,
                $request->txtPedidoConfirmado,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Pedido modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR PEDIDO");
        }
    }

    /**
     * Eliminar Pedidos
     */
    public function deletePedidos($id)
    {
        try {
            $sql = DB::delete("delete from pedido where pedido_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el pedido");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR PEDIDO");
        }
    }

    /**
     * Tabla Rellenos
     * Visualizar Rellenos
     */
    public function indexRellenos()
    {
        $datos = DB::select("select * from rellenos");
        return view("/administrador/rellenos")->with("datos", $datos);
    }

    /**
     * Ingresar Rellenos
     */
    public function createRellenos(Request $request)
    {
        try {
            $sql = DB::insert("insert into rellenos (relleno_descripcion, relleno_altura, relleno_precio_base_volumen)
        values (?,?,?)", [
                $request->txtRellenoDescripcion,
                $request->txtRellenoAltura,
                $request->txtPrecio,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Relleno registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Rellenos
     */
    public function updateRellenos(Request $request)
    {
        try {
            $sql = DB::update("update rellenos set relleno_descripcion=?, relleno_altura=?, relleno_precio_base_volumen=? where relleno_id=?", [
                $request->txtRellenoId,
                $request->txtRellenoDescripcion,
                $request->txtRellenoAltura,
                $request->txtPrecio,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Relleno modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR Relleno");
        }
    }

    /**
     * Eliminar Rellenos
     */
    public function deleteRellenos($id)
    {
        try {
            $sql = DB::delete("delete from rellenos where rellenos_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el relleno");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR RELLENO");
        }
    }

    /**
     * Tabla Roles
     * Visualizar Roles
     */
    public function indexRoles()
    {
        $datos = DB::select("select * from roles");
        return view("/administrador/roles")->with("datos", $datos);
    }

    /**
     * Ingresar Roles
     */
    public function createRoles(Request $request)
    {
        try {
            $sql = DB::insert("insert into roles (nombre_rol, cedula_usuario)
        values (?,?)", [
                $request->txtNombreRol,
                $request->txtCedulaUsuario,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Rol registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Roles
     */
    public function updateRoles(Request $request)
    {
        try {
            $sql = DB::update("update roles set nombre_rol=?, cedula_usuario=? where id_rol=?", [
                $request->txtIdRol,
                $request->txtNombreRol,
                $request->txtCedulaUsuario,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Rol modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR ROL");
        }
    }

    /**
     * Eliminar Roles
     */
    public function deleteRoles($id)
    {
        try {
            $sql = DB::delete("delete from roles where id_rol=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el rol");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR ROL");
        }
    }

    /**
     * Tabla Sabores
     * Visualizar Sabores
     */
    public function indexSabores()
    {
        $datos = DB::select("select * from sabores");
        return view("/administrador/sabores")->with("datos", $datos);
    }

    /**
     * Ingresar Sabores
     */
    public function createSabores(Request $request)
    {
        try {
            $sql = DB::insert("insert into sabores (sabores_descripcion, sabores_precio_base_volumen)
        values (?,?)", [
                $request->txtSaboresDescripcion,
                $request->txtSaboresPrecio,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Sabor registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Sabores
     */
    public function updateSabores(Request $request)
    {
        try {
            $sql = DB::update("update sabores set sabores_descripcion=?, sabores_precio_base_volumen=? where sabores_id=?", [
                $request->txtSaboresId,
                $request->txtSaboresDescripcion,
                $request->txtSaboresPrecio,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Sabor modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR SABOR");
        }
    }

    /**
     * Eliminar Sabores
     */
    public function deleteSabores($id)
    {
        try {
            $sql = DB::delete("delete from sabores where sabores_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el sabor");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR SABOR");
        }
    }

    /**
     * Tabla Tamano
     * Visualizar Tamano
     */
    public function indexTamano()
    {
        $datos = DB::select("select * from tamano");
        return view("/administrador/tamano")->with("datos", $datos);
    }

    /**
     * Ingresar Tamano
     */
    public function createTamano(Request $request)
    {
        try {
            $sql = DB::insert("insert into tamano (tamano_descripcion)
        values (?)", [
                $request->txtTamanoDescripcion,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Tamaño registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Tamano
     */
    public function updateTamano(Request $request)
    {
        try {
            $sql = DB::update("update tamano set tamano_descripcion=? where tamano_id=?", [
                $request->txtTamanoId,
                $request->txtTamanoDescripcion,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Tamaño modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR TAMAÑO");
        }
    }

    /**
     * Eliminar Tamano
     */
    public function deleteTamano($id)
    {
        try {
            $sql = DB::delete("delete from tamano where tamano_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el tamaño");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR TAMAÑO");
        }
    }

    /**
     * Tabla TamanosFormas
     * Visualizar TamanosFormas
     */
    public function indexTamanosFormas()
    {
        $datos = DB::select("select * from tamanos_formas");
        return view("/administrador/tamanos_formas")->with("datos", $datos);
    }

    /**
     * Ingresar TamanosFormas
     */
    public function createTamanosFormas(Request $request)
    {
        try {
            $sql = DB::insert("insert into tamanos_formas (tamano_id, formas_id, num_porciones, altura, longitud1, longitud2)
        values (?,?,?,?,?,?)", [
                $request->txtTamanoId,
                $request->txtFormasId,
                $request->txtNumPorciones,
                $request->txtAltura,
                $request->txtLongitud1,
                $request->txtLongitud2,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Tamaño, forma registrada");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar TamanosFormas
     */
    public function updateTamanosFormas(Request $request)
    {
        try {
            $sql = DB::update("update tamanos_formas set tamano_id=?, formas_id=?, num_porciones=?, altura=?, longitud1=?, longitud2=? where tamanos_formas_id=?", [
                $request->txtTamanoFormasId,
                $request->txtTamanoId,
                $request->txtFormasId,
                $request->txtNumPorciones,
                $request->txtAltura,
                $request->txtLongitud1,
                $request->txtLongitud2,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Tamaño, forma modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR TAMAÑO, FORMA");
        }
    }

    /**
     * Eliminar TamanosFormas
     */
    public function deleteTamanosFormas($id)
    {
        try {
            $sql = DB::delete("delete from tamanos_formas where tamanos_formas_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el tamaño, forma");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR TAMAÑO, FORMA");
        }
    }

    /**
     * Tabla Tipo
     * Visualizar Tipo
     */
    public function indexTipo()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Tipo
     */
    public function createTipo(Request $request)
    {
        try {
            $sql = DB::insert("insert into tipo (tipo_descripcion, tipo_precio_base_volumen)
        values (?,?)", [
                $request->txtTipoDescripcion,
                $request->txtTipoPrecio,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Tipo registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Tipo
     */
    public function updateTipo(Request $request)
    {
        try {
            $sql = DB::update("update tipo set tipo_descripcion=?, tipo_precio_base_volumen=? where tipo_id=?", [
                $request->txtTipoId,
                $request->txtTipoDescripcion,
                $request->txtTipoPrecio,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Tipo modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR TIPO");
        }
    }

    /**
     * Eliminar Tipo
     */
    public function deleteTipo($id)
    {
        try {
            $sql = DB::delete("delete from tipo where tipo_id=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el tipo");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR TIPO");
        }
    }

    /**
     * Tabla Usuarios
     * Visualizar Usuarios
     */
    public function indexUsuarios()
    {
        $datos = DB::select("select * from usuarios");
        return view("/administrador/usuarios")->with("datos", $datos);
    }

    /**
     * Ingresar Usuarios
     */
    public function createUsuarios(Request $request)
    {
        try {
            $sql = DB::insert("insert into usuarios (cedula_usuario, nombre_usuario, correo, contrasena)
        values (?,?,?,?)", [
                $request->txtCedula,
                $request->txtNombre,
                $request->txtCorreo,
                $request->txtContrasena,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Usuario registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Usuarios
     */
    public function updateUsuarios(Request $request)
    {
        try {
            $sql = DB::update("update usuarios set cedula_usuario=?, nombre_usuario=?, correo=?, contrasena=? where cedula_usuario=?", [
                $request->txtCedula,
                $request->txtNombre,
                $request->txtCorreo,
                $request->txtContrasena,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Usuario modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR USUARIO");
        }
    }

    /**
     * Eliminar Usuarios
     */
    public function deleteUsuarios($id)
    {
        try {
            $sql = DB::delete("delete from usuarios where cedula_usuario=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el usuario");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR USUARIO");
        }
    }

    /** 
     * Tabla Varios
     * Visualizar Varios
     */
    public function indexVarios()
    {
        $datos = DB::select("select * from varios");
        return view("/administrador/varios")->with("datos", $datos);
    }

    /**
     * Ingresar Varios
     */
    public function createVarios(Request $request)
    {
        try {
            $sql = DB::insert("insert into varios (descripcion_varios, precio_varios, img_varios)
        values (?,?,?)", [
                $request->txtVariosDescripcion,
                $request->txtVariosPrecio,
                $request->txtVariosImg,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Producto vario registrado");
        } else {
            return back()->with("incorrecto", "ERROR AL REGISTRAR");
        }
    }

    /**
     * Actualizar Varios
     */
    public function updateVarios(Request $request)
    {
        try {
            $sql = DB::update("update varios set descripcion_varios=?, precio_varios=?, img_varios=? where id_varios=?", [
                $request->txtVariosId,
                $request->txtVariosDescripcion,
                $request->txtVariosPrecio,
                $request->txtVariosImg,
            ]);
            if ($sql == 0) {
                $sql == 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Producto vario modificado");
        } else {
            return back()->with("incorrecto", "ERROR AL MODIFICAR PRODUCTO VARIO");
        }
    }

    /**
     * Eliminar Varios
     */
    public function deleteVarios($id)
    {
        try {
            $sql = DB::delete("delete from varios where id_varios=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Se ha eliminado el producto vario");
        } else {
            return back()->with("incorrecto", "ERROR AL ELIMINAR PRODUCTO VARIO");
        }
    }
}
