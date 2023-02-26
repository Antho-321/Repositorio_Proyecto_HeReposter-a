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
$Rep_contraseña = $_POST['Rep_contraseña'];
//Inicia la consulta
$correoExiste= $conexion->OperSql("SELECT  `Email` FROM `usuario` WHERE `Email`='$correo';");
$existe = mysqli_fetch_array($correoExiste);
//Valida y ejecuta
if(isset($existe)){
    echo '<script>
    window.alert("ERROR DE REGISTRO: Correo ya registrado por otro usuario"); 
    window.location = "../html/Index.php";
    </script>';
}else if ($contraseña != $Rep_contraseña) {
    echo '<script>
    window.alert("ERROR DE REGISTRO: Las contraseñas no coinciden"); 
    window.location = "../html/Index.php";
    </script>';
} else {
    $para = $correo;
    $asunto = "Codigo: " . $random;
    $cuerpo = "TEST<html>Su código por favor si</html>";
    $salida = shell_exec('node ULTIMO_TEST.js "' . $para . '" "' . $asunto . '" "' . $cuerpo . '"');
    session_start();
    //$_SESSION['cedula'] = $cedula;
    //$_SESSION['nombre'] = $nombre;
    //$_SESSION['apellido'] = $apellido;
    //$_SESSION['direccion'] = $direccion;
    $_SESSION['correo'] = $correo;
    $_SESSION['contraseña'] = $contraseña;
    $_SESSION['random'] = $random;
}
?> 
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
                <li> <a href="../html/Index.php">Inicio</a></li>
                <li><a href="../html/SobreNosotros.php">Sobre Nosotros</a></li>
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
                    <input type="button" value="✕" id="btn_salir" onclick="irAIndex()">
                </div>
                <form action="../php/Validación de datos.php" method="POST" id="Ventana">
                    <h2>REGISTRARSE</h2>
                    <label for="correo">Ingrese el código enviado al correo electrónico:</label>
                    <input type="number" id="código" name="comparacion" class="entrada_texto">
                    <button id="finalización_registro">Finalizar registro</button>
                </form>
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