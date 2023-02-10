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
                <img src="../iconos/usuario.png"  type="button" value="Catalogo"><br>
        </section>
    </header>
    <div id="Salto">
    </div>
    <h1 align="center">Detalles de la cuenta</h1>
    <div id="contenido_principal">       
        <section id="seccionIzq">
            <div id="imgUsuario">
                <img src="../iconos/usuario.png"  type="button" value="Catalogo">
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
                    <p class="col">Dirección de correo electrónico:</p>
                </div>
                <div class="fila">
                    <div class="col">
                        <input class="col" type="text" id="mini">
                    </div>
                </div>
            </div>
            <h3>Datos para una compra:</h3>
            <div class="tabla_info">
                <div class="fila">
                    <p class="col">Información de la tarjeta:</p>
                    <div class="col">
                        <input type="number" id="num_tarjeta" placeholder="1234123412341234">
                        <div>
                            <input type="month" id="fecha_exp">
                            <input type="number" id="csc" placeholder="123">
                        </div>
                        
                    </div>
                </div>
                <div class="fila">
                    <p class="col">Nombre en la tarjeta:</p>
                    <div class="col">
                        <input class="col" type="text" id="mini">
                    </div>
                </div>
            </div>
            <h3>Datos para facturación:</h3>
            <div class="tabla_info">
                <div class="fila">
                    <label class="col" for="nombre">Nombre:</label>
                    <div class="col">
                        <input type="text" id="nombre">                       
                    </div>
                    <label class="col" for="apellidos">Apellidos:</label>
                    <div class="col">
                        <input type="text" id="apellidos">                       
                    </div>
                </div>
                <div class="fila">
                    <label class="col" for="dir1">Línea de dirección 1:</label>
                    <div class="col">
                        <input type="text" id="dir1">                       
                    </div>
                    <label class="col" for="dir2">Línea de dirección 2:</label>
                    <div class="col">
                        <input type="text" id="dir2">                       
                    </div>
                </div>
                <div class="fila">
                    <label class="col" for="cod_postal">Código postal:</label>
                    <div class="col">
                        <input type="number" id="cod_postal">                      
                    </div>
                    <label class="col" for="ciudad">Ciudad:</label>
                    <div class="col">
                        <input type="text" id="ciudad">                       
                    </div>
                </div>
                <div class="fila">
                    <label class="col" for="provincia">Provincia:</label>
                    <div class="col">
                        <input type="text" id="provincia">                      
                    </div>
                    <label class="col" for="ciudad">Teléfono:</label>
                    <div class="col">
                        <input type="tel" id="tel" name="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">                       
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
        © 2023 Blog Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
    </div>
</footer>
</body>
</html>