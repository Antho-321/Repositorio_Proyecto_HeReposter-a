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
    <?php
    function miFuncion()
    {
        echo "¡Has seleccionado un archivo!";
    }
    ?>
    <h1 align="center">Ingreso de productos</h1>
    <form action="php_IngresoDeProductos.php" method="post">
        <section id="seccion_principal">
            <div id="seccion__Izq">
                <div>
                    <div class="fila">
                        <label class="col" for="lista_categoría">Categoría:</label>
                        <select name="lista_categoría" id="lista_categoría" class="col">
                            <option value="saab">Bodas</option>
                            <option value="opel">Bautizos</option>
                            <option value="audi">XV años</option>
                            <option value="audi">Cumpleaños</option>
                            <option value="audi">Baby Shower</option>
                            <option value="audi">San Valentin</option>
                            <option value="audi">Vísperas de Santos</option>
                            <option value="audi">Navidad</option>
                        </select>
                    </div>

                    <div class="fila">
                        <p class="col">Imagen:</p>
                        <input class="col" type="file" id="ingresoArchivo" name="archivo" onchange="miFuncion()">
                        <label class="col" for="">o</label>
                        <input class="col" type="url" value="Ingresar enlace">
                    </div>

                </div>
                <div class="tabla_info">

                    <div class="fila">
                        <p class="col">Tamaño:</p>
                        <div class="col">
                            <input class="col" type="radio" id="mini">
                            <label for="mini">Mini (5-6 porciones)</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="pequeña">
                            <label for="pequeña">Pequeña (10-12 porciones)</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="mediana">
                            <label for="mediana">Mediana (16 porciones)</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="grande">
                            <label for="grande">Grande (30 porciones)</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="extra_grande">
                            <label for="extra_grande">Extra grande (70 porciones)</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Masa:</p>
                        <div class="col">
                            <input class="col" type="radio" id="mini">
                            <label for="mini">Normal (Con receta propia)</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="pequeña">
                            <label for="pequeña">Bizcochuelo</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="mediana">
                            <label for="mediana">Milhojas</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Sabor:</p>
                        <div class="col">
                            <input class="col" type="radio" id="mini">
                            <label for="mini">Naranja</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="pequeña">
                            <label for="pequeña">Chocolate</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="mediana">
                            <label for="mediana">Naranja y chocolate (Marmoleada)</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Cobertura:</p>
                        <div class="col">
                            <input class="col" type="radio" id="mini">
                            <label for="mini">Crema</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="pequeña">
                            <label for="pequeña">Fondant</label>
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Relleno:</p>
                        <div class="col">
                            <input class="col" type="radio" id="mini">
                            <label for="mini">Mermelada de frutilla</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="pequeña">
                            <label for="pequeña">Mermelada de mora</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="mediana">
                            <label for="mediana">Glass de frutilla con crema</label>
                        </div>
                        <div class="col">
                            <input class="col" type="radio" id="mediana">
                            <label for="mediana">Crema napolitana</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="fila">
                        <label class="col" for="lista_categoría">Precio:</label>
                        <div class="col">
                            <label for="">$</label>
                            <input type="number" step="0.1">
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Descripción adicional:</p>
                        <textarea class="col" name="" id="">(Opcional)</textarea>
                    </div>

                </div>
            </div>
            <div id="seccion__Der">
                <h2>Previsualización de producto:</h2>
                <img src="../iconos/imagenes.png" alt="Imagen de pastel">
            </div>
        </section>
        <div id="seccion_btn">
            <input type="submit" value="Añadir producto">
        </div>
    </form>

</body>

</html>