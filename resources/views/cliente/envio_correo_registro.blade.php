@extends('plantilla_cliente.plantilla')
@section('estilo_adicional')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_envio_correo_registro.css') }}">
@endsection
@section('content_btn_ingresar')
    @php
        $random = rand(10000, 100000);
        $correo = $cliente->email;
        $contraseña=$cliente->clave;
        $para = $correo;
        $asunto = 'Código de verificación';
        $cuerpo = 'Verificación de dispositivo';
        $texto1 = 'Código de verificación de registro en Pankey';
        $texto2 = 'Hemos recibido una solicitud de registro en nuestro sitio web de pastelería utilizando tu dirección de correo electrónico. Tu código de verificación de registro es:';
        $texto3 = 'Si no has solicitado este código, puede que alguien esté intentando registrarse en nuestro sitio web utilizando tu dirección de correo electrónico. No compartas este correo electrónico ni des el código a nadie. Has recibido este mensaje porque esta dirección de correo electrónico figura como dirección de contacto en la solicitud de registro en nuestro sitio web. Si crees que esto es un error, por favor ignora este mensaje o ponte en contacto con nosotros para solucionarlo. Gracias por elegir nuestro sitio web de pastelería.';
        $salida = shell_exec('node ./js/envio_correo.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '" "' . $texto1 . '" "' . $texto2 . '" "' . $texto3 . '" "' . $random . '"');
        session_start();
        //$_SESSION['cedula'] = $cedula;
        //$_SESSION['nombre'] = $nombre;
        //$_SESSION['apellido'] = $apellido;
        //$_SESSION['direccion'] = $direccion;
        $_SESSION['correo'] = $correo;
        $_SESSION['contraseña'] = $contraseña;
        $_SESSION['random'] = $random;
    @endphp

    @if (!isset($id))
        <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
    @else
        <button onclick="Logout()" id="Salida">Salir</button>
    @endif
@endsection
@section('content_envio_correo')
    <div id="VentanaForm">
        <form action="{{ route('cliente.create', $cliente) }}" method="POST">
            <div id="Ventana" class="Recuperación">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir" onclick="CerrarVentana(event)">
                </div>
                <h2>REGISTRARSE</h2>
                <label id="texto_info" for="correo">Ingrese el código enviado a su correo electrónico. Por favor revise la
                    carpeta de correo no deseado si no lo encuentra.</label>
                <input type="number" id="código" name="comparacion" class="entrada_texto">
                <button id="finalización_registro">Finalizar registro</button>
                <div></div>
            </div>

        </form>
    </div>
@endsection
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
