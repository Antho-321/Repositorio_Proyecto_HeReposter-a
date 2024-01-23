@extends('plantilla_cliente.plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}" id="estilo">
@endsection
@section('content_envio_correo')
    <input type="hidden" name="pasteles" value="{{ json_encode(Session::get('pasteles')) }}" id="pasteles">
    <form action="{{ route('cliente.ingreso') }}" method="POST" id="Salto">
        @csrf
        <input type="hidden" name="registro" value="false" id="registro">
    </form>
@endsection
@section('content')
<div id="contenido_principal">
    <div id="DestacadoPrincipal">
        <ul>
            <li><img src="{{ asset('images/Slider1.jpg') }}" alt=""></li>
            <li><img src="{{ asset('images/Slider2.jpg') }}" alt=""></li>
            <li><img src="{{ asset('images/Slider3.jpg') }}" alt=""></li>
            <li><img src="{{ asset('images/Slider4.jpg') }}" alt=""></li>
        </ul>
    </div>
    <h1>PRODUCTOS DESTACADOS</h1>
    <form action="{{ route('cliente.pastel_seleccionado') }}" method="POST" id="seccion_productos">
        @csrf
        <input type="hidden" name="img" id="enlace_pastel">
    </form>
    <script src="{{ asset('js/script_querys.js') }}"></script>
</div>
@endsection
