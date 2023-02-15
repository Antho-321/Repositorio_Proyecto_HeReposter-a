<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_VentanaDeRegistro.css" id="estilo">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>REPOSTERIA</title>
</head>
<body>
    <header id="Cabecera">
        <img src="../imagenes/LOGO_PANKEY.png" alt="LOGO_PANKEY" id="LogoPankey">
        <section id="seccion_botones">
            <a href="Index.html">Inicio</a>
            <a href="SobreNosotros.html">Sobre Nosotros</a>
            <div id="Catalogo">
                <input class="Btn_Catalogo" type="button" value="Catalogo" >
                <div>
                    <div class="Menu_Catalogo">
                        <input type="button" value="Bodas">
                        <input type="button" value="Bautizos">
                        <input type="button" value="XV años">
                        <input type="button" value="Cumpleaños">
                        <input type="button" value="Baby Shower">
                        <input type="button" value="San Valentin">
                        <input type="button" value="Visperas de &#10; Santos">
                        <input type="button" value="Navidad">
    
                    </div>
                </div>
                
            </div>
        </section>
        <section id="seccion_iconos">
            <a href="../html/CarritoDeCompras.html">
                <img src="../iconos/carro-de-la-carretilla.png"  type="button" value="Catalogo"><br>
            </a>
                <img src="../iconos/lupa1.png"  type="button" value="Catalogo"><br>
                <input type="button" value="Ingresar" id="btn_ingresar"><br>
        </section>
    </header>
    <div id="Salto"></div>
    <div id="contenido_principal">
        <div id="VentanaDeIngreso">
            <div id="Ventana">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir">
                </div>
                <h2>Registrarse</h2>
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" class="entrada_texto">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" class="entrada_texto">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" class="entrada_texto">
                <label for="dirección">Dirección:</label>
                <input type="text" id="dirección" class="entrada_texto">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" class="entrada_texto">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" class="entrada_texto">
                <label for="rep_contraseña">Repita la contraseña:</label>
                <input type="password" id="rep_contraseña" class="entrada_texto">
                <!--LA FUNCIÓN runQuery está en el archivo script_Registro.js-->
                <!--PARA QUE FUNCIONE BIEN DEBES INICIAR EL MAMP E INGRESAR COMO LOCALHOST-->
                <input type="submit" id="registro" value="Registrarse" onclick="runQuery()">
                <script src="../script/script_Registro.js"></script>
            </div>
        </div>
        <div id="DestacadoPrincipal">
            <img src="../iconos/imagenes.png" alt="imagenes" height="300px" width="300px">
        </div>
        <h1 align="center">Productos destacados</h1>
        <section id="seccion_productos"></section>

    </div>
<footer>
    <div id="Derechos">
        © 2023 Blog Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
    </div>
</footer>
</body>
</html>