<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../styles/estilo_IngresoDeProductos.css" id="estilo">
    <title>Ingreso de productos</title>
</head>

<body>
    <header>

        <img src="../imagenes/LOGO_PANKEY1.png" alt="LOGO_PANKEY" id="LogoPankey">

        <h1>Actualización de información</h1>
        <h4>ADMINISTRACIÓN</h4>

    </header>

    <h1>Ingreso de productos</h1>
    <form id="form" method='POST' enctype="multipart/form-data" action="../php/php_IngresoDeProductos.php">
        <h2>Previsualización de producto:</h2>
        <div class="dropzone" id="formDrop">
    <input type="url" placeholder="Ingresar enlace" id="ingreso_enlace" onclick="ingresarEnlace()">
    <input type="hidden" name="enlace" id="aux_IngresarEnlace">
    <input type="hidden" name='ingreso_enlace' id="verificacion_enlace">
  </div>
        <section id="seccion_principal">

            <div class="tabla_info">
                <div class="fila">
                    <label class="col" for="lista_categoría">Categoría:</label>
                    <select name="lista_categoría" id="lista_categoría" class="col">
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


            </div>
            <div class="tabla_info">
                <div class="fila">
                    <p class="col">Forma:</p>
                    <div class="col">
                        <input class="col" type="radio" id="red" onchange="opcionesPastel(event)" value="Redonda" name="forma">
                        <label for="red">Redonda</label>
                    </div>
                    <div class="col">
                        <input class="col" type="radio" id="cuad" onchange="opcionesPastel(event)" value="Cuadrada" name="forma">
                        <label for="cuad">Cuadrada</label>
                    </div>
                    <div class="col">
                        <input class="col" type="radio" id="rec" onchange="opcionesPastel(event)" value="Rectangular" name="forma">
                        <label for="rec">Rectangular</label>
                    </div>
                    <div class="col">
                        <input class="col" type="radio" id="per" onchange="opcionesPastel(event)" value="Personalizada" name="forma">
                        <label for="per">Personalizada</label>
                    </div>
                </div>
            </div>





        </section>
        <input type="hidden" name='formulario'>
        <div id="seccion_btn">
            <input type="submit" value="Añadir producto" id="enviarFormulario">
        </div>
    </form>
    <script src="../script/script_IngresoDeProductos.js"></script>
</body>

</html>