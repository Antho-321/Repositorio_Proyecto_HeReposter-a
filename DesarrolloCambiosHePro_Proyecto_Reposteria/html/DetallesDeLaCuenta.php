<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo_DetallesDeLaCuenta.css" id="estilo">
    <title>REPOSTERIA</title>
</head>
<body>
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
                    <img src="../iconos/lupa1.png" type="button" value="Catalogo">
                    <input type="button" value="Ingresar">
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
        <h1 align="center">Detalles de la cuenta</h1>
        <div id="contenido_principal">
            <section id="seccionIzq">
                <div id="imgUsuario">
                    <img src="../iconos/usuario.png" type="button" value="Catalogo">
                </div>
            </section>
            <section id="seccionDer">
                <div class="tabla_info">
                    <div class="fila">
                        <p class="col">Nombre:</p>
                        <p class="col">Apellido:</p>
                    </div>
                    <div class="fila">
                        <div class="col">
                            <input class="col" type="text" id="mini">
                        </div>
                        <div class="col">
                            <input class="col" type="text" id="pequeña">
                        </div>
                    </div>
                    <div class="fila">
                        <p class="col">Correo electrónico:</p>
                    </div>
                    <div class="fila">
                        <div class="col">
                            <input class="col" type="text" id="mini">
                        </div>
                    </div>
                </div>               
                <div id="cambio_contraseña">
                    <h3>Cambio de contraseña</h3>
                    <label for="contr_actual">Contraseña actual:</label>
                    <input type="text" id="contr_actual">
                    <label for="contr_nueva">Nueva contraseña:</label>
                    <input type="text" id="contr_nueva">
                    <label for="rep_contr_nueva">Confirmar nueva contraseña:</label>
                    <input type="text" id="rep_contr_nueva">
                </div>
            </section>
        </div>
        <div id="btn_guardar">
        <input type="submit" value="Guardar cambios">
    </div>
    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    </div>
</body>
</html>