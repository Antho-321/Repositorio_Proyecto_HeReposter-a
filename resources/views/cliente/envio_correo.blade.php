@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}" id="estilo">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_envio_correo_registro.css') }}">
@endsection
@section('navegacion')
<ul class="rd-navbar-nav">
    <li class="rd-nav-item active">
        <a class="rd-nav-link" href="{{ route('cliente.index') }}"><b>Inicio</b></a>
    </li>
    <li class="rd-nav-item">
        <a class="rd-nav-link" href="{{ route('cliente.sobre_nosotros') }}"><b>Sobre nosotros</b></a>
    </li>
    <li class="rd-nav-item">
        <div class="dropdown">
            <a class="rd-nav-link" href="typography.html"><b>Catalogo</b></a>
            <form class="dropdown-content" id="Menu_Catalogo" action="{{ route('cliente.categoria_seleccionada') }}" method="GET">
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
        <a class="rd-nav-link" href="{{ route('cliente.pasteles_personalizados') }}"><b>Pasteles personalizados</b></a>
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
                <button class="boton" id="Salida">Salir</button>
            </form>
            @else
            <input type="button" value="Ingresar" id="Ingreso">
            @endif
        </a>
    </li>
</ul>
@endsection
@section('content_envio_correo')
<input type="hidden" name="pasteles" value="{{ json_encode(Session::get('pasteles')) }}" id="pasteles">
<div id="Salto">
    <div class="modal-backdrop"></div>
    <div id="VentanaForm">
        <form action="{{ route('cliente.create') }}" method="PUT">
            @csrf
            <div id="Ventana" class="Recuperación">
                <div class="btnHaciaDerecha">
                    <input type="button" value="" id="btn_salir">
                </div>
                <h2 id="titulo">{{ucfirst(Session::get('tipo_ingreso_aux'))}}</h2>
                <label id="texto_info" for="correo">Ingrese el código enviado a su correo electrónico. Por favor revise la
                    carpeta de correo no deseado si no lo encuentra.</label>
                @if (Session::has('codigo_correcto'))
                    @if (Session::get('codigo_correcto') == false)
                        <label id="texto_info" for="correo" style="color: red;">Código incorrecto, por favor ingresa el
                            código correcto</label>
                    @endif
                @endif
                <input type="number" id="código" name="random" class="entrada_texto">
                @if (Session::get('tipo_ingreso_aux')=="ingresar")
                    <button class="boton" id="finalización_registro">Ingresar</button>
                @else
                    <button class="boton" id="finalización_registro">Finalizar registro</button>
                @endif
                <div></div>
            </div>

        </form>
    </div>
</div>
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
    <section id="seccion_productos"></section>
    <script type="module" src="{{ asset('js/script_querys.js') }}"></script>
</div>
@endsection
