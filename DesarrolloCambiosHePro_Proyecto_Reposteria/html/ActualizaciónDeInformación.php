<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_ActualizaciónDeInformación.css" id="estilo">
    <title>Actualización de información</title>
</head>
<body>
    <h1>Actualización de información</h1>
    <section id="cambio_portada">
        <form id="cambio_portada_contenido">
            <p>Imagen de portada:</p>
            <input type="file" id="file-input" name="archivo" onchange="archivoIngresado()">
            <label class="opcion_enlace" for="ingreso_enlace">o</label>
            <input type="url" value="Ingresar enlace" id="ingreso_enlace" onchange="enlaceIngresado()">
            <input type="submit" value="Guardar cambios">
        </form>
    </section>
    <section id="busqueda">
        <div id="busqueda_contenido">
            <label for="">Producto:</label>
            <input type="search" id="myInput">
        </div>
        
    </section>
    <h2>Resultados:</h2>
    <section id="seccion_productos"></section>
    <script src="../script/script_ActualizaciónDeInformación.js"></script>
</body>
</html>