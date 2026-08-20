@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    {{-- ?v=filemtime: mismo motivo que en style.css, evita servir el CSS viejo tras un cambio --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}?v={{ filemtime(public_path('css/estilo_Modificación_Index.css')) }}" id="estilo">
@endsection
@section('navegacion')
<style>
    /* ── Reparto vertical de la pagina de categoria ──────────────────────────
       La caja mide 75vh como minimo para que el pie no suba hasta media
       pantalla cuando la categoria trae pocas fotos; con min-height (y no
       height) crece si algun dia trae muchas, en vez de meterse debajo del pie.

       Dentro van tres bloques -titulo, subtitulo y fotos- y detras de cada uno
       un hueco elastico (1fr). Al ser los tres huecos iguales, el subtitulo cae
       justo en medio entre el titulo y las fotos, y las fotos justo en medio
       entre el subtitulo y el pie, sea cual sea el alto de la ventana. Antes el
       sobrante se amontonaba entero al final (87 px abajo contra 14 arriba). */
    #contenido_principal {
        padding-top: 40px !important;
        min-height: 75vh !important;
        height: auto !important;
        display: grid !important;
        /* minmax: el hueco reparte lo que sobra (1fr), pero nunca baja de 14px.
           En una ventana baja no cabe todo en 75vh y los tres huecos se
           quedaban en 2px, con el texto pegado a las fotos; con el minimo la
           caja crece un poco y sigue habiendo aire -y el mismo en los tres. */
        grid-template-rows: auto minmax(14px, 1fr) auto minmax(14px, 1fr) auto minmax(14px, 1fr) !important;
    }

    #contenido_principal > .titulo-navbar {
        grid-row: 1 !important;
    }

    #contenido_principal > #txt_sel_img {
        grid-row: 3 !important;
        text-align: center !important;
    }

    #contenido_principal > #seccion_productos {
        grid-row: 5 !important;
    }

    /* Los huecos de la rejilla son iguales, pero el ojo no mide de caja a caja,
       mide de letra a letra: toda linea de texto lleva reservado por arriba y
       por abajo el sitio de los trazos ascendentes y descendentes, y ese sitio
       esta vacio. Sin recortarlo los huecos se veian 34 / 33 / 22 px.

       Los margenes negativos de aqui abajo lo recortan, para que la caja acabe
       donde acaban las letras. No son a ojo: son lo que mide ese vacio en esta
       misma pagina, con getBoundingClientRect y TextMetrics del navegador,
           titulo    11.7 px por debajo de las letras (a 55px) = .21em
           subtitulo  8.6 px por encima (a 22px)               = .39em
           subtitulo  6.6 px por debajo (a 22px)               = .30em
       Van en em porque el vacio es proporcional al tamaño de letra: asi siguen
       cuadrando con el titular a 40, 45, 50 o 55 px. */
    #contenido_principal > .titulo-navbar {
        margin-bottom: -0.21em !important;
    }

    #contenido_principal > #txt_sel_img {
        margin-top: -0.39em !important;
        margin-bottom: -0.3em !important;
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
                <a class="rd-nav-link dropdown-trigger" href="#" aria-haspopup="true" aria-expanded="false"><b>Catálogo</b></a>
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
         (Sanseriffic 349), definida en css/estilo_Modificación_Index.css.
         El subtitulo va DENTRO del titular y con id="txt_sel_img", calcado del
         index: asi coge de .titulo-navbar p la tipografia y el tracking, y de
         #txt_sel_img (style.css) el tamaño -22px- y la separacion de 40px
         respecto al titulo. Es decir, se ve igual que el "Selecciona uno" de la
         portada sin escribir ni una regla nueva. --}}
    <h1 class="titulo-navbar">{{$array_categoria_pasteles[0]}}</h1>
    {{-- El subtitulo lleva id="txt_sel_img" y la clase del titular: asi sale con
         la misma tipografia, el mismo tracking y el mismo tamaño (22px, de
         #txt_sel_img en style.css) que el "Selecciona uno" de la portada, sin
         escribir ni una regla nueva. Va suelto y no dentro del <h1> como en la
         portada -donde es un <p> metido en el titular, que no es HTML valido-
         porque asi es un bloque mas de la rejilla y puede repartirse el hueco. --}}
    <p id="txt_sel_img" class="titulo-navbar">Selecciona un producto</p>
    <form action="{{ route('cliente.pastel_seleccionado') }}" method="POST" id="seccion_productos">
        @csrf
        <input type="hidden" name="img" id="enlace_pastel">
    </form>
    <script src="{{ asset('js/script_querys.js') }}"></script>
</div>
@endsection
