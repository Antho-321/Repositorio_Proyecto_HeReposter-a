@extends('plantilla_cliente.plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_ProductoSeleccionado.css') }}" id="estilo">
@endsection
@section('content_btn_ingresar')
    @php
        $cliente = Session::get('cliente');
        if (isset($cliente)) {
            $id = $cliente->getClienteByEmail($cliente->email);
        }
    @endphp
    @if (!isset($id))
        <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
    @else
        <form action="{{ route('cliente.index') }}" method="GET">
            @csrf
            <input type="hidden" name="cerrar_sesion" value="true">
            <button id="Salida">Salir</button>
        </form>
    @endif
@endsection
@section('content_envio_correo')
    <input type="hidden" name="pasteles" value="{{ json_encode(Session::get('pasteles')) }}" id="pasteles">
    <form action="{{ route('cliente.ingreso') }}" method="POST" id="Salto">
        @csrf
        <input type="hidden" name="registro" value="false" id="registro">
    </form>
@endsection
@section('content')
<form id="contenido_principal" action="{{ route('cliente.ingreso_carrito',$pastel) }}" method="GET">
    <div id="DestacadoPrincipal">
        <img src="{{$pastel->img}}" alt="imagenes" name="img">
        <p>${{$pastel->precio}}</p>
        <div id="seccion_cantidad">
            <label for="cantidad" id="label_cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
            <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
            <input type="number" id="cantidad" name="cantidad" value="1" readonly="">
            <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
        </div>
        <div id="seccion_envio">
            <button value="Añadir al carrito">Añadir al carrito</button>
        </div>
    </div>
    <div id="infoDetallada">
        <div>
            <div class="tabla_info">
                <div class="fila">
                    <p class="col" id="texto_dedicatoria">Dedicatoria para el pedido:</p>
                    <div class="col">
                    </div>
                    <div class="col" id="cuadros_dedicatoria">
                        <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" value="">                   
                    </div>
                </div>
            </div>
            <div class="tabla_info">

                <div class="fila">
                    <p class="col">Porciones:</p>
                    <p class="col">{{$pastel->getNumPorcionesPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col">Tipo de pastel:</p>
                    <p class="col">{{$pastel->getTipoPastel()}}</p>
                    <p class="col">Cobertura:</p>
                    <p class="col">{{$pastel->getCoberturaPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col">Sabor:</p>
                    <p class="col">{{$pastel->getSaborPastel()}}</p>
                    <p class="col">Relleno:</p>
                    <p class="col">{{$pastel->getRellenoPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col" id="txtadicional">Especificación adicional:</p>
                    <div class="col" id="adicional">
                        <textarea name="espAdicional" id="espAdicional" placeholder="(Opcional)"></textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection
