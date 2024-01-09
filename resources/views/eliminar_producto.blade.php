<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_EliminaciónDeProductos.css') }}" id="estilo">
    <title>Eliminación de productos</title>
</head>

<body>
    <div>
        <div class="fixed">
            <a href="/InicioAdministración" id="regreso_pagina">← Regresar</a>
            <h1>Eliminación de productos</h1>
            <input type="hidden" name="pasteles" value="{{json_encode($pasteles)}}" id="pasteles">
        </div>

        <div id="Salto">
            <form class="Mensaje" id="Ventana" style="display: none;" method="POST" action="{{ route('eliminar_seleccionado') }}" role="form">
                @csrf
                @method('DELETE')
                <input type="hidden" name="img" id="enlace_imagen">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir" onclick="CerrarVentana()">
                </div>
                <h2>¿Eliminar producto?</h2>
                <div id="botones">
                    <button id="finalización_registro" onclick="eliminarProducto()">Aceptar</button>
                    <button id="finalización_registro" onclick="CerrarVentana()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <section id="seccion_productos"></section>
    <script src="{{ asset('js/script_EliminaciónDeProductos.js') }}"></script>
</body>

</html>