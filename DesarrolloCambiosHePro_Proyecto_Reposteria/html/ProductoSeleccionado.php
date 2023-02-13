<?php
//Inicia la sesión y checa si hay un id, lo que indica que ya esta logueado alguien
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_ProductoSeleccionado.css" id="estilo">
    <title>REPOSTERIA</title>
</head>
<body>

    <!-- //////////////////////////////////////////////////////////////////////////ENCABEZADO///////////////////////////////////////////////////////////////////////////////////////////// -->

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
                <li><a href="#"><img src="../iconos/carro-de-la-carretilla.png" type="button" value="Catalogo"></a></li>
                <li><a href="#"><img src="../iconos/lupa1.png" type="button" value="Catalogo"></a></li>
                <li><a href="#">Ingresar</li>
                <label for="check" class="esconder_menu">
                    &#215
                </label>
            </nav>
        </nav>
    </header>
    <div id="Salto">
    </div>

    <!-- //////////////////////////////////////////////////////////////////CONTENIDO PRINCIPAL//////////////////////////////////////////////////////////////////////////////////////// -->

    <div id="contenido_principal">
        <div id="DestacadoPrincipal">
            <img src="../iconos/imagenes.png" alt="imagenes">
            <p>$X</p>
            <div id="seccion_cantidad">
                <label for="cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
                <input type="button" id="disminuir_cantidad" value="-">
                <input type="number" id="cantidad" name="cantidad">
                <input type="button" id="aumentar_cantidad" value="+">
            </div>
            <input type="button" value="Añadir al carrito" onclick="enviarInfoACarrito()">
        </div>
        <div id="infoDetallada">
            <p id="infoAdicional">Descripción adicional (en caso de existir)</p>
            <div class="tabla_info">
                <div class="fila">
                    <p class="col">Dedicatoria para el pedido:</p>
                    <input class="col" type="text" value="Feliz Cumpleaños..." onclick="colorTextoANegro()">
                </div>
                <div class="fila">
                    <p class="col">Porciones:</p>
                    <p class="col">X</p>
                </div>
                <div class="fila">
                    <p class="col">Masa:</p>
                    <p class="col">Bizcochuelo</p>
                    <p class="col">Cobertura:</p>
                    <p class="col">Crema</p>
                </div>
                <div class="fila">
                    <p class="col">Sabor:</p>
                    <p class="col">Naranja</p>
                    <p class="col">Relleno:</p>
                    <p class="col">Mermelada de mora</p>
                </div>
            </div>
        </div>
        <script src="../script/script_InteracciónPrincipal.js"></script>
    </div>
    <footer>
        <div id="Derechos">
            © 2023 Blog Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
</body>
</html>