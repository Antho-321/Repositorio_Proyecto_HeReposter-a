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
    <link rel="stylesheet" type="text/css" href="../styles/estilo_CarritoDeCompras.css" id="estilo">
    <script src="https://www.paypal.com/sdk/js?client-id=Ae1w7jU4kbRrRCFluXHkxbnTITPA_JXsU-0aSuXq0oSiqkA-IKkxyIeexgvkG5QFbQTa9EhbbJaECvUP&currency=USD"></script>
    <title>REPOSTERIA</title>
</head>
<body>

    <!-- //////////////////////////////////////////////////////////////////////////ENCABEZADO////////////////////////////////////////////////////////////////////////////////////////////// -->

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
                <li onclick="mostrarBúsqueda(this)"><a><img src="../iconos/busqueda.png" type="button" value="Catalogo"></a></li>
                <li id="seccion_busqueda"><a><input type="search" id="búsqueda"></a></li>
                <?php if (!isset($id)) { ?>
                    <li><a id="Ingreso" onclick="MostrarVentanaDeIngreso()">Ingresar</li>
                <?php } else { ?>
                    <li><a id="Salida" onclick="Logout()">Salir</li>
                <?php } ?>
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
        <section id="Productos">
            <div class="tabla_info">
                <div class="fila">
                    <br class="col">
                    <p class="col">Masa</p>
                    <p class="col">Sabor</p>
                    <p class="col">Relleno</p>
                    <p class="col">Cobertura</p>
                    <p class="col">Precio unitario</p>
                    <p class="col">Cantidad</p>
                </div>
                <div class="fila">
                    <div class="col">
                        <img src="../iconos/imagenes.png" alt="Producto">
                    </div>            
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">$X</p>
                        <p class="col">X</p>
                </div>
                <div class="fila">
                    <div class="col">
                        <img src="../iconos/imagenes.png" alt="Producto">
                    </div>            
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">$X</p>
                        <p class="col">X</p>
                </div>
                <div class="fila">
                    <div class="col">
                        <img src="../iconos/imagenes.png" alt="Producto">
                    </div>            
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">X</p>
                        <p class="col">$X</p>
                        <p class="col">X</p>
                </div>
            </div>
        </section>
        <section id="Info_adicional">
            <h2>Total</h2>
            <div class="tabla_info">
                <div class="fila">
                    <p class="col">Subtotal:</p>
                    <p class="col">$Precio</p>
                </div>
                <div class="fila">
                    <p class="col">IVA 12%:</p>
                    <p class="col">$Precio</p>
                </div>
                <div class="fila">
                    <p class="col">Total:</p>
                    <p class="col">$Precio</p>
                </div>
                <div class="fila">
                    <label class="col" for="fecha_entrega">Fecha de entrega:</label>
                    <div id="entrada_fecha">
                        <input class="col" type="date" id="fecha_entrega" name="fecha_entrega">
                    </div>               
                </div>
                <div class="fila">
                    <label class="col" for="time">Hora:</label>
                    <div id="entrada_tiempo">
                        <input class="col" type="time">  
                    </div>  
                             
                </div>
            </div>
            <input id="fin_pedido" type="button" value="Finalizar pedido" onclick="añadirBtnPago()">
            
            <p>Nota: Pronto incorporaremos la entrega a 
                domicio. Los pedidos que realices puedes 
                retirarlos de nuestro local desde las 24h 
                transcurridas.<br>
                Dirección: Av. Atahualpa y Tobías Mena, a 
                unos pasos del coliseo de la Bola Amarilla
                </p>
        </section>
    </div>
    <footer>
        <div id="Derechos">
            © 2023 Blog Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    <script src="../script/script_querys.js"></script>
    <script src="../script/script_InteracciónPrincipal.js"></script>
</body>
</html>