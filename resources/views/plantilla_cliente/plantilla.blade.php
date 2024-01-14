<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}" id="estilo">
    @yield('estilo_adicional')
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <title>Pankey</title>
</head>

<body>
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
                    <a href="/index">Inicio</a>
                    <a href="/SobreNosotros">Sobre nosotros</a>
                    <div id="Catalogo">
                        <input class="Btn_Catalogo" type="button" value="Catalogo">
                        <div>
                            <div id="Menu_Catalogo">
                                <input type="button" value="Bodas">
                                <input type="button" value="Bautizos">
                                <input type="button" value="XV años">
                                <input type="button" value="Cumpleaños">
                                <input type="button" value="Baby Shower">
                                <input type="button" value="San Valentin">
                                <input type="button" value="Halloween">
                                <input type="button" value="Navidad">
                            </div>
                        </div>
                    </div>
                    <a href="PastelesPersonalizados.php">Pasteles personalizados</a>
                </section>
                <section id="seccion_iconos">
                    <a href="CarritoDeCompras.php">
                        <img src="{{ asset('images/carro-de-la-carretilla.png') }}" type="button" value="Catalogo">
                    </a>
                    <img onclick="mostrarBúsqueda()" src="{{ asset('images/lupa1.png') }}" type="button"
                        value="Catalogo">
                    <div id="seccion_busqueda">
                        <input type="search" id="búsqueda">
                    </div>
                    @yield('content_btn_ingresar')
                </section>
                <label for="check" class="esconder_menu">
                    &#215
                </label>
            </div>
        </div>
        @yield('content_envio_correo')
        

    </header>
    <div id="contenido_principal">
        @yield('content')

    </div>

    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    </div>
</body>

</html>
