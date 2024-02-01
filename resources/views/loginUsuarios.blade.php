<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Repostería Pankey</title>
    <link rel="stylesheet" href="/resources/css/estilo_VentanaDeIngresoUsuarios.css">
</head>
<body>
    <div id="contenido_principal">
        <div id="VentanaDeRegistro">
            <form id="Ventana" action="../Controllers/Registro.php" method="POST">
                <h2>Registrarse</h2>
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" class="entrada_texto" required>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="entrada_texto" required>

                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" class="entrada_texto" required>

                <div class="campo-contrasena">
    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" class="entrada_texto" required>
    <input type="checkbox" onclick="verpassword('contraseña')">Mostrar contraseña
</div>

<div class="campo-contrasena">
    <label for="contraseña_repetir">Repetir Contraseña:</label>
    <input type="password" id="contraseña_repetir" name="contraseña_repetir" class="entrada_texto" required>
    <input type="checkbox" onclick="verpassword('contraseña_repetir')">Mostrar contraseña
</div>

<div class="centrado">
    <button id="btn_registrarse">Registrarse</button>
</div>

<div class="centrado">
    <label for="ya_registrado">¿Ya estás registrado?</label>
    <button id="ya_registrado" onclick="MostrarVentanaDeIngreso()">Ingresar</button>
</div>
            </form>
        </div>
    </div>
    <footer>
        <div id="Derechos">
            © 2023 REPOSTERIA PANKEY
        </div>
    </footer>
    <script>
    function verpassword(idCampo) {
      var campo = document.getElementById(idCampo);
      if (campo.type === "password") {
          campo.type = "text";
      } else {
          campo.type = "password";
      }
    }
    </script>
</body>
</html>