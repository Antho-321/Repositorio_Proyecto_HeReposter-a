@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_SobreNosotros.css') }}" id="estilo">
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
        <div id="DestacadoPrincipal">
            <img src="https://rochinae.files.wordpress.com/2016/02/panadero.jpg?w=776" alt="imagenes">
        </div>
        <div id="texto">
            <h1>Nuestra historia</h1>
            <p>La pastelería "Pankey" fue fundada hace más de 30 años por los hermanos Genny y Carlos, quienes
                aprendieron las técnicas de su padre en la panadería. Genny se quedó con la pastelería cuando los
                hermanos decidieron separarse, y conoció a Luis en un curso de Levapan. Luis compró el horno de Carlos y
                comenzó a trabajar en la pastelería con Genny. Luego de algunos años, se casaron y llevaron la
                pastelería de vuelta a Azaya. Para expandirse y llegar a más clientes, abrieron una sucursal cerca del
                terreno que había heredado Genny, lo que les permitió crear nuevos productos ajustados a las necesidades
                y gustos de la comunidad.</p>
        </div>
    </div>
@endsection
