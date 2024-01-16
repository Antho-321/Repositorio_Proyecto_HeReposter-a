@extends('plantilla_cliente.plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}" id="estilo">
@endsection
@section('content_envio_correo')
    <input type="hidden" name="pasteles" value="{{ json_encode($array_categoria_pasteles[1]) }}" id="pasteles">
    <form action="{{ route('cliente.ingreso') }}" method="POST" id="Salto">
        @csrf
        <input type="hidden" name="registro" value="false" id="registro">
    </form>
@endsection
@section('content')
<div id="contenido_principal">
    <h1>{{$array_categoria_pasteles[0]}}</h1>
    <form action="{{ route('cliente.pastel_seleccionado') }}" method="POST" id="seccion_productos">
        @csrf
        <input type="hidden" name="img" id="enlace_pastel">
    </form>
    <script src="{{ asset('js/script_querys.js') }}"></script>
    <script src="{{ asset('js/script_InteracciónPrincipal.js') }}"></script>
</div>
@endsection
