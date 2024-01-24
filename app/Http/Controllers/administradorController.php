<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class administradorClientes extends Controller
{
    //TABLA CLIENTES
    public function ver_clientes()
    {
        $datos=DB::select("select * from clientes");
        return view("/vendedor/vendedor_tbl_cliente")->with("datos",$datos);
    }

    public function ingresar_cliente(Request $request)
    {
        try {
            $sql=DB::insert("insert into clientes (cedula, nombre_cliente, telefono, direccion_domicilio, email, clave) 
        values (?,?,?,?,?,?)",[
            $request->txtCedula,
            $request->txtNombre,
            $request->txtTelefono,
            $request->txtDireccion,
            $request->txtCorreo,
            $request->txtPassword,
            ]);
        
        } catch (\Throwable $th) {
            $sql=0;
        }
    if ($sql==true){
        return back()->with("correcto","Cliente registrado");
    }else{
        return back()->with("incorrecto","ERROR AL REGISTRAR");
    }
    }

    public function editar_cliente(Request $request)
    {
       
        try {
            $sql=DB::update("update clientes set cedula=? , nombre_cliente=? , telefono=? , direccion_domicilio=? , email=?, clave=? where cliente_id=?",[
            $request->txtCedula,
            $request->txtNombre,
            $request->txtTelefono,
            $request->txtDireccion,
            $request->txtCorreo,
            $request->txtPassword,
            $request->txtCodigo,
            
    ]);
        if ($sql==0){
            $sql==1; 
        }
        } catch (\Throwable $th) {
            $sql=0;
        }

    if ($sql==true){
        return back()->with("correcto","Cliente modificado");
    }else{
        return back()->with("incorrecto","ERROR AL MODIFICAR CLIENTE");
    }
    }


    public function eliminar_cliente($id){
        try {
            $sql=DB::delete("delete from clientes where cliente_id=$id");
        } catch (\Throwable $th) {
            $sql=0;
        }

    if ($sql==true){
        return back()->with("correcto","Se ha eliminado el cliente");
    }else{
        return back()->with("incorrecto","ERROR AL ELIMINAR CLIENTE");
    }
    }


    //TABLA PEDIDOS
    public function ver_pedidos()
    {
        $datos=DB::select("select * from pedido");
        return view("/vendedor/vendedor_tbl_pedidos")->with("datos",$datos);
    }

    public function ingresar_pedidos(Request $request)
    {
        // Verificar si el cliente existe antes de insertar el pedido
        $clienteExistente = DB::table('clientes')->where('cliente_id', $request->idCliente)->exists();
    
        if (!$clienteExistente) {
            return back()->with("incorrecto", "El cliente no existe");
        }
    
        try {
            // Realizar la inserción en la tabla pedido
            DB::table('pedido')->insert([
                'pedido_id' => $request->idPedido,
                'cliente_id' => $request->idCliente,
                'fecha_pedido' => $request->fechaPedido,
                'fecha_entrega' => $request->fechaEntrega,
                'hora_entrega' => $request->horaEntrega,
                'pedido_confirmado' => $request->pedidoConfirmado,
            ]);
    
            return back()->with("correcto", "Pedido registrado");
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver un mensaje de error
            return back()->with("incorrecto", "ERROR AL REGISTRAR: " . $e->getMessage());
        }
    }
    
    

    public function editar_pedidos(Request $request)
    {
       
        try {
            $sql=DB::update("update pedido set cliente_id=? , fecha_pedido=? , fecha_entrega=? , hora_entrega=? , pedido_confirmado=? where pedido_id=?",[
                
                $request->idCliente,
                $request->fechaPedido,
                $request->fechaEntrega,
                $request->horaEntrega,
                $request->pedidoConfirmado,
                $request->idPedido
            
    ]);
    if ($sql==0){
        $sql==1; 
    }
    } catch (\Throwable $th) {
        $sql=0;
    }


    if ($sql==true){
        return back()->with("correcto","PEDIDO modificado");
    }else{
        return back()->with("incorrecto","ERROR AL MODIFICAR PEDIDO");
    }
    }


    public function eliminar_pedidos($id){
        try {
            $sql=DB::delete("delete from pedido where pedido_id=$id");
        } catch (\Throwable $th) {
            $sql=0;
        }

    if ($sql==true){
        return back()->with("correcto","Se ha eliminado el pedido");
    }else{
        return back()->with("incorrecto","ERROR AL ELIMINAR PEDIDO");
    }
    }




    //tabla detalles pedido
    public function ver_detalles_pedido()
    {
        $datos=DB::select("select * from detalles_pedido");
        return view("/vendedor/vendedor_tbl_detalles_pedido")->with("datos",$datos);
    }

    public function ingresar_detalles_pedido(Request $request)
    {
        try {
            $sql=DB::insert("insert into detalles_pedido (pedido_id, tamanos_formas_id, tipo_id, relleno_id, cobertura_id, sabores_id, id_varios, cantidad, precio, img, especificacion_adicional, categoria_id) 
        values (?,?,?,?,?,?,?,?,?,?,?,?)",[
$request->pedido,
$request->tamano,
$request->tipo,
$request->relleno,
$request->cobertura,
$request->sabores,
$request->varios,
$request->cantidad,
$request->precio,
$request->foto,
$request->especificacion,
$request->categoria

            ]);          
        
        } catch (\Throwable $th) {
            $sql=0;
        }
    if ($sql==true){
        return back()->with("correcto","Cliente registrado");
    }else{
        return back()->with("incorrecto","ERROR AL REGISTRAR");
    }
    }

    public function editar_detalles_pedido(Request $request)
    {  
        try {
            $sql=DB::update("update detalles_pedido set pedido_id=?, tamanos_formas_id=?, tipo_id=?, relleno_id=?, cobertura_id=?, sabores_id=?, id_varios=?, cantidad=?, precio=?, img=?, especificacion_adicional=?, categoria_id=? where detalle_id=?",[
                $request->pedido,
                $request->tamano,
                $request->tipo,
                $request->relleno,
                $request->cobertura,
                $request->sabores,
                $request->varios,
                $request->cantidad,
                $request->precio,
                $request->foto,
                $request->especificacion,
                $request->categoria,
                $request->detalle_id
            
    ]);
        if ($sql==0){
            $sql==1; 
        }
        } catch (\Throwable $th) {
            $sql=0;
        }

    if ($sql==true){
        return back()->with("correcto","Detalle modificado");
    }else{
        return back()->with("incorrecto","ERROR AL MODIFICAR DETALLE");
    }
    }


    public function eliminar_detalles_pedido($id){
        try {
            $sql=DB::delete("delete from detalles_pedido where detalle_id=$id");
        } catch (\Throwable $th) {
            $sql=0;
        }

    if ($sql==true){
        return back()->with("correcto","Se ha eliminado el cliente");
    }else{
        return back()->with("incorrecto","ERROR AL ELIMINAR CLIENTE");
    }
    }
}

