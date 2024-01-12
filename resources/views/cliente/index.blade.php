@extends('plantilla.plantilla')
@section('content')

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

@endsection
