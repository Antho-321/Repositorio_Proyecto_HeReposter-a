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
    <link rel="stylesheet" type="text/css" href="../styles/estilo_Modificación_Index.css" id="estilo">
    <title>REPOSTERIA</title>
    <style>
        #Contenido_Cabecera,
        #contenido_principal,
        footer {
            opacity: 0.5;
        }

        #Salto {
            background: #0000007a;
            font-family: Sanseriffic;
            letter-spacing: 1.4px;
            transition: initial;
        }

        #VentanaForm {
            width: 98.3vw;
            display: flex;
            justify-content: center;
            height: 75vh;
            align-items: center;
        }

        #VentanaForm * {
            color: black;
        }

        #Ventana {
            background-color: aliceblue !important;
            width: 550px;
            height: 75vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-radius: 7%;
            z-index: 1;
        }

        .Mensaje {
            height: auto !important;
        }

        .Recuperación {
            height: 58vh !important;
        }

        #Ventana>* {
            background-color: transparent !important;
        }

        label {
            padding: 0px 10px;
        }

        #SinCuenta {
            display: flex;
            align-items: center;
        }

        #ingresar,
        #sin_cuenta {
            padding: 10px;
        }

        .btnHaciaDerecha {
            display: flex;
            width: 100%;
            justify-content: flex-end;
        }

        #Ventana>input,
        #SinCuenta>input,
        .btnHaciaDerecha>input,
        #Ventana>button {
            border: 1px solid;
            border-color: black;
            width: auto;
        }

        #contraseña_olvidada {
            border-color: transparent;
            text-decoration: underline;
        }

        .entrada_texto {
            width: 20vw !important;
            cursor: auto !important;
        }

        #btn_salir {
            border-color: transparent;
            font-size: 30px;
            padding: 0px;
        }

        h3 {
            visibility: hidden;
        }

        .Mensaje p {
            margin: 0px;
            padding: 22px 0px;
        }

        .Mensaje h2 {
            margin: 0px;
            padding: 10px 0px;
        }

        .Recuperación h2 {
            margin: 0px;
        }
        #texto_info{
            padding: 0px 70px;
        }
    </style>
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
                            <div id="Menu_Catalogo">
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
                    <a href="../html/CarritoDeCompras.php">
                        <img src="../iconos/carro-de-la-carretilla.png" type="button" value="Catalogo">
                    </a>
                    <img onclick="mostrarBúsqueda()" src="../iconos/lupa1.png" type="button" value="Catalogo">
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
            <div id="VentanaForm">
                <form id="Ventana" action="../php/Validación de datos.php" method="POST" class="Recuperación">
                    <div class="btnHaciaDerecha">
                        <input type="button" value="✕" id="btn_salir" onclick="CerrarVentana(event)">
                    </div>
                    <h2>REGISTRARSE</h2>
                    <label id="texto_info" for="correo">Ingrese el código enviado a su correo electrónico. Por favor revise la carpeta de correo no deseado si no lo encuentra.</label>
                    <input type="number" id="código" name="comparacion" class="entrada_texto">
                    <button id="finalización_registro">Finalizar registro</button>
                    <div></div>
                </form>
            </div>
        </div>
    </header>

    <div id="contenido_principal">
        <!-- //////////////////////////////////////////PRODUCTOS DESATACADOS/////////////////////////////////////////////// -->
        <div id="DestacadoPrincipal">
            <ul>
                <li><img src="../imagenes/Slider1.jpg" alt=""></li>
                <li><img src="../imagenes/Slider2.jpg" alt=""></li>
                <li><img src="../imagenes/Slider3.jpg" alt=""></li>
                <li><img src="../imagenes/Slider4.jpg" alt=""></li>
            </ul>
        </div>
        <h1>PRODUCTOS DESTACADOS</h1>
        <section id="seccion_productos"></section>
        <script src="../script/script_querys.js"></script>
        <script src="../script/script_InteracciónPrincipal.js"></script>

    </div>

    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    </div>
</body>

</html>