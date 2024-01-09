<?php
use App\Models\Pastel;
$pastel_search = new Pastel();
$pastel = $pastel_search->getPastelByImg($img);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_IngresoDeProductos.css') }}" id="estilo">
    <title>Ingreso de productos</title>
</head>

<body>
    <header>
        <!-- //////////////////////////////////////////LOGO/////////////////////////////////////////////// -->
        <a href="/actualizar_producto" id="regreso_pagina">← Regresar</a>
        <div id="bloq_izq">
        <img src="{{ asset('images/LOGO_PANKEY1.png') }}" alt="LOGO_PANKEY" id="LogoPankey">
        </div>
        <div id="bloq_der">
            <h1 align="center">Actualización de información</h1>
        </div>
        <!-- //////////////////////////////////////////MENU/////////////////////////////////////////////// -->
    </header>
    <form id="form" class="form_update" method="POST" action="{{ route('actualizar_seleccionado_put',$pastel->codigo_pastel) }}" role="form">
    @csrf
    @method('PUT')
        <section id="seccion_principal">
            <div id="seccion__Izq">
                <div>
                    <div class="fila">
                        <label class="col" for="lista_categoría">Categoría:</label>
                        <select name="categoria" id="lista_categoría" class="col">
                            <option value="Bodas">Bodas</option>
                            <option value="Bautizos">Bautizos</option>
                            <option value="XV_años">XV años</option>
                            <option value="Cumpleaños">Cumpleaños</option>
                            <option value="Baby_Shower">Baby Shower</option>
                            <option value="San_Valentin">San Valentin</option>
                            <option value="Vísperas_de_Santos">Vísperas de Santos</option>
                            <option value="Navidad">Navidad</option>
                        </select>
                    </div>
                    <div class="fila">
                        <label class="col" for="ingresoArchivo">Imagen:</label>
                        <div class="dropzone" id="formDrop">
                            <input type="url" placeholder="Ingresar enlace" id="ingreso_enlace">
                            <input type="hidden" name="img" id="aux_IngresarEnlace">
                            <input type="hidden" name='ingreso_enlace' id="verificacion_enlace">
                            <input type="hidden" name='ingreso_archivo' id="ruta_archivo_img">
                        </div>
                        <input type="hidden" name='ant_enlace' id="anterior_enlace" value="`+ dirImg + `">
                    </div>
                </div>
                <div class="tabla_info">
                    <div class="fila">
                        <p class="col">Forma:</p>
                        <div class="col">
                            <input class="col" type="radio" id="red" onchange="opcionesPastel(event)" value="Redonda"
                                name="forma">
                            <label for="red">Redonda</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="cuad" onchange="opcionesPastel(event)" value="Cuadrada"
                                name="forma">
                            <label for="cuad">Cuadrada</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="rec" onchange="opcionesPastel(event)"
                                value="Rectangular" name="forma">
                            <label for="rec">Rectangular</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="per" onchange="opcionesPastel(event)"
                                value="Personalizada" name="forma">
                            <label for="per">Personalizada</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="seccion__Der">
                <h2 class="prev_act">Previsualización de producto:</h2>
                <img alt="Imagen de pastel" id="image-preview" src="{{$img ?? ' '}}" width="200px">
            </div>
        </section>
        <input type="hidden" name='formulario'>
        <input type="hidden" name="porciones" id="porciones">
        <div id="seccion_btn">
            <!-- <input type="submit" value="Guardar cambios" id="enviarFormulario"> -->
            <button id="enviarFormulario">Guardar cambios</button>
        </div>
    </form>
    <script src="{{ asset('js/script_ActualizaciónDeInformación.js') }}"></script>
</body>

</html>