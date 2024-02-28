@extends('plantilla_cliente.new_plantilla')
@section('token_adicional')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('estilo')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_PatelesPersonalizados.css') }}" id="estilo">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
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
        <li class="rd-nav-item active">
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
                use App\Models\FormaPastel;
                use App\Models\TamanoPastel;
                use App\Models\Tamano_Forma;
                use App\Models\Tipo_Relleno_Sabor;
                use App\Models\TipoPastel;
                use App\Models\Sabor;
                use App\Models\Relleno;
                use App\Models\Cobertura;
                $cliente = Session::get('cliente');
                $formas = FormaPastel::getFormasDescripcion();
                $tamanos = TamanoPastel::getTamanosDescripcion();
                $formas_tamanos = Tamano_Forma::getDetailedDescriptions();
                $tipos = TipoPastel::getTiposDescripcion();
                $sabores=Sabor::getSaboresDescripcion();
                $rellenos=Relleno::getRellenosDescripcion();
                $tipo_relleno_sabor=Tipo_Relleno_Sabor::getRellenosSaboresDetails();
                $coberturas=Cobertura::getCoberturasDescripcion();
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
    <!--
    <h1>Información sobre porciones</h1>
    <section id="Productos">
        <table id="tabla1">
            <tr>
                <th rowspan="2">Tamaño</th>
                <th colspan="4" id="txtFormaPastel">Forma de pastel</th>
            </tr>
            <tr>
                <th>Redonda</th>
                <th>Personalizada</th>
                <th>Cuadrada</th>
                <th>Rectangular</th>
            </tr>
            <tr>
                <th>Mini</th>
                <td><img src="https://i.ibb.co/SKpf5Z2/backgrounderaser-1678723524.png"
                        width="100px"><br>5-6 personas</td>
                <td><img src="https://i.ibb.co/mSxxxjt/backgrounderaser-1678737045.png"
                        width="60px"><br>2-4 personas</td>
                <td>No disponible</td>
                <td>No disponible</td>
            </tr>
            <tr>
                <th>Pequeña</th>
                <td><img src="https://i.ibb.co/Zhg10VD/output-onlinepngtools-1.png"
                        width="100px"><br>10-12 personas</td>
                <td><img src="https://i.ibb.co/F3cW5Xb/backgrounderaser-1678736059-1.png"
                        width="80px"><br>8-10 personas</td>
                <td><img src="https://i.ibb.co/C5wspwH/backgrounderaser-1678749197-1.png"
                        width="100px"><br>20-25 personas</td>
                <td>No disponible</td>
            </tr>
            <tr>
                <th>Mediana</th>
                <td><img src="https://i.ibb.co/VvG9R3T/backgrounderaser-1678728049-1.png"
                        width="100px"><br>16 personas</td>
                <td><img src="https://i.ibb.co/9ck0JWJ/backgrounderaser-1678738045-1.png"
                        width="100px"><br>12-14 personas</td>
                <td><img src="https://i.ibb.co/KySR7pH/backgrounderaser-1678747088.png"
                        width="100px"><br>35-40 personas</td>
                <td><img src="https://i.ibb.co/FWV1kdZ/backgrounderaser-1678750052-1.png"
                        width="100px"><br>35-40 personas</td>
            </tr>
            <tr>
                <th>Grande</th>
                <td><img src="https://i.ibb.co/PFrcpnQ/backgrounderaser-1678729422.png"
                        width="100px"><br>30 personas</td>
                <td><img src="https://i.ibb.co/7Vj2VBm/backgrounderaser-1678742681-1.png"
                        width="90px"><br>26-28 personas</td>
                <td><img src="https://i.ibb.co/F7pK5Ch/backgrounderaser-1678747498.png"
                        width="100px"><br>50 personas</td>
                <td>No disponible</td>
            </tr>
            <tr>
                <th>Extra grande</th>
                <td><img src="https://i.ibb.co/WtMtzJC/backgrounderaser-1678731628.png"
                        width="100px"><br>70 personas</td>
                <td><img src="https://i.ibb.co/Z8HwWfc/backgrounderaser-1678751247-1.png"
                        width="100px"><br>66-68 personas</td>
                <td>No disponible</td>
                <td><img src="https://i.ibb.co/fDnW78T/backgrounderaser-1678750417-1.png"
                        width="120px"><br>100 personas</td>
            </tr>
        </table>
    </section>
    -->
    <input type="hidden" name="formas" id="formas" value="{{ json_encode($formas) }}">
    <input type="hidden" name="tamanos" id="tamanos" value="{{ json_encode($tamanos) }}">
    <input type="hidden" name="formas_tamanos" id="formas_tamanos" value="{{ json_encode($formas_tamanos) }}">
    <input type="hidden" name="tipos" id="tipos" value="{{ json_encode($tipos) }}">
    <input type="hidden" name="sabores" id="sabores" value="{{ json_encode($sabores) }}">
    <input type="hidden" name="rellenos" id="rellenos" value="{{ json_encode($rellenos) }}">
    <input type="hidden" name="coberturas" id="coberturas" value="{{ json_encode($coberturas) }}">
    <input type="hidden" name="tipo_relleno_sabor" id="tipo_relleno_sabor" value="{{ json_encode($tipo_relleno_sabor) }}">
    <form action="" id="form_proPersonalizado">
        <table id="personalizacion">
            <tbody>
                <tr>
                    <td colspan="2">
                        <h2 id="prevModelo">Previsualización de modelo</h2>
                    </td>
                </tr>
                <tr>
                    <td class="seccion_formDrop" colspan="2">       
                        <div class="dropzone" id="formDrop">
                            <input type="url" placeholder="Ingresar enlace" name="ingreso_enlace" class="para_enlace" id="enlace1"
                            onclick="quitarPlaceHolder(event)">
                            <input type="hidden" name="enlace" class="aux_IngresarEnlace">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<input type="hidden" name="img_pastel_personalizado" id="img_pastel_personalizado" value="{{ route('cliente.consulta_pastel_personalizado') }}">
@endsection
@section('script')
    <script src="{{ asset('js/script_PastelesPersonalizados.js') }}"></script>
@endsection