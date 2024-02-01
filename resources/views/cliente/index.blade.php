@extends('plantilla_cliente.new_plantilla')
@section('estilo')
<link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}" id="estilo">
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
<input type="hidden" name="pasteles" value="{{ json_encode(Session::get('pasteles')) }}" id="pasteles">
<form action="{{ route('cliente.ingreso') }}" method="POST" id="Salto">
    @csrf
    <input type="hidden" name="registro" value="false" id="registro">
</form>
@endsection
@section('content')
<section class="section swiper-container swiper-slider swiper-slider-2 swiper-slider-3" data-loop="true" data-autoplay="5000" data-simulate-touch="false" data-slide-effect="fade">
    <div class="swiper-wrapper text-sm-left">
        <div class="swiper-slide context-dark" data-slide-bg="{{ asset('images/slide-1-1920x753.jpg') }}">
            <div class="swiper-slide-caption section-md">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9 col-md-8 col-lg-7 col-xl-7 offset-lg-1 offset-xxl-0">
                            <h1 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInUp" data-caption-delay="0">Descubre el nuevo sabor</span></h1>
                            <p class="big swiper-text add_txt" data-caption-animate="fadeInLeft" data-caption-delay="300">Con recetas tradicionales y un toque moderno.</p><a class="button button-lg button-primary button-winona button-shadow-2 btn_ver_destacados" href="#our-menu" data-caption-animate="fadeInUp" data-caption-delay="300">Ver productos
                                destacados</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide context-dark" data-slide-bg="{{ asset('images/slide-2-1920x753.jpg') }}">
            <div class="swiper-slide-caption section-md">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-lg-7 offset-lg-1 offset-xxl-0">
                            <h1 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInDown" data-caption-delay="0">Ingredientes de
                                    calidad</span></h1>
                            <p class="big swiper-text add_txt" data-caption-animate="fadeInRight" data-caption-delay="300">Solo los ingredientes más finos y exquisitos se usan para
                                crear pasteles inigualables para nuestros clientes.</p>
                            <div class="button-wrap oh ver_destacados_container"><a class="button button-lg button-primary button-winona button-shadow-2 btn_ver_destacados" href="#our-menu" data-caption-animate="slideInUp" data-caption-delay="0">Ver
                                    productos destacados</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Swiper Pagination-->
    <div class="swiper-pagination" data-bullet-custom="true"></div>
    <!-- Swiper Navigation-->
    <div class="swiper-button-prev">
        <div class="preview">
            <div class="preview__img"></div>
        </div>
        <div class="swiper-button-arrow"></div>
    </div>
    <div class="swiper-button-next">
        <div class="swiper-button-arrow"></div>
        <div class="preview">
            <div class="preview__img"></div>
        </div>
    </div>

</section>
<div id="our-menu" style="position: absolute; top: 663px;"></div>
<!-- What We Offer-->
<section class="section section-md bg-default">
    <div class="container">
        <h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">Productos destacados</span></h3>
        <form action="{{ route('cliente.pastel_seleccionado') }}" method="POST" id="seccion_productos">
            @csrf
            <input type="hidden" name="img" id="enlace_pastel">
        </form>
    </div>
</section>
@endsection