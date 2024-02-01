@section('token_adicional')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@php
    use App\Models\Pastel;
    use App\Models\DetallesPedido;
    use App\Models\Pedido;
    use App\Models\Comprobante;
    use Illuminate\Support\Facades\Session;
    $cliente = Session::get('cliente');
    if (isset($cliente)) {
        $detalles_pedido_search = new DetallesPedido();
        $pedido_search = new Pedido();
        $cliente_id = $cliente->cliente_id;
        $pedido = $pedido_search->getPedidosNoConfirmadosPorCliente($cliente_id);
        if (!empty($pedido[0])) {
            $pedido_id = $pedido[0]->pedido_id;
            $pasteles = $detalles_pedido_search->getPastelesByPedido($pedido_id);
            $detalles_pedido = $detalles_pedido_search->getDetallesPedidoByPedido($pedido_id);
            $pastel_search = new Pastel();
        }
    }
    $comprobante_search = new Comprobante();
    $id_comprobante = $comprobante_search->max('comprobante_id') + 1;
    $total_pago=0;
@endphp
@extends('plantilla_cliente.new_plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_CarritoDeCompras.css') }}" id="estilo">
    <script
        src="https://www.paypal.com/sdk/js?client-id=Ae1w7jU4kbRrRCFluXHkxbnTITPA_JXsU-0aSuXq0oSiqkA-IKkxyIeexgvkG5QFbQTa9EhbbJaECvUP&amp;currency=USD"
        data-uid-auto="uid_oyrfqkrdjrrbnryisejljfrdcclpzf"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
@endsection
@section('navegacion')
<input type="checkbox" id="check3" onchange="DescargarComprobante()" style="position: absolute; top: 1000px">
    <ul class="rd-navbar-nav">
        <li class="rd-nav-item">
            <a class="rd-nav-link" href="{{ route('cliente.index') }}"><b>Inicio</b></a>
        </li>
        <li class="rd-nav-item">
            <a class="rd-nav-link" href="{{ route('cliente.sobre_nosotros') }}"><b>Sobre nosotros</b></a>
        </li>
        <li class="rd-nav-item">
            <div class="dropdown">
                <a class="rd-nav-link" href="typography.html"><b>Catalogo</b></a>
                <form class="dropdown-content" id="Menu_Catalogo" action="{{ route('cliente.categoria_seleccionada') }}"
                    method="GET">
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
        <li class="rd-nav-item active" style="width: 60px;">
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
    <div id="contenido_principal">
        @if (!isset($pasteles))
            <h1>No se ha ingresado productos</h1>
            <style>
                #contenido_principal {
                    height: 69.9%;
                    padding-bottom: 0px;
                    align-items: center;
                    justify-content: center;
                }
            </style>
        @else
            <section id="Productos">
                <div class="tabla_info">
                    <div class="fila" id="primera_fila">
                        <br class="col">
                        <p class="col">Dedicatoria/s</p>
                        <p class="col">Masa</p>
                        <p class="col">Sabor</p>
                        <p class="col">Relleno</p>
                        <p class="col">Cobertura</p>
                        <p class="col">Precio unitario</p>
                        <p class="col">Cantidad</p>
                    </div>
                    @php
                        $cont = -1;
                    @endphp
                    <input type="hidden" name="email" value="{{$cliente->email}}" id="email">
                    @foreach ($pasteles as $pastel)
                        
                        <div class="fila datos_carrito">

                            @csrf

                            @php
                                $cont = $cont + 1;
                                $total_pago+=$detalles_pedido[$cont]->cantidad_pastel*$pastel_search->getPastelById($pastel->pastel_id)->precio;
                            @endphp
                            <div class="col" id="seccion_imagen">
                                <img src="{{ $pastel_search->getPastelById($pastel->pastel_id)->img }}" alt="Producto">
                            </div>
                            <p class="col" name="dedicatoria">{{ $detalles_pedido[$cont]->dedicatoria }}</p>
                            <p class="col" name="masa">
                                {{ $pastel_search->getPastelById($pastel->pastel_id)->getTipoPastel() }}</p>
                            <p class="col" name="sabor">
                                {{ $pastel_search->getPastelById($pastel->pastel_id)->getSaborPastel() }}</p>
                            <p class="col" name="relleno">
                                {{ $pastel_search->getPastelById($pastel->pastel_id)->getRellenoPastel() }}</p>
                            <p class="col" name="cobertura">
                                {{ $pastel_search->getPastelById($pastel->pastel_id)->getCoberturaPastel() }}</p>
                            <p class="col" name="precio">
                                ${{ $pastel_search->getPastelById($pastel->pastel_id)->precio }}</p>
                            <p class="col" name="cantidad">{{ $detalles_pedido[$cont]->cantidad_pastel }}</p>
                            <input type="hidden" name="categoria" value="{{$pastel_search->getPastelById($pastel->pastel_id)->getCategoriaPastel()}}">
                            <div class="col" id="seccion_eliminar">
                                <div>
                                    <form action="{{ route('detalles_pedido.show', $detalles_pedido[$cont]->detalle_id) }}"
                                        method="GET">
                                        @csrf
                                        <input type="hidden" name="adicional" id="req_Adicional" value="undefined">
                                        <button id="editarCarrito" class="btn_eliminar">✏️</button>
                                        
                                    </form>
                                    <form action="{{ route('detalles_pedido.destroy', $detalles_pedido[$cont]->detalle_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn_eliminar"><img src="{{ asset('images/Borrador.png') }}"
                                                id="borrador"></button>
                                    </form>
                                </div>
                            </div>



                        </div>
                    @endforeach



                </div>
            </section>
            <section id="Info_adicional">
                <h2 class="txt_total">Total</h2>
                <p class="col" id="total">
                    ${{$total_pago}} </p>
                <div class="tabla_info">
                    <div class="fila">
                        <label class="col" for="fecha_entrega">Fecha de entrega:</label>
                        <div id="entrada_fecha" class="col">
                            <input type="date" id="fecha_entrega" name="fecha_entrega" required="">
                            <div id="error-message" class="error">La fecha ingresada no puede ser menor o igual a la
                                fecha actual.</div>
                            <div id="error-message3" class="error">Fecha inválida.</div>
                        </div>
                    </div>
                    <div class="fila">
                        <label class="col" for="time">Hora:</label>
                        <div id="entrada_tiempo" class="col">
                            <input type="time" id="hora_entrega">
                            <input type="hidden" name="id_comprobante" id="id_comprobante" value="{{$id_comprobante}}">
                            <input type="hidden" name="id_pedido" id="id_pedido" value="{{$pedido_id}}">
                            <div id="error-message2" class="error">La entrega del pedido no puede realizarse en menos
                                de 24 horas.</div>
                        </div>
                    </div>

                </div>
                <div id="botones_carrito">
                    <input id="fin_pedido" class="fin_pedido" type="button" value="Finalizar pedido"
                        onclick="finalizarPedido()">
                    <label for="check3" id="desc_comp" class="desc_fact" style="display:none">
                        Descargar comprobante
                    </label>
                </div>

                <p>Nota: Pronto incorporaremos la entrega a
                    domicio. Los pedidos que realices puedes
                    retirarlos de nuestro local desde las 24h
                    transcurridas.<br>
                    Dirección: Av. Atahualpa y Tobías Mena, a
                    unos pasos del coliseo de la Bola Amarilla
                </p>
            </section>
        @endif

    </div>
    <script src="{{ asset('js/script_querys.js') }}"></script>
@endsection
