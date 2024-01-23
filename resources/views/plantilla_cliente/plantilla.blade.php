<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('estilo')
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <title>Pankey</title>
</head>

<body>
    @yield('comprobante_venta')
    <input type="checkbox" id="check2">
    <header id="Cabecera">
        <div id="Contenido_Cabecera">
            <img src="{{ asset('images/LOGO_PANKEY1.png') }}" alt="LOGO_PANKEY" id="LogoPankey">
            <input type="checkbox" id="check">
            <label for="check" class="mostrar_menu">
                &#8801
            </label>
            <div id="botones_iconos">
                <section id="seccion_botones">
                    <a href="/">Inicio</a>
                    <a href="{{ route('cliente.sobre_nosotros') }}">Sobre nosotros</a>
                    <div id="Catalogo">
                        <input class="Btn_Catalogo" type="button" value="Catalogo">
                        <div>
                            <form id="Menu_Catalogo" action="{{ route('cliente.categoria_seleccionada') }}"
                                method="GET">
                                @csrf
                                <input type="hidden" name="categoria_value" id="nombre_categoria">
                                <button class="categoria"value="Bodas">Bodas</button>
                                <button class="categoria"value="Bautizos">Bautizos</button>
                                <button class="categoria"value="XV años">XV años</button>
                                <button class="categoria"value="Cumpleaños">Cumpleaños</button>
                                <button class="categoria"value="Baby Shower">Baby Shower</button>
                                <button class="categoria"value="San Valentin">San Valentin</button>
                                <button class="categoria"value="Halloween">Halloween</button>
                                <button class="categoria"value="Navidad">Navidad</button>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('cliente.pasteles_personalizados') }}">Pasteles personalizados</a>
                </section>
                <section id="seccion_iconos">
                    <a href="{{ route('cliente.carrito') }}">
                        <img src="{{ asset('images/carro-de-la-carretilla.png') }}" type="button" value="Catalogo">
                    </a>
                    <img onclick="mostrarBúsqueda()" src="{{ asset('images/lupa1.png') }}" type="button"
                        value="Catalogo">
                    <div id="seccion_busqueda">
                        <input type="search" id="búsqueda">
                    </div>
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
                </section>
                <label for="check" class="esconder_menu">
                    &#215
                </label>
            </div>
        </div>
        @yield('content_envio_correo')


    </header>

    @yield('content')

    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    </div>
</body>
<script src="{{ asset('js/script_InteracciónPrincipal.js') }}"></script>
</html>
