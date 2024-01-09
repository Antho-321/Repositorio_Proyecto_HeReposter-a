<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_ActualizaciónDeInformación.css') }}" id="estilo">
    <div class="dropzone" id="formDrop" style="display: none"></div>
    <title>Actualización de información</title>
</head>
<body>

    <!-- ///////////////////////////////////////////////////////////////////////////ENCABEZADO///////////////////////////////////////////////////////////////////////////////////////////// -->

    <header>

        <!-- //////////////////////////////////////////LOGO/////////////////////////////////////////////// -->
        <a href="/InicioAdministración" id="regreso_pagina">← Regresar</a>
        <div id="bloq_izq">
        <img src="{{ asset('images/LOGO_PANKEY1.png') }}" alt="LOGO_PANKEY" id="LogoPankey">
        </div>
        <div id="bloq_der">
        <h1>Actualización de información</h1>
        </div>
        <input type="hidden" name="pasteles" value="{{json_encode($pasteles)}}" id="pasteles">
        <!-- //////////////////////////////////////////MENU/////////////////////////////////////////////// -->

        
       
    </header>

    
<div id="contenido_principal">
<div id="Salto"></div>
<form id="seccion_productos" method="POST" action="{{ route('actualizar_seleccionado') }}" role="form">

</form>
    <script src="{{ asset('js/script_ActualizaciónDeInformación.js') }}"></script>
</div>

    
</body>
</html>