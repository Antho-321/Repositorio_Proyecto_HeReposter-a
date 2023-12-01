<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_2daVentanaDeRegistro.css" id="estilo">
    <title>REPOSTERIA</title>
</head>

<body>
    <header>
        <!-- //////////////////////////////////////////LOGO/////////////////////////////////////////////// -->
        <img src="../imagenes/LOGO_PANKEY1.png" alt="LOGO_PANKEY" id="LogoPankey">
        <!-- //////////////////////////////////////////MENU/////////////////////////////////////////////// -->

        <input type="checkbox" id="check">
        <label for="check" class="mostrar_menu">
            &#8801
        </label>
        <nav class="menu">
            <ul class="menu_horizontal">
                <li> <a href="index.php">Inicio</a></li>
                <li><a href="SobreNosotros.php">Sobre Nosotros</a></li>
                <li>
                    <a href="#"> Catalogo</a>
                    <ul class="Menu_Catalogo">
                        <li><a href="#">Bodas</a></li>
                        <li><a href="#">Bautizos</a></li>
                        <li><a href="#">XV años</a></li>
                        <li><a href="#">Cumpleaños</a></li>
                        <li><a href="#">Baby Shower</a></li>
                        <li><a href="#">San Valentin</a></li>
                        <li><a href="#">Visperas de Santos </a></li>
                        <li><a href="#"> Navidad</a></li>
                    </ul>
                </li>
            </ul>
            <!-- //////////////////////////////////////////ICONOS/////////////////////////////////////////////// -->
            <nav class="iconos">
                <li><a href="../html/CarritoDeCompras.php"><img src="../iconos/carro-de-la-carretilla.png" type="button" value="Catalogo"></a></li>
                <li onclick="mostrarBúsqueda(this)"><a><img src="../iconos/busqueda.png" type="button" value="Catalogo"></a></li>
                <li id="seccion_busqueda"><a><input type="search" id="búsqueda"></a></li>
                <li><a href="#">Ingresar</li>
                <label for="check" class="esconder_menu">
                    &#215
                </label>
            </nav>
        </nav>
    </header>
    <div id="Salto"></div>
    <div id="contenido_principal">
        <div id="VentanaDeIngreso">
            <div id="Ventana">
                <div class="btnHaciaDerecha">
                    <input type="button" value="✕" id="btn_salir">
                </div>
                <h2>RECUPERACIÓN DE CUENTA</h2>
                <label for="correo">Ingrese el código enviado al correo electrónico:</label>
                <input type="number" id="código" class="entrada_texto">
                <input type="button" id="finalización_registro" value="Iniciar sesión">
            </div>
        </div>
        <div id="DestacadoPrincipal">

        </div>
        <h1 align="center">Productos destacados</h1>
        <section id="seccion_productos"></section>
        <script src="../script/script_2daVentanaDeRegistro.js"></script>
    </div>
    <footer>
        <div id="Derechos">
            © 2023 Pagina Web. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
</body>

</html>