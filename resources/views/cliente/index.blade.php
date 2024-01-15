@extends('plantilla_cliente.plantilla')
@section('content_btn_ingresar')
    @php
        $cliente=Session::get('cliente');
        if (isset($cliente)) {
            $id = $cliente->getClienteByEmail($cliente->email);
        }
    @endphp
    @if (!isset($id))
        <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
    @else 
        <form action="{{ route('cliente.index') }}" method="GET">
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
    <div id="DestacadoPrincipal">
        <ul>
            <li><img src="{{ asset('images/Slider1.jpg') }}" alt=""></li>
            <li><img src="{{ asset('images/Slider2.jpg') }}" alt=""></li>
            <li><img src="{{ asset('images/Slider3.jpg') }}" alt=""></li>
            <li><img src="{{ asset('images/Slider4.jpg') }}" alt=""></li>
        </ul>
    </div>
    <h1>PRODUCTOS DESTACADOS</h1>
    <section id="seccion_productos"></section>
    <script src="{{ asset('js/script_querys.js') }}"></script>
    <script src="{{ asset('js/script_InteracciónPrincipal.js') }}"></script>
@endsection
