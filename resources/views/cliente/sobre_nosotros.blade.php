@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    {{-- El ?v= no es decorativo: Cloudflare cachea el CSS 4 h y cada edge lo
         hace por su cuenta, así que sin él un cambio de estilo se ve en unos
         sitios y en otros no (mismo patrón que style.css en new_plantilla). --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_SobreNosotros.css') }}?v={{ filemtime(public_path('css/estilo_Modificación_SobreNosotros.css')) }}" id="estilo">
@endsection
@section('content_envio_correo')
    <input type="hidden" name="pasteles" value="{{ json_encode(Session::get('pasteles')) }}" id="pasteles">
    <form action="{{ route('cliente.ingreso') }}" method="POST" id="Salto">
        @csrf
        <input type="hidden" name="registro" value="false" id="registro">
    </form>
@endsection
@section('navegacion')
    <ul class="rd-navbar-nav">
        <li class="rd-nav-item">
            <a class="rd-nav-link" href="{{ route('cliente.index') }}"><b>Inicio</b></a>
        </li>
        <li class="rd-nav-item active">
            <a class="rd-nav-link" href="{{ route('cliente.sobre_nosotros') }}"><b>Sobre nosotros</b></a>
        </li>
        <li class="rd-nav-item">
            <div class="dropdown">
                <a class="rd-nav-link dropdown-trigger" href="#" aria-haspopup="true" aria-expanded="false"><b>Catálogo</b></a>
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
                    <button id="Salida">Salir</button>
                </form>
              @else
                <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
              @endif
                    </a>
        </li>
    </ul>
@endsection
@section('content')
    <div id="contenido_principal">
        <h1>Nuestra historia</h1>
        {{-- Cada párrafo con su imagen, alternando el lado: izquierda, derecha,
             izquierda. La alternancia la da .capitulo--espejo (row-reverse); en
             móvil todos se apilan con la imagen arriba.

             Las fotos van en el mismo cuadro que las del catálogo
             (componentes.cuadro_foto): se ven enteras y el hueco que sobra lo
             rellena esa misma foto ampliada y desenfocada. Antes se recortaban
             para llenar el cuadrado, y a la del horno de leña que es
             apaisada se le comía a uno de los dos panaderos. --}}
        <div id="texto">
            <section class="capitulo">
                @include('componentes.cuadro_foto', [
                    'src' => 'https://rochinae.files.wordpress.com/2016/02/panadero.jpg?w=776',
                    'alt' => 'Una pareja de panaderos sacando el pan del horno de leña',
                    'clase' => 'capitulo__marco',
                    'claseImagen' => 'capitulo__imagen',
                ])
                <p>Genny y Carlos crecieron entre dos oficios: el pan que horneaba su padre y los postres que su madre
                    preparaba por encargo, sin letrero ni marca; bastaba su nombre. Hace más de treinta años, los
                    hermanos decidieron reunir ambos oficios bajo un mismo letrero, <em>Panadería y Pastelería
                    Olivita<b>:</b></em> fue la primera vez que el trabajo de la familia tuvo un nombre propio.</p>
            </section>
            <section class="capitulo capitulo--espejo">
                @include('componentes.cuadro_foto', [
                    'src' => asset('images/Productos/_7.png'),
                    'alt' => 'Pastel de chocolate decorado con grageas de colores y velas',
                    'clase' => 'capitulo__marco',
                    'claseImagen' => 'capitulo__imagen',
                ])
                <p>En un curso de Levapan, Genny conoció a Luis, con quien tiempo después se casó. Poco más tarde, ella
                    y Carlos decidieron seguir caminos distintos, y fue Luis quien compró el horno: esa venta selló la
                    separación. Genny se quedó con la pastelería que había aprendido de su madre, y Luis se quedó a
                    hornear junto a ella.</p>
            </section>
            <section class="capitulo">
                @include('componentes.cuadro_foto', [
                    'src' => asset('images/CupCake.png'),
                    'alt' => 'Cupcake de chocolate coronado con una cereza',
                    'clase' => 'capitulo__marco',
                    'claseImagen' => 'capitulo__imagen',
                ])
                <p>A través de los años, tras un periplo por diversos rincones, nuestra historia se sintetizó en un
                    nombre tan breve como memorable: Pankey. Hoy condensamos nuestra esencia en un único refugio, donde
                    abrimos las puertas a nuestros visitantes mientras llevamos nuestras creaciones directamente hasta
                    la calidez de su hogar.</p>
            </section>
        </div>
    </div>
@endsection
