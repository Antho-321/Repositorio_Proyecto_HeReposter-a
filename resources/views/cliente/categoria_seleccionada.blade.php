@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}" id="estilo">
@endsection
@section('navegacion')
<style>
    #contenido_principal {
        padding-top: 40px !important;
        height: 75vh !important;
}
h1{
    font-size: 65px;
}
</style>
    <ul class="rd-navbar-nav">
        <li class="rd-nav-item">
            <a class="rd-nav-link" href="{{ route('cliente.index') }}"><b>Inicio</b></a>
        </li>
        <li class="rd-nav-item">
            <a class="rd-nav-link" href="{{ route('cliente.sobre_nosotros') }}"><b>Sobre nosotros</b></a>
        </li>
        <li class="rd-nav-item active">
            <div class="dropdown">
                <a class="rd-nav-link" href="typography.html"><b>Catalogo</b></a>
                <form class="dropdown-content" id="Menu_Catalogo" action="{{ route('cliente.categoria_seleccionada') }}"
                    method="GET">
                    @csrf
                    <input type="hidden" name="categoria_value" id="nombre_categoria">
        <li>
            <button class="categoria" value="Bodas">Bodas</button>
        </li>
        <li>
            <button class="categoria" value="Bautizos">Bautizos</button>
        </li>
        <li>
            <button class="categoria" value="XV años">XV años</button>
        </li>
        <li>
            <button class="categoria" value="Cumpleaños">Cumpleaños</button>
        </li>
        <li>
            <button class="categoria" value="Baby Shower">Baby Shower</button>
        </li>
        <li>
            <button class="categoria" value="San Valentin">San Valentin</button>
        </li>
        <li>
            <button class="categoria" value="Halloween">Halloween</button>
        </li>
        <li>
            <button class="categoria" value="Navidad">Navidad</button>
        </li>
        </form>
        </div>

        </li>
        <li class="rd-nav-item">
            <a class="rd-nav-link" href="contacts.html"><b>Pasteles personalizados</b></a>
        </li>
        <li class="rd-nav-item" style="width: 60px;">
            <a class="rd-nav-link" href="{{ route('cliente.carrito') }}">
                <img src="{{ asset('images/carro-de-la-carretilla.png') }}" alt="" id="carretilla">
            </a>
        </li>
        <li class="rd-nav-item">
            <a class="rd-nav-link" href="#">
                @php
                    $cliente = Session::get('cliente');
                @endphp
                @if (isset($cliente))
                    <form action="{{ route('cliente.index') }}" method="GET">
                        @csrf
                        <input type="hidden" name="cerrar_sesion" value="true">
                        <button id="Salida">Salir</button>
                    </form>
                @else
                    <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
                @endif
            </a>
        </li>
    </ul>
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
</div>
@endsection
