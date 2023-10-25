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
    <link rel="stylesheet" type="text/css" href="../styles/estilo_Modificación_SobreNosotros.css" id="estilo">
    <link rel="shortcut icon" href="../imagenes/favicon.ico">
    <title>Pankey</title>
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
                    <a href="Index.php">Inicio</a>
                    <a href="SobreNosotros.php">Sobre nosotros</a>
                    <div id="Catalogo">
                        <input class="Btn_Catalogo" type="button" value="Catalogo">
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
                    <a href="PastelesPersonalizados.php">Pasteles personalizados</a>
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
            <img src="https://rochinae.files.wordpress.com/2016/02/panadero.jpg?w=776" alt="imagenes">
        </div>
        <div id="texto">
            <h1>Nuestra historia</h1>
            <p>La pastelería "Pankey" fue fundada hace más de 30 años por los hermanos Genny y Carlos, quienes aprendieron las técnicas de su padre en la panadería. Genny se quedó con la pastelería cuando los hermanos decidieron separarse, y conoció a Luis en un curso de Levapan. Luis compró el horno de Carlos y comenzó a trabajar en la pastelería con Genny. Luego de algunos años, se casaron y llevaron la pastelería de vuelta a Azaya. Para expandirse y llegar a más clientes, abrieron una sucursal cerca del terreno que había heredado Genny, lo que les permitió crear nuevos productos ajustados a las necesidades y gustos de la comunidad.</p>
        </div>
    </div>

    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    </div>
</body>
<script src="../script/script_querys.js"></script>
<script src="../script/script_InteracciónPrincipal.js"></script>

</html>