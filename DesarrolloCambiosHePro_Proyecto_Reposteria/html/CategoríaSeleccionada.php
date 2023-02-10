<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_Index.css" id="estilo">
    <title>REPOSTERIA</title>
</head>
<body>
    <header id="Cabecera">
        <img src="../imagenes/LOGO_PANKEY.png" alt="LOGO_PANKEY" id="LogoPankey">
        <section id="seccion_botones">
            <a href="Index.php">Inicio</a>
            <a href="SobreNosotros.php">Sobre Nosotros</a>
            <div id="Catalogo">
                <input class="Btn_Catalogo" type="button" value="Catalogo" >
                <div>
                    <div class="Menu_Catalogo">
                        <input type="button" value="Bodas">
                        <input type="button" value="Bautizos">
                        <input type="button" value="XV años">
                        <input type="button" value="Cumpleaños">
                        <input type="button" value="Baby Shower">
                        <input type="button" value="San Valentin">
                        <input type="button" value="Visperas de &#10; Santos">
                        <input type="button" value="Navidad">
    
                    </div>
                </div>
                
            </div>
        </section>
        <section id="seccion_iconos">
            <a href="../html/CarritoDeCompras.php">
                <img src="../iconos/carro-de-la-carretilla.png"  type="button" value="Catalogo"><br>
            </a>
                <img src="../iconos/lupa1.png"  type="button" value="Catalogo"><br>
                <input type="button" value="Ingresar" id="btn_ingresar"><br>
        </section>
    </header>
    <div id="Salto">
    </div>
    <div id="contenido_principal">
        <h1 align="center">Pasteles de cumpleaños</h1>
        <section id="seccion_productos"></section>
        <script src="../script/script_InteracciónEnMuestraDeProductos.js"></script>
    </div>
<footer>
    <div id="Derechos">
        © 2023 Blog Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
    </div>
</footer>
</body>
</html>