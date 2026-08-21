@extends('plantilla_cliente.new_plantilla')
@section('titulo', $pastel->getCategoriaPastel() . ' | Pankey')
@section('estilo')
    {{-- ?v=filemtime: mismo motivo que en style.css, evita servir el CSS viejo tras un cambio --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_ProductoSeleccionado.css') }}?v={{ filemtime(public_path('css/estilo_Modificación_ProductoSeleccionado.css')) }}" id="estilo">
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
            <a class="rd-nav-link dropdown-trigger" href="#" aria-haspopup="true" aria-expanded="false"><b>Catálogo</b></a>
            <form class="dropdown-content" id="Menu_Catalogo" action="{{ route('cliente.categoria_seleccionada') }}" method="GET">
                @csrf  
                <input type="hidden" name="categoria_value"
                    id="nombre_categoria">
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
    <img src="{{ asset('images/carro-de-la-carretilla.png') }}" alt=""
        id="carretilla">
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
@if (isset($cliente))
<form id="contenido_principal" action="{{ route('cliente.ingreso_carrito',$pastel) }}" method="GET">
    @csrf
    {{-- La categoría de la que se viene, como referencia de dónde está uno.
         El pastel no tiene nombre en la base de datos, así que no hay ningún
         titular que poner: cualquiera habría que inventárselo. --}}
    <div id="ficha_encabezado">
        <p id="ficha_categoria">{{ $pastel->getCategoriaPastel() }}</p>
    </div>
    <div id="DestacadoPrincipal">
        {{-- La foto entera sobre su propio fondo desenfocado, el mismo cuadro
             que las tarjetas de «Productos destacados»: se entra aquí pulsando
             una de ellas y la foto es la misma, así que no tendría sentido que
             se recortara o se rellenara de otro modo al llegar. Antes el hueco
             sobrante se tapaba con un crema fijo, que con las fotos oscuras se
             notaba como un marco. --}}
        @include('componentes.cuadro_foto', [
            'src' => $pastel->img,
            'alt' => 'Pastel de ' . $pastel->getSaborPastel() . ' con cobertura de ' . $pastel->getCoberturaPastel(),
            'nombre' => 'img',
        ])
        <p>${{$pastel->precio}}</p>
        <div id="seccion_cantidad">
            <label for="cantidad" id="label_cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
            <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
            <input type="number" id="cantidad" name="cantidad" value="1" readonly="">
            <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
        </div>
        <div id="seccion_envio">
            <button id="btn_add_carrito" value="Añadir al carrito">Añadir al carrito</button>
        </div>
    </div>
    <div id="infoDetallada">
        <div>
            <div class="tabla_info">
                <div class="fila">
                    <p class="col" id="texto_dedicatoria">Dedicatoria para el pedido:</p>
                    <div class="col">
                    </div>
                    <div class="col" id="cuadros_dedicatoria">
                        <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" value="">                   
                    </div>
                </div>
            </div>
            <div class="tabla_info">

                <div class="fila">
                    <p class="col">Porciones:</p>
                    <p class="col">{{$pastel->getNumPorcionesPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col">Tipo de pastel:</p>
                    <p class="col">{{$pastel->getTipoPastel()}}</p>
                    <p class="col">Cobertura:</p>
                    <p class="col">{{$pastel->getCoberturaPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col">Sabor:</p>
                    <p class="col">{{$pastel->getSaborPastel()}}</p>
                    <p class="col">Relleno:</p>
                    <p class="col">{{$pastel->getRellenoPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col" id="txtadicional">Especificación adicional:</p>
                    <div class="col" id="adicional">
                        <textarea name="espAdicional" id="espAdicional" placeholder="(Opcional)"></textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@else
<div id="contenido_principal">
    {{-- La categoría de la que se viene, como referencia de dónde está uno.
         El pastel no tiene nombre en la base de datos, así que no hay ningún
         titular que poner: cualquiera habría que inventárselo. --}}
    <div id="ficha_encabezado">
        <p id="ficha_categoria">{{ $pastel->getCategoriaPastel() }}</p>
    </div>
    <div id="DestacadoPrincipal">
        {{-- La foto entera sobre su propio fondo desenfocado, el mismo cuadro
             que las tarjetas de «Productos destacados»: se entra aquí pulsando
             una de ellas y la foto es la misma, así que no tendría sentido que
             se recortara o se rellenara de otro modo al llegar. Antes el hueco
             sobrante se tapaba con un crema fijo, que con las fotos oscuras se
             notaba como un marco. --}}
        @include('componentes.cuadro_foto', [
            'src' => $pastel->img,
            'alt' => 'Pastel de ' . $pastel->getSaborPastel() . ' con cobertura de ' . $pastel->getCoberturaPastel(),
            'nombre' => 'img',
        ])
        <p>${{$pastel->precio}}</p>
        <div id="seccion_cantidad">
            <label for="cantidad" id="label_cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
            <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
            <input type="number" id="cantidad" name="cantidad" value="1" readonly="">
            <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
        </div>
        <div id="seccion_envio">
            <input type="hidden" id="mensaje" value="Por favor inicie sesión para poder ingresar productos al carrito">
            <button id="add_carrito" value="Añadir al carrito">Añadir al carrito</button>
        </div>
    </div>
    <div id="infoDetallada">
        <div>
            <div class="tabla_info">
                <div class="fila">
                    <p class="col" id="texto_dedicatoria">Dedicatoria para el pedido:</p>
                    <div class="col">
                    </div>
                    <div class="col" id="cuadros_dedicatoria">
                        <input type="text" placeholder="Feliz Cumpleaños..." name="dedicatoria" value="">                   
                    </div>
                </div>
            </div>
            <div class="tabla_info">

                <div class="fila">
                    <p class="col">Porciones:</p>
                    <p class="col">{{$pastel->getNumPorcionesPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col">Tipo de pastel:</p>
                    <p class="col">{{$pastel->getTipoPastel()}}</p>
                    <p class="col">Cobertura:</p>
                    <p class="col">{{$pastel->getCoberturaPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col">Sabor:</p>
                    <p class="col">{{$pastel->getSaborPastel()}}</p>
                    <p class="col">Relleno:</p>
                    <p class="col">{{$pastel->getRellenoPastel()}}</p>
                </div>
                <div class="fila">
                    <p class="col" id="txtadicional">Especificación adicional:</p>
                    <div class="col" id="adicional">
                        <textarea name="espAdicional" id="espAdicional" placeholder="(Opcional)"></textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection