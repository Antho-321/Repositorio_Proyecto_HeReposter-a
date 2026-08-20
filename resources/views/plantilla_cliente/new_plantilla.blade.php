<!DOCTYPE html>
{{-- lang="es": el sitio está en español. No es sólo semántica — el guionado
     automático (hyphens: auto) parte las palabras según el idioma declarado, y
     con "en" el navegador no aplica el diccionario español. También afecta a
     lectores de pantalla y a la corrección ortográfica de los formularios. --}}
<html class="wide wow-animation" lang="es">

<head>
    <title>Inicio</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="current-view" content="{{ Route::currentRouteName() }}">
    <meta name="csrf-token1" content="{{ csrf_token() }}">
    @yield('token_adicional')
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,600,700,900%7CRaleway:500">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    {{-- ?v=filemtime: Cloudflare cachea los assets 4h; el sufijo evita servir CSS viejo tras un cambio --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
    {{-- Después de style.css: la animación de carga reajusta el .preloader del tema --}}
    <link rel="stylesheet"
        href="{{ asset('css/pankey-loader.css') }}?v={{ filemtime(public_path('css/pankey-loader.css')) }}">
    @yield('estilo')
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->

</head>

<body>
    @yield('comprobante_venta')
    @include('plantilla_cliente.preloader')
    <div class="page">

        <!-- Page Header-->
        <header class="section page-header" id="menu">
            <!-- RD Navbar-->
            <div class="rd-navbar-wrap">
                <nav id="navegacion" class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed"
                    data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed"
                    data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
                    data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
                    data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
                    data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="56px"
                    data-xl-stick-up-offset="56px" data-xxl-stick-up-offset="56px" data-lg-stick-up="true"
                    data-xl-stick-up="true" data-xxl-stick-up="true">
                    <div class="rd-navbar-inner-outer">
                        <div class="rd-navbar-inner">
                            <!-- RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!-- RD Navbar Toggle-->
                                <button class="rd-navbar-toggle"
                                    data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                <!-- RD Navbar Brand-->
                                <div class="rd-navbar-brand"><a class="brand" href="index.html">
                                        <img class="brand-logo-dark" src="{{ asset('images/LOGO_PANKEY.png') }}"
                                            alt="" width="80" height="80" style="height: 80px;" /></a>
                                </div>
                            </div>
                            <div class="rd-navbar-right rd-navbar-nav-wrap">
                                <div class="rd-navbar-main">
                                    <!-- RD Navbar Nav-->
                                    @yield('navegacion')
                            </div>
                        </div>

                        <div class="rd-navbar-project">
                            <div class="rd-navbar-project-header">
                                <h5 class="rd-navbar-project-title">Gallery</h5>
                                <div class="rd-navbar-project-hamburger rd-navbar-project-hamburger-close"
                                    data-multitoggle=".rd-navbar-inner" data-multitoggle-blur=".rd-navbar-wrap"
                                    data-multitoggle-isolate="data-multitoggle-isolate">
                                    <div class="project-close"><span></span><span></span></div>
                                </div>
                            </div>
                            <div class="rd-navbar-project-content rd-navbar-content">
                                <div>
                                    <div class="row gutters-20" data-lightgallery="group">
                                        <div class="col-6">
                                            <!-- Thumbnail Creative-->
                                            <article class="thumbnail thumbnail-creative"><a
                                                    href="{{ asset('images/project-1-1200x800-original.jpg') }}"
                                                    data-lightgallery="item">
                                                    <div class="thumbnail-creative-figure">
                                                        <img src="{{ asset('images/project-1-195x164.jpg') }}"
                                                            alt="" width="195" height="164" />
                                                    </div>
                                                    <div class="thumbnail-creative-caption"><span
                                                            class="icon thumbnail-creative-icon linearicons-magnifier"></span>
                                                    </div>
                                                </a></article>
                                        </div>
                                        <div class="col-6">
                                            <!-- Thumbnail Creative-->
                                            <article class="thumbnail thumbnail-creative"><a
                                                    href="{{ asset('images/project-2-1200x800-original.jpg') }}"
                                                    data-lightgallery="item">
                                                    <div class="thumbnail-creative-figure">
                                                        <img src="{{ asset('images/project-2-195x164.jpg') }}"
                                                            alt="" width="195" height="164" />
                                                    </div>
                                                    <div class="thumbnail-creative-caption"><span
                                                            class="icon thumbnail-creative-icon linearicons-magnifier"></span>
                                                    </div>
                                                </a></article>
                                        </div>
                                        <div class="col-6">
                                            <!-- Thumbnail Creative-->
                                            <article class="thumbnail thumbnail-creative"><a
                                                    href="{{ asset('images/project-3-1200x800-original.jpg') }}"
                                                    data-lightgallery="item">
                                                    <div class="thumbnail-creative-figure">
                                                        <img src="{{ asset('images/project-3-195x164.jpg') }}"
                                                            alt="" width="195" height="164" />
                                                    </div>
                                                    <div class="thumbnail-creative-caption"><span
                                                            class="icon thumbnail-creative-icon linearicons-magnifier"></span>
                                                    </div>
                                                </a></article>
                                        </div>
                                        <div class="col-6">
                                            <!-- Thumbnail Creative-->
                                            <article class="thumbnail thumbnail-creative"><a
                                                    href="{{ asset('images/project-4-1200x800-original.jpg') }}"
                                                    data-lightgallery="item">
                                                    <div class="thumbnail-creative-figure">
                                                        <img src="{{ asset('images/project-4-195x164.jpg') }}"
                                                            alt="" width="195" height="164" />
                                                    </div>
                                                    <div class="thumbnail-creative-caption"><span
                                                            class="icon thumbnail-creative-icon linearicons-magnifier"></span>
                                                    </div>
                                                </a></article>
                                        </div>
                                        <div class="col-6">
                                            <!-- Thumbnail Creative-->
                                            <article class="thumbnail thumbnail-creative"><a
                                                    href="{{ asset('images/project-5-1200x800-original.jpg') }}"
                                                    data-lightgallery="item">
                                                    <div class="thumbnail-creative-figure">
                                                        <img src="{{ asset('images/project-5-195x164.jpg') }}"
                                                            alt="" width="195" height="164" />
                                                    </div>
                                                    <div class="thumbnail-creative-caption"><span
                                                            class="icon thumbnail-creative-icon linearicons-magnifier"></span>
                                                    </div>
                                                </a></article>
                                        </div>
                                        <div class="col-6">
                                            <!-- Thumbnail Creative-->
                                            <article class="thumbnail thumbnail-creative"><a
                                                    href="{{ asset('images/project-6-1200x800-original.jpg') }}"
                                                    data-lightgallery="item">
                                                    <div class="thumbnail-creative-figure">
                                                        <img src="{{ asset('images/project-6-195x164.jpg') }}"
                                                            alt="" width="195" height="164" />
                                                    </div>
                                                    <div class="thumbnail-creative-caption"><span
                                                            class="icon thumbnail-creative-icon linearicons-magnifier"></span>
                                                    </div>
                                                </a></article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>

            </nav>

    </div>
    
    </header>
    @yield('content_envio_correo')
    <!-- Swiper-->
    @yield('content')


    <!-- Page Footer-->
    @php
        // Las categorías del pie salen de la tabla `categoria`, el mismo origen
        // que el catálogo, y no de una lista escrita a mano: así el pie no se
        // queda viejo cuando el administrador añade o quita una desde su panel.
        $categorias_pie = \App\Models\Categoria::orderBy('categoria_id')->pluck('categoria_descripcion');
    @endphp
    <footer class="section footer-modern context-dark footer-modern-2">
        <div class="footer-modern-line">
            <div class="container">
                <div class="row row-50">
                    <div class="col-md-6 col-lg-4">
                        <h5 class="footer-modern-title oh-desktop"><span
                                class="d-inline-block wow slideInLeft">Catálogo</span>
                        </h5>
                        <ul class="footer-modern-list d-inline-block d-sm-block wow fadeInUp">
                            @foreach ($categorias_pie as $categoria_pie)
                                {{-- categoria_value: el mismo parámetro que envía el menú de
                                     Catálogo; el controlador lo lee con $request->input(), así
                                     que funciona igual llegando por la barra de direcciones. --}}
                                <li><a
                                        href="{{ route('cliente.categoria_seleccionada', ['categoria_value' => $categoria_pie]) }}">{{ $categoria_pie }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <h5 class="footer-modern-title oh-desktop"><span
                                class="d-inline-block wow slideInLeft">Información</span>
                        </h5>
                        {{-- una-columna: las etiquetas de esta lista son largas y no caben
                             en las dos columnas que el tema le da a .footer-modern-list. --}}
                        <ul class="footer-modern-list footer-modern-list--una-columna d-inline-block d-sm-block wow fadeInUp">
                            <li><a href="{{ route('cliente.index') }}">Inicio</a></li>
                            <li><a href="{{ route('cliente.sobre_nosotros') }}">Sobre nosotros</a></li>
                            <li><a href="{{ route('cliente.pasteles_personalizados') }}">Pasteles personalizados</a></li>
                            <li><a href="{{ route('cliente.carrito') }}">Carrito</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-xl-5">
                        <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">Pedidos y
                                retiro</span>
                        </h5>
                        <p class="wow fadeInRight">Nuestros pedidos se retiran en el local: 24 horas después de hacerlo si lo necesitas pronto, o en la fecha acordada. Si prefieres entrega a domicilio, el costo del transporte no está incluido y se cancela previo a la entrega.</p>
                        <p class="wow fadeInRight">Horario de atención:<br>
                            Lunes a viernes, de 07:30 a 21:30<br>
                            Sábados, de 07:30 a 19:30<br>
                            Domingos, de 07:30 a 10:00</p>
                        {{-- wa.me quiere el numero en formato internacional y sin el 0 inicial:
                             0969496362 -> 593969496362. --}}
                        <p class="wow fadeInRight">¿Dudas con tu pedido? Escríbenos a <a
                                href="mailto:pankey.ibarra@gmail.com">pankey.ibarra@gmail.com</a> o por WhatsApp al <a
                                href="https://wa.me/593969496362" target="_blank" rel="noopener">096 949 6362</a> o al <a
                                href="https://wa.me/593988363503" target="_blank" rel="noopener">098 836 3503</a>.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-modern-line-2">
            <div class="container">
                <div class="row row-30 align-items-center">
                    <div class="col-sm-6 col-md-7 col-lg-4 col-xl-4">
                        <div class="row row-30 align-items-center text-lg-center">
                            <div class="col-md-7 col-xl-6">
                                <a class="brand" href="{{ route('cliente.index') }}">
                                    <img src="{{ asset('images/logo-inverse-198x66.png') }}" alt="Pastelería Pankey"
                                        width="100" height="100" style="height: 100px;" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-12 col-lg-8 col-xl-8 oh-desktop">
                        <div class="group-xmd group-sm-justify">
                            <div class="footer-modern-contacts wow slideInUp">
                                <div class="unit unit-spacing-sm align-items-center">
                                    <div class="unit-left"><span class="icon icon-24 mdi mdi-phone"></span></div>
                                    <div class="unit-body"><a class="phone" href="tel:+593969496362">096 949 6362</a>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-modern-contacts wow slideInDown">
                                <div class="unit unit-spacing-sm align-items-center">
                                    <div class="unit-left"><span class="icon mdi mdi-email"></span></div>
                                    <div class="unit-body"><a class="mail"
                                            href="mailto:pankey.ibarra@gmail.com">pankey.ibarra@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="wow slideInRight">
                                {{-- Instagram es la unica red social de la pasteleria; el otro
                                     enlace abre WhatsApp con el numero principal. Son iconos sin
                                     texto, de ahi el aria-label: sin el, un lector de pantalla
                                     solo anuncia "enlace". --}}
                                <ul class="list-inline footer-social-list footer-social-list-2 footer-social-list-3">
                                    <li><a class="icon mdi mdi-instagram"
                                            href="https://www.instagram.com/pankey.ibarra" target="_blank"
                                            rel="noopener" aria-label="Pankey en Instagram"></a></li>
                                    <li><a class="icon mdi mdi-whatsapp" href="https://wa.me/593969496362"
                                            target="_blank" rel="noopener"
                                            aria-label="Escribir a Pankey por WhatsApp"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-modern-line-3">
            <div class="container">
                <div class="row row-10 justify-content-between">
                    <div class="col-md-6"><span>Antonio José de Sucre y Río Blanco, a unos pasos del coliseo de la Bola
                            Amarilla &mdash; Ibarra</span></div>
                    <div class="col-md-auto">
                        <!-- Rights-->
                        <p class="rights"><span>&copy;&nbsp;</span><span
                                class="copyright-year"></span><span>&nbsp;Panadería y Pastelería Pankey.&nbsp;</span><span>Todos los
                                derechos reservados.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    {{-- ?v=filemtime: mismo motivo que en style.css, evita servir el JS viejo tras un cambio --}}
    <script type="module"
        src="{{ asset('js/script_InteracciónPrincipal.js') }}?v={{ filemtime(public_path('js/script_InteracciónPrincipal.js')) }}"></script>
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script type="module" src="{{ asset('js/funciones_reutilizables.js') }}"></script>
    @yield('script')
    <!-- coded by Himic-->
</body>

</html>
