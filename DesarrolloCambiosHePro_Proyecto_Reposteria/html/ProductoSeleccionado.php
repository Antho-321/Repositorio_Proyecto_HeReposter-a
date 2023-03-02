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
    <!-- ///////////////////////////////////////////////////////////////////////////ENCABEZADO///////////////////////////////////////////////////////////////////////////////////////////// -->
    <header>
        <!-- //////////////////////////////////////////LOGO/////////////////////////////////////////////// -->
        <img src="../imagenes/LOGO_PANKEY1.png" alt="LOGO_PANKEY" id="LogoPankey">
        <!-- //////////////////////////////////////////MENU/////////////////////////////////////////////// -->
        <input type="checkbox" id="check">
        <label for="check" class="mostrar_menu">
            ≡
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
                        <li><a href="#">Halloween </a></li>
                        <li><a href="#">Navidad</a></li>
                    </ul>
                </li>
            </ul>
            <!-- //////////////////////////////////////////ICONOS/////////////////////////////////////////////// -->
            <nav class="iconos">
                <li><a href="../html/CarritoDeCompras.php"><img src="../iconos/carro-de-la-carretilla.png" type="button" value="Catalogo"></a></li>
                <li onclick="mostrarBúsqueda(this)"><a><img src="../iconos/lupa1.png" type="button" value="Catalogo"></a></li>
                <li id="seccion_busqueda" style="display: none;"><a><input type="search" id="búsqueda"></a></li>
                <li><a id="Ingreso" onclick="MostrarVentanaDeIngreso()">Ingresar</a></li><a id="Ingreso" onclick="MostrarVentanaDeIngreso()">
                    <label for="check" class="esconder_menu">
                        ×
                    </label>
                </a>
            </nav><a id="Ingreso" onclick="MostrarVentanaDeIngreso()">
            </a>
        </nav><a id="Ingreso" onclick="MostrarVentanaDeIngreso()">
        </a>
    </header><a id="Ingreso">
        <div id="Salto">
        </div>
        <!-- ///////////////////////////////////////////////////////////////////CONTENIDO PRINCIPAL//////////////////////////////////////////////////////////////////////////////////////// -->
        <div id="contenido_principal">
            <div id="DestacadoPrincipal">
                <img src="https://th.bing.com/th/id/R.b042dade06440a9cf8c236b81ad2c4d8?rik=8ynKhjpIzp3%2bmA&amp;pid=ImgRaw&amp;r=0" alt="imagenes">
                <p>$12</p>
                <div id="seccion_cantidad">
                    <label for="cantidad">Cantidad:&nbsp;&nbsp;&nbsp;</label>
                    <input type="button" id="disminuir_cantidad" value="-" onclick="disminuirCantidadProducto()">
                    <input type="number" id="cantidad" name="cantidad" value="1" readonly="">
                    <input type="button" id="aumentar_cantidad" value="+" onclick="aumentarCantidadProducto()">
                </div>
                <input type="button" value="Añadir al carrito" onclick="enviarInfoACarrito()">
                
            </div>
            <div id="infoDetallada">

                <div class="tabla_info">
                    <div class="fila">
                        <p class="col">Dedicatoria para el pedido:</p>
                        <input class="col" type="text" value="Feliz Cumpleaños..." id="dedicatoria">
                    </div>
                    <div class="fila">
                        <p class="col">Porciones:</p>
                        <p class="col">16</p>
                    </div>
                    <div class="fila">
                        <p class="col">Masa:</p>
                        <p class="col">Normal (Con receta propia)</p>
                        <p class="col">Cobertura:</p>
                        <p class="col">Crema</p>
                    </div>
                    <div class="fila">
                        <p class="col">Sabor:</p>
                        <p class="col">Naranja</p>
                        <p class="col">Relleno:</p>
                        <p class="col">Mermelada de frutilla</p>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div id="Derechos">
                © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
            </div>
        </footer>

    </a>
</body>

</html>