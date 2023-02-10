<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_InicioAdministración.css" id="estilo">
    <title>Administración</title>
</head>
<body>
    <div class="imgFondo"></div>
    <h1>¡Bienvenido!</h1>
    <section id="opciones">
        <div id="inicial">
            <div id="btn_despliegue" onclick="mostrarOpciones()">
                <p></p>
                <p></p>
                <p></p>
            </div>
            <img src="../imagenes/LOGO_PANKEY.png" alt="Logo de Pankey" id="LogoPankey">
            <h3>Administración</h3>
        </div>
        <div id="op_principales">
            <a href="../html/IngresoDeProductos.php">Ingresar Producto</a>
            <a href="../html/ActualizaciónDeInformación.php">Actualizar información</a>
            <a href="../html/EliminaciónDeProductos.php">Eliminar producto</a>
        </div>
        <script src="../script/script_InicioAdministración.js"></script>
    </section>
    
</body>
</html>