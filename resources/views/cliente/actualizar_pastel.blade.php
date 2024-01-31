@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_ProductoSeleccionado.css') }}" id="estilo">
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
<a class="rd-nav-link" href="contacts.html"><b>Pasteles personalizados</b></a>
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
@php
    use App\Models\DetallesPedido;
    use App\Models\Pastel;
    $detalles_pedido_search=new DetallesPedido();
    $detalles_pedido=$detalles_pedido_search->getDetallesPedidoById($detalle_id);
    $pastel_id=$detalles_pedido->pastel_id;
    $pastel_search=new Pastel();
    $pastel=$pastel_search->getPastelById($pastel_id);
@endphp
<input type="hidden" id="actualizar_pastel" value="true">
<form id="contenido_principal" action="{{ route('detalles_pedido.update',$pastel) }}" method="GET">
    @csrf
    <div id="DestacadoPrincipal">
        <img src="{{$pastel->img}}" alt="imagenes" name="img">
        <p>${{$pastel->precio}}</p>
        <div id="seccion_cantidad">
            <label for="cantidad" id="label_cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
            <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
            <input type="number" id="cantidad" name="cantidad" value="{{$detalles_pedido->cantidad_pastel}}" readonly="">
            <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
        </div>
        <div id="seccion_envio">
            <button value="Actualizar información">Actualizar información</button>
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

@endsection
