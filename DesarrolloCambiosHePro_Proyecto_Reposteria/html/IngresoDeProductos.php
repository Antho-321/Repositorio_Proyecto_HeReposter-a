<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_IngresoDeProductos.css" id="estilo">
    <title>Ingreso de productos</title>
</head>

<body>
    <h1 align="center">Ingreso de productos</h1>
    <form id="form" method='POST' enctype="multipart/form-data" action="../php/php_IngresoDeProductos.php">
        <section id="seccion_principal">
            <div id="seccion__Izq">
                <div>
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

                    <div class="fila">
                        <label class="col" for="ingresoArchivo">Imagen:</label>
                        <input class="col" type="file" id="file-input" name="archivo">
                        <label class="col" for="ingreso_enlace">o</label>
                        <input class="col" type="url" value="Ingresar enlace" name="enlace" id="ingreso_enlace" onchange="enlaceIngresado()">
                        <input type="hidden" name='ingreso_enlace' id="verificacion_enlace">
                    </div>

                </div>
                <div class="tabla_info">
                    <div class="fila">
                        <p class="col">Forma:</p>
                        <div class="col">
                            <input class="col" type="radio" id="red" onchange="opcionesPastel(event)" name="forma">
                            <label for="red">Redonda</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="cuad" onchange="opcionesPastel(event)" name="forma">
                            <label for="cuad">Cuadrada</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="rec" onchange="opcionesPastel(event)" name="forma">
                            <label for="rec">Rectangular</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="per" onchange="opcionesPastel(event)" name="forma">
                            <label for="per">Personalizada</label>
                        </div>
                    </div>                   
                </div>
                
            </div>
            <div id="seccion__Der">
                <h2>Previsualización de producto:</h2>
                <img alt="Imagen de pastel" id="image-preview">
            </div>
        </section>
        <input type="hidden" name='formulario'>
        <div id="seccion_btn">
            <input type="submit" value="Añadir producto">
        </div>
    </form>
    <script src="../script/script_IngresoDeProductos.js"></script>
</body>

</html>