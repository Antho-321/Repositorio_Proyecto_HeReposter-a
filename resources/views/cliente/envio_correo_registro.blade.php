@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('plantilla_cliente.plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_Index.css') }}" id="estilo">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_envio_correo_registro.css') }}">
@endsection
@section('content_envio_correo')
<div id="Salto">
    <div id="VentanaForm">
        <form action="{{ route('cliente.create') }}" method="PUT">
            @csrf
            <div id="Ventana" class="Recuperación">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir" onclick="CerrarVentana(event)">
                </div>
                <h2>{{ucfirst(Session::get('tipo_ingreso_aux'))}}</h2>
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
                    <button id="finalización_registro">Ingresar</button>
                @else
                    <button id="finalización_registro">Finalizar registro</button>
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
    <script src="{{ asset('js/script_querys.js') }}"></script>
    <script src="{{ asset('js/script_InteracciónPrincipal.js') }}"></script>
</div>
@endsection
