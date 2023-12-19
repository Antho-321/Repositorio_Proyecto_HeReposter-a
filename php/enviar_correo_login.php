<?php
include("../php/Conexion.php");
$conexion = new Conexion;
$random = rand(10000, 100000);
//Parte de registro
//Todo lo que envía el post a este lugar

//$cedula = $_POST['Cedula'];
//$nombre = $_POST['Nombre'];
//$apellido = $_POST['Apellido'];
//$direccion = $_POST['Direccion'];
$correo = $_POST['Correo'];
$contraseña = $_POST['Contraseña'];
//Inicia la consulta
$correoExiste = $conexion->OperSql("SELECT  `Email` FROM `cliente` WHERE `Email`='$correo';");
$existe = mysqli_fetch_array($correoExiste);
//Valida y ejecuta
if (isset($existe)) {
    $consulta_contraseña = $conexion->OperSql("SELECT PASSWORD FROM `cliente` WHERE `Email`='$correo';");
    $array_consulta_contraseña = $consulta_contraseña->fetch_array();
    $contraseña_registrada = $array_consulta_contraseña['PASSWORD'];
    if (!password_verify($contraseña, $contraseña_registrada)) {
        echo '<script>
        console.log('.password_verify($contraseña, $contraseña_registrada).');
        </script>';
    } else {
        $para = $correo;
        $asunto = "Código de verificación";
        $cuerpo = "Verificación de dispositivo";
        $texto1 = "Código de verificación de ingreso en Pankey";
        $texto2 = "Hemos recibido una solicitud de ingreso en nuestro sitio web de pastelería utilizando tu dirección de correo electrónico. Tu código de verificación de ingreso es:";
        $texto3 = "Si no has solicitado este código, puede que alguien esté intentando ingresar en nuestro sitio web utilizando tu dirección de correo electrónico. No compartas este correo electrónico ni des el código a nadie. Has recibido este mensaje porque esta dirección de correo electrónico figura como dirección de contacto en la solicitud de ingreso en nuestro sitio web. Si crees que esto es un error, por favor ignora este mensaje o ponte en contacto con nosotros para solucionarlo. Gracias por elegir nuestro sitio web de pastelería.";
        $salida = shell_exec('node ../script/envio_correo.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '" "' . $texto1 . '" "' . $texto2 . '" "' . $texto3 . '" "' . $random . '"');
        session_start();
        //$_SESSION['cedula'] = $cedula;
        //$_SESSION['nombre'] = $nombre;
        //$_SESSION['apellido'] = $apellido;
        //$_SESSION['direccion'] = $direccion;
        $_SESSION['correo'] = $correo;
        $_SESSION['contraseña'] = $contraseña;
        $_SESSION['random'] = $random;
    }
} else {
    echo '<script>
    window.alert("ERROR DE INGRESO: Correo no registrado"); 
    window.location = "../vistas/Index.php";
    </script>';
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

        #texto_info {
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
                    <a href="../vistas/Index.php">Inicio</a>
                    <a href="../vistas/SobreNosotros.php">Sobre Nosotros</a>
                    <div id="Catalogo">
                        <input class="Btn_Catalogo" type="button"
                            value="&nbsp;&nbsp;&nbsp;&nbsp;Catalogo&nbsp;&nbsp;&nbsp;">
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
                    <a href="../vistas/CarritoDeCompras.php">
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
                <form id="Ventana" action="../php/Login.php" method="POST" class="Recuperación">
                    <div class="btnHaciaDerecha">
                        <input type="button" value="✕" id="btn_salir" onclick="irAIndex()">
                    </div>
                    <h2>INGRESAR</h2>
                    <label id="texto_info" for="correo">Ingrese el código enviado a su correo electrónico. Por favor
                        revise la carpeta de correo no deseado si no lo encuentra.</label>
                    <input type="number" id="código" name="comparacion" class="entrada_texto">
                    <button id="finalización_registro">Ingresar</button>
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