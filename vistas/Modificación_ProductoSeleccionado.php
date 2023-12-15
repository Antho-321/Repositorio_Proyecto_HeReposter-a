<?php
//Inicia la sesión y checa si hay un id, lo que indica que ya esta logueado alguien
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else if (isset($_SESSION['contraseña'])) {
    header("Location: ../php/Logout.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_Modificación_ProductoSeleccionado.css" id="estilo">
    <title>REPOSTERIA</title>
</head>

<body>
    <input type="checkbox" id="check2">
    <header id="Cabecera">
        <div id="Contenido_Cabecera">
            <img src="../imagenes/LOGO_PANKEY1.png" alt="LOGO_PANKEY" id="LogoPankey">
            <input type="checkbox" id="check">
            <label for="check" class="mostrar_menu">
                &#8801
            </label>
            <div id="botones_iconos">
                <section id="seccion_botones">
                    <a href="index.php">Inicio</a>
                    <a href="SobreNosotros.php">Sobre Nosotros</a>
                    <div id="Catalogo">
                        <input class="Btn_Catalogo" type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Catalogo&nbsp;&nbsp;&nbsp;">
                        <div>
                            <div class="Menu_Catalogo">
                                <input type="button" value="Bodas">
                                <input type="button" value="Bautizos">
                                <input type="button" value="XV años">
                                <input type="button" value="Cumpleaños">
                                <input type="button" value="Baby Shower">
                                <input type="button" value="San Valentin">
                                <input type="button" value="Halloween">
                                <input type="button" value="Navidad">
                            </div>
                        </div>
                    </div>
                </section>
                <section id="seccion_iconos">
                    <a href="../vistas/CarritoDeCompras.php">
                        <img src="../iconos/carro-de-la-carretilla.png" type="button" value="Catalogo">
                    </a>
                    <img onclick="mostrarBúsqueda(this)" src="../iconos/lupa1.png" type="button" value="Catalogo">
                    <div id="seccion_busqueda">
                        <input type="search" id="búsqueda">
                    </div>
                    <?php if (!isset($id)) { ?>
                        <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
                    <?php } else { ?>
                        <button onclick="Logout()" id="Salida"><a>Salir</button>
                    <?php } ?>

                </section>
                <label for="check" class="esconder_menu">
                    &#215
                </label>
            </div>
        </div>
        <div id="Salto">
        </div>
    </header>

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
            <div id="seccion_envio">
                <input type="button" value="Añadir al carrito" onclick="enviarInfoACarrito()">
                <div>
                    <p>Producto ingresado</p>
                </div>
            </div>
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

</body>

</html>