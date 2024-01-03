<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_InicioAdministración.css') }}" id="estilo">
    <title>Administración</title>
</head>
<body>
    <input type="checkbox" id="check">
    <div>
        <div class="imgFondo op"></div>
        <h1 class="op">¡Bienvenido!</h1>
        <h1 id="wh_backg" class="op">¡Bienvenido!</h1>
        <section id="opciones">
            <div id="inicial">
                <label for="check" class="mostrar_menu" id="btn_despliegue">
                    <p></p>
                    <p></p>
                    <p></p>
                </label>
                <img src="{{ asset('images/LOGO_PANKEY.png') }}" alt="Logo de Pankey" id="LogoPankey">
                <h3>Administración</h3>
            </div>
            <div id="op_principales">
                <a href="{{ route('pastel.create') }}">Ingresar Producto</a>
                <a href="{{ route('pastel.edit', ['pastel' => 1]) }}">Actualizar Producto</a>
                <a href="{{ route('pastel.delete') }}">Eliminar producto</a>
            </div>
        </section>
    </div>
</body>
</html>