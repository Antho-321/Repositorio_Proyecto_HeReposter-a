@php
    use Illuminate\Support\Facades\Session;
    $pedido = Session::get('pedido');
    $pasteles = Session::get('pasteles_carrito');
@endphp
@extends('plantilla_cliente.plantilla')
@section('estilo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_Modificación_CarritoDeCompras.css') }}" id="estilo">
    <script
        src="https://www.paypal.com/sdk/js?client-id=Ae1w7jU4kbRrRCFluXHkxbnTITPA_JXsU-0aSuXq0oSiqkA-IKkxyIeexgvkG5QFbQTa9EhbbJaECvUP&amp;currency=USD"
        data-uid-auto="uid_oyrfqkrdjrrbnryisejljfrdcclpzf"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
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
        {{-- @if (!isset($cliente))
            <h1>No se ha ingresado productos</h1>
            <style>
                #contenido_principal {
                    height: 69.9%;
                    padding-bottom: 0px;
                    align-items: center;
                    justify-content: center;
                }
            </style>
        @else --}}
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
                <form class="fila" action="../php/EliminarItemCarrito.php" method="POST">
                    @csrf
                    @foreach ($pasteles as $pastel)
                        <div class="col" id="seccion_imagen">
                            <img src="{{$pastel->img}}" alt="Producto">
                        </div>
                        <p class="col" name="dedicatoria">{{$pastel->dedicatoria}}</p>
                        <p class="col" name="masa">{{$pastel->getTipoPastel()}}</p>
                        <p class="col" name="sabor">{{$pastel->getSaborPastel()}}</p>
                        <p class="col" name="relleno">{{$pastel->getRellenoPastel()}}</p>
                        <p class="col" name="cobertura">{{$pastel->getCoberturaPastel()}}</p>
                        <p class="col" name="precio">${{$pastel->precio}}</p>
                        <p class="col" name="cantidad">{{$pastel->cantidad}}</p>
                        <div class="col" id="seccion_eliminar">
                            <div>
                                <input type="hidden" name="id_canasta" value="undefined">

                                <input type="button" id="editarCarrito" class="btn_eliminar" value="✏️">
                                <input type="hidden" value="undefined" id="test">
                                <input type="hidden" name="adicional" id="req_Adicional" value="undefined">
                                <button class="btn_eliminar"><img src="{{ asset('images/Borrador.png') }}"
                                        id="borrador"></button>
                            </div>
                        </div>
                    @endforeach
                </form>


            </div>
        </section>
        <section id="Info_adicional">
            <h2>Total</h2>
            <p class="col" id="total">
                $15 </p>
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
                        <input type="hidden" name="id_comprobante" id="id_comprobante" value="1">
                        <input type="hidden" name="id_pedido" id="id_pedido" value="2">
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
        {{-- @endif --}}

    </div>
@endsection
