<?php
//Inicia la sesión y checa si hay un id, lo que indica que ya esta logueado alguien
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}else if(isset($_SESSION['contraseña'])){
    echo '<script>
    window.alert("LOGOUUUUUUUT"); 
    </script>';
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
</head>

<body>
    <header id="Cabecera">
        <input type="checkbox" id="check2">
        <div id="Contenido_Cabecera">
            <img src="../imagenes/LOGO_PANKEY1.png" alt="LOGO_PANKEY" id="LogoPankey">
            <input type="checkbox" id="check">
            <label for="check" class="mostrar_menu">
                &#8801
            </label>
            <div id="botones_iconos">
                <section id="seccion_botones">
                    <a href="Index.php">Inicio</a>
                    <a href="SobreNosotros.php">Sobre Nosotros</a>
                    <div id="Catalogo">
                        <input class="Btn_Catalogo" type="button" value="&nbsp;&nbsp;&nbsp;Catalogo&nbsp;&nbsp;&nbsp;">
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
                    <a href="../html/CarritoDeCompras.php">
                        <img src="../iconos/carro-de-la-carretilla.png" type="button" value="Catalogo">
                    </a>
                    <img onclick="mostrarBúsqueda(this)" src="../iconos/lupa1.png" type="button" value="Catalogo">
                    <div id="seccion_busqueda">
                        <input type="search" id="búsqueda">
                    </div>
                    <?php if (!isset($id)) { ?>
                    <input type="button" value="Ingresar" id="Ingreso" onclick="MostrarVentanaDeIngreso()">
                <?php } else { ?>
                    <button onclick="Logout()" id="Salida" ><a>Salir</button>
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
    <div id="Contenido">
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
            
        <script src="../script/script_Modificación_InteracciónPrincipal.js"></script>
        
        </div>  
    </div>
    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    </div>
</body>

</html>