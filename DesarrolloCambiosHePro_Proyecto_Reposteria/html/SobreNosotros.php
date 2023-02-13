<?php
//Inicia la sesión y checa si hay un id, lo que indica que ya esta logueado alguien
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}else if(isset($_SESSION['contraseña'])){
    header("Location: ../php/Logout.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_SobreNosotros.css" id="estilo">
    <title>REPOSTERIA</title>
</head>
<body>
    <header>

        <!-- //////////////////////////////////////////LOGO/////////////////////////////////////////////// -->

        <img src="../imagenes/LOGO_PANKEY.png" alt="LOGO_PANKEY" id="LogoPankey">

        <!-- //////////////////////////////////////////MENU/////////////////////////////////////////////// -->
        
        <input type="checkbox" id="check">
        <label for="check" class="mostrar_menu">
            &#8801
        </label>
        <nav class="menu">
            <ul class="menu_horizontal">
                <li> <a href="Index.php">Inicio</a></li>
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
                <li onclick="mostrarBúsqueda(this)"><a><img src="../iconos/lupa1.png" type="button" value="Catalogo"></a></li>
                <li id="seccion_busqueda"><a><input type="search" id="búsqueda"></a></li>
                <?php if (!isset($id)) { ?>
                    <li><a id="Ingreso" onclick="MostrarVentanaDeIngreso()">Ingresar</li>
                <?php } else { ?>
                    <button onclick="Logout()" id="Salida" ><a>Salir</button>
                <?php } ?>
                <label for="check" class="esconder_menu">
                    &#215
                </label>
            </nav>
        </nav>
    </header>
    <div id="Salto">
    </div>
    <div id="contenido_principal">
        <div id="DestacadoPrincipal">
            <img src="../iconos/imagenes.png" alt="imagenes">
        </div>
        <div id="texto">
            <h1>Título</h1>
            <p>Contenido</p>
        </div>
    </div> 
<footer>
    <div id="Derechos">
        © 2023 Blog Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
    </div>
</footer>
</body>
<script src="../script/script_querys.js"></script>
<script src="../script/script_InteracciónPrincipal.js"></script>
</html>