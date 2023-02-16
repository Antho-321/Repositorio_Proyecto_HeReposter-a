<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_VentanaDeIngresoAdministrador.css" id="estilo">
    <title>REPOSTERIA</title>
</head>

<body>
    <div id="contenido_principal">
        <div id="VentanaDeIngreso">
            <form id="Ventana" action="../php/validar_administrador.php" method="POST">
                <h2>Ingresar</h2>
                <label for="correo">Usuario</label>
                <input type="email" id="correo" name="user" class="entrada_texto">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="pass" class="entrada_texto">
                <button id="ingresar">Ingresar</button>
            </form>
        </div>
    </div>
    <footer>
        <div id="Derechos">
            © 2023 Blog Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
</body>

</html>