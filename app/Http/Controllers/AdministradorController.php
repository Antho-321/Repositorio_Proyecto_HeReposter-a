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
            $sql = DB::insert("insert into categoria (categoria_id, categoria_descripcion)
        values (?,?)", [
                $request->txtId,
                $request->txtDescripcion,
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
            $sql = DB::update("update categoria set categoria_id=? , categoria_descripcion=? where categoria_id=?", [
                $request->txtId,
                $request->txtDescripcion,
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
            $sql = DB::insert("insert into cobertura (cobertura_id, cobertura_descripcion, cobertura_precio_base_volumen)
        values (?,?,?)", [
                $request->txtId,
                $request->txtDescripcion,
                $request->txtPrecio,
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
            $sql = DB::update("update cobertura set cobertura_id=? , cobertura_descripcion=? , cobertura_precio_base_volumen=? where cobertura_id=?", [
                $request->txtId,
                $request->txtDescripcion,
                $request->txtPrecio,
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
            $sql = DB::insert("insert into comprobante_venta (comprobante_id, pedido_id, lugar, fecha, cantidad, concepto, cedula_vendedor)
        values (?,?,?,?,?,?,?)", [
                $request->txtId,
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
            $sql = DB::update("update comprobante_venta set comprobante_id=?, pedido_id=?, lugar=?, fecha=?, cantidad=?, concepto=?, cedula_vendedor=? where comprobante_id=?", [
                $request->txtId,
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
            $sql = DB::insert("insert into detalles_pedido (cedula, nombre_cliente, telefono, direccion_domicilio, email, clave)
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
     * Actualizar DetallePedido
     */
    public function updateDetallePedido(Request $request)
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
     * Eliminar DetallePedido
     */
    public function deleteDetallePedido($id)
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
     * Tabla Formas
     * Visualizar Formas
     */
    public function indexFormas()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Formas
     */
    public function createFormas(Request $request)
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
     * Actualizar Formas
     */
    public function updateFormas(Request $request)
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
     * Eliminar Formas
     */
    public function deleteFormas($id)
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
     * Tabla Pastel
     * Visualizar Pastel
     */
    public function indexPastel()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Pastel
     */
    public function createPastel(Request $request)
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
     * Actualizar Pastel
     */
    public function updatePastel(Request $request)
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
     * Eliminar Pastel
     */
    public function deletePastel($id)
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
     * Tabla Pedidos
     * Visualizar Pedidos
     */
    public function indexPedidos()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Pedidos
     */
    public function createPedidos(Request $request)
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
     * Actualizar Pedidos
     */
    public function updatePedidos(Request $request)
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
     * Eliminar Pedidos
     */
    public function deletePedidos($id)
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
     * Tabla Rellenos
     * Visualizar Rellenos
     */
    public function indexRellenos()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Rellenos
     */
    public function createRellenos(Request $request)
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
     * Actualizar Rellenos
     */
    public function updateRellenos(Request $request)
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
     * Eliminar Rellenos
     */
    public function deleteRellenos($id)
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
     * Tabla Roles
     * Visualizar Roles
     */
    public function indexRoles()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Roles
     */
    public function createRoles(Request $request)
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
     * Actualizar Roles
     */
    public function updateRoles(Request $request)
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
     * Eliminar Roles
     */
    public function deleteRoles($id)
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
     * Tabla Sabores
     * Visualizar Sabores
     */
    public function indexSabores()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Sabores
     */
    public function createSabores(Request $request)
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
     * Actualizar Sabores
     */
    public function updateSabores(Request $request)
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
     * Eliminar Sabores
     */
    public function deleteSabores($id)
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
     * Tabla Tamano
     * Visualizar Tamano
     */
    public function indexTamano()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Tamano
     */
    public function createTamano(Request $request)
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
     * Actualizar Tamano
     */
    public function updateTamano(Request $request)
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
     * Eliminar Tamano
     */
    public function deleteTamano($id)
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
     * Tabla TamanosFormas
     * Visualizar TamanosFormas
     */
    public function indexTamanosFormas()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar TamanosFormas
     */
    public function createTamanosFormas(Request $request)
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
     * Actualizar TamanosFormas
     */
    public function updateTamanosFormas(Request $request)
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
     * Eliminar TamanosFormas
     */
    public function deleteTamanosFormas($id)
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
     * Actualizar Tipo
     */
    public function updateTipo(Request $request)
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
     * Eliminar Tipo
     */
    public function deleteTipo($id)
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
     * Tabla Usuarios
     * Visualizar Usuarios
     */
    public function indexUsuarios()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Usuarios
     */
    public function createUsuarios(Request $request)
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
     * Actualizar Usuarios
     */
    public function updateUsuarios(Request $request)
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
     * Eliminar Usuarios
     */
    public function deleteUsuarios($id)
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
     * Tabla Varios
     * Visualizar Varios
     */
    public function indexVarios()
    {
        $datos = DB::select("select * from clientes");
        return view("/administrador/clientes")->with("datos", $datos);
    }

    /**
     * Ingresar Varios
     */
    public function createVarios(Request $request)
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
     * Actualizar Varios
     */
    public function updateVarios(Request $request)
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
     * Eliminar Varios
     */
    public function deleteVarios($id)
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
}
