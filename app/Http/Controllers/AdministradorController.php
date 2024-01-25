<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function updateCliente(Request $request, string $id)
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
    public function deleteCliente(string $id)
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
