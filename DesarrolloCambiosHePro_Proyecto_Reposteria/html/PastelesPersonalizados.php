<?php
//Inicia la sesión y checa si hay un id, lo que indica que ya esta logueado alguien
session_start();
$Subtotal = 0;
$Iva = 0;
$Total = 0;
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    include("../php/Conexion.php");
    $conexion = new Conexion;
    $aux = $conexion->OperSql("SELECT `Id_Canasta` FROM `canasta` WHERE  `Id_Usuario` = '$id'");
    $aux = $aux->fetch_array();
    $aux = $aux['Id_Canasta'];
    // Configuración de la conexión a la base de datos
    $enlace = "";
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $dbname = "db_pankey";

    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Preparar la consulta SQL
    $sql = "SELECT Subtotal FROM canasta_item WHERE Id_canasta = $aux";

    // Ejecutar la consulta y obtener los resultados
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Defino variables
    $Subtotal = 0;
    $Iva = 0;
    $Total = 0;


    // Iterar a través de los resultados y mostrar la columna "Sutotal"
    foreach ($results as $row) {

        $Subtotal += $row['Subtotal'];
    }
    $Iva = ($Subtotal * 12) / 100;
    $Total = $Subtotal + $Iva;

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../styles/estilo_PastelesPersonalizados.css" id="estilo">
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
                    <a href="#">Pasteles personalizados</a>
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
        </div>
    </header>

    <div id="contenido_principal">
        <h1>Información sobre porciones</h1>
        <section id="Productos">
            <table id="tabla1">
                <tr>
                    <th rowspan="2">Tamaño</th>
                    <th colspan="4" id="txtFormaPastel">Forma de pastel</th>
                </tr>
                <tr>
                    <th>Redonda</th>
                    <th>Personalizada</th>
                    <th>Cuadrada</th>
                    <th>Rectangular</th>
                </tr>
                <tr>
                    <th>Mini</th>
                    <td><img src="https://i.pinimg.com/originals/fc/55/51/fc55511232857377fc9e2b43ff65ef6e.png"
                            width="100px"><br>5-6 personas</td>
                    <td><img src="https://i.pinimg.com/originals/60/2c/73/602c7324f738c3fc2d6328b6b5efa1b3.png"
                            width="60px"><br>2-4 personas</td>
                    <td>No disponible</td>
                    <td>No disponible</td>
                </tr>
                <tr>
                    <th>Pequeña</th>
                    <td><img src="https://i.pinimg.com/originals/ea/1c/c9/ea1cc91b67515479d498b2474a4688b4.png"
                            width="100px"><br>10-12 personas</td>
                    <td><img src="https://i.pinimg.com/originals/84/92/df/8492dfbede442ee7a8d0aca14bc0a7a2.png"
                            width="80px"><br>8-10 personas</td>
                    <td><img src="https://i.pinimg.com/originals/e7/2b/e3/e72be31913b9ed2c9c7aa8a21dba81f4.png"
                            width="100px"><br>20-25 personas</td>
                    <td>No disponible</td>
                </tr>
                <tr>
                    <th>Mediana</th>
                    <td><img src="https://i.pinimg.com/originals/73/af/e3/73afe30c69377ac41d39b1993c2c84d4.png"
                            width="100px"><br>16 personas</td>
                    <td><img src="https://i.pinimg.com/originals/5e/b0/e8/5eb0e8ca1fe278d9febec381995d7341.png"
                            width="100px"><br>12-14 personas</td>
                    <td><img src="https://i.pinimg.com/originals/b8/6f/67/b86f672dc299900a66126a795030eeb5.png"
                            width="100px"><br>35-40 personas</td>
                    <td><img src="https://i.pinimg.com/originals/1a/6c/7e/1a6c7e8648f44f2c5c13d3e1e353683b.png"
                            width="100px"><br>35-40 personas</td>
                </tr>
                <tr>
                    <th>Grande</th>
                    <td><img src="https://i.pinimg.com/originals/79/a6/de/79a6dedb2654bb2b29d7b208bfdba3f2.png"
                            width="100px"><br>30 personas</td>
                    <td><img src="https://i.pinimg.com/originals/b8/06/64/b80664f68242a066c81772711769f24c.png"
                            width="90px"><br>26-28 personas</td>
                    <td><img src="https://i.pinimg.com/originals/f2/95/00/f29500572611ba6d34555f86900324c6.png"
                            width="100px"><br>50 personas</td>
                    <td>No disponible</td>
                </tr>
                <tr>
                    <th>Extra grande</th>
                    <td><img src="https://i.pinimg.com/originals/4f/b0/02/4fb002c596e470f6078f48799cd19d86.png"
                            width="100px"><br>70 personas</td>
                    <td><img src="https://i.pinimg.com/originals/14/14/df/1414df92e327462c56cb2791801c30a5.png"
                            width="100px"><br>66-68 personas</td>
                    <td>No disponible</td>
                    <td><img src="https://i.pinimg.com/originals/51/92/7f/51927fa47127bb921f22df50d180e1e9.png"
                            width="120px"><br>100 personas</td>
                </tr>
            </table>
        </section>
        <form action="" id="form_proPersonalizado">
            <table id="personalizacion">
                <tr>
                    <h3>Previsualización de modelo</h3>
                    <div class="dropzone" id="formDrop">
                        <input type="url" placeholder="Ingresar enlace" id="ingreso_enlace"
                            onclick="quitarPlaceHolder(event)">
                        <input type="hidden" name="enlace" id="aux_IngresarEnlace">
                    </div>
                </tr>
                
            </table>
        </form>
    </div>
    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    <script src="../script/script_querys.js"></script>
    <script src="../script/script_PastelesPersonalizados.js"></script>
</body>

</html>