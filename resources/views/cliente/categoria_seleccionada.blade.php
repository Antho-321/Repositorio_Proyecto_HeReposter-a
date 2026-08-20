@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    {{-- ?v=filemtime: mismo motivo que en style.css, evita servir el CSS viejo tras un cambio --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}?v={{ filemtime(public_path('css/estilo_Modificación_Index.css')) }}" id="estilo">
@endsection
@section('navegacion')
<style>
    /* La caja del contenido mide 75vh aunque la categoria traiga pocas fotos,
       para que el pie de pagina no suba hasta media pantalla. Lo que sobraba se
       amontonaba entero debajo de las fotos (87 px abajo contra 14 px arriba,
       medido con la ventana a 1366x768): la rejilla quedaba pegada al titulo y
       colgando de el. Ahora #seccion_productos se queda con todo el hueco libre
       que deja el titulo (flex: 1) y centra la rejilla dentro, asi el aire de
       arriba y el de abajo son iguales.
       min-height en vez de height: si una categoria trae mas fotos de las que
       caben en 75vh, la caja crece en vez de meterse debajo del pie. */
    #contenido_principal {
        padding-top: 40px !important;
        min-height: 75vh !important;
        height: auto !important;
        display: flex !important;
        flex-direction: column !important;
    }

    #contenido_principal #seccion_productos {
        flex: 1 1 auto !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
    }

    /* El hueco libre ya se reparte por igual, pero la caja de linea del titulo
       lleva debajo de las letras el sitio de los trazos descendentes (la "y" de
       "Baby Shower"): 0.25em, unos 14 px con el titular a 55 px. Ese espacio no
       se ve, y el ojo lo suma al aire de arriba, asi que la separacion salia de
       56 px arriba contra 44 px abajo. Descontandolo con un margen negativo las
       dos quedan en ~50 px. En em, para que siga cuadrando en los cuatro
       tamanos de titular (40/45/50/55 px). */
    #contenido_principal .titulo-navbar {
        margin-bottom: -0.25em !important;
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
                <a class="rd-nav-link dropdown-trigger" href="#" aria-haspopup="true" aria-expanded="false"><b>Catalogo</b></a>
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
    {{-- titulo-navbar: misma tipografia que "Productos destacados" del index
         (Sanseriffic 349), definida en css/estilo_Modificación_Index.css --}}
    <h1 class="titulo-navbar">{{$array_categoria_pasteles[0]}}</h1>
    <form action="{{ route('cliente.pastel_seleccionado') }}" method="POST" id="seccion_productos">
        @csrf
        <input type="hidden" name="img" id="enlace_pastel">
    </form>
    <script src="{{ asset('js/script_querys.js') }}"></script>
</div>
@endsection
