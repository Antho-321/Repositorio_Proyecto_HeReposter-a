
@extends('plantilla_cliente.plantilla')

@section('content_btn_ingresar')
    @php
    
    if (isset($cliente)){
    $id = $cliente->cliente_id;
    }
    Session::put('email_sent', false);
    @endphp

    @if (!isset($id))
    <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
    @else
    <button onclick="Logout()" id="Salida">Salir</button>
    @endif
@endsection
@section('content_envio_correo')
<input type="hidden" name="pasteles" value="{{json_encode($pasteles)}}" id="pasteles">
<form action="{{ route('cliente.ingreso') }}" method="POST" id="Salto">
    @csrf
    
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