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
    <link rel="shortcut icon" href="../imagenes/favicon.ico">
    <link href="https://fonts.cdnfonts.com/css/sanseriffic" rel="stylesheet">
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
                    <td><img src="https://i.ibb.co/SKpf5Z2/backgrounderaser-1678723524.png"
                            width="100px"><br>5-6 personas</td>
                    <td><img src="https://i.ibb.co/mSxxxjt/backgrounderaser-1678737045.png"
                            width="60px"><br>2-4 personas</td>
                    <td>No disponible</td>
                    <td>No disponible</td>
                </tr>
                <tr>
                    <th>Pequeña</th>
                    <td><img src="https://i.ibb.co/Zhg10VD/output-onlinepngtools-1.png"
                            width="100px"><br>10-12 personas</td>
                    <td><img src="https://i.ibb.co/F3cW5Xb/backgrounderaser-1678736059-1.png"
                            width="80px"><br>8-10 personas</td>
                    <td><img src="https://i.ibb.co/C5wspwH/backgrounderaser-1678749197-1.png"
                            width="100px"><br>20-25 personas</td>
                    <td>No disponible</td>
                </tr>
                <tr>
                    <th>Mediana</th>
                    <td><img src="https://i.ibb.co/VvG9R3T/backgrounderaser-1678728049-1.png"
                            width="100px"><br>16 personas</td>
                    <td><img src="https://i.ibb.co/9ck0JWJ/backgrounderaser-1678738045-1.png"
                            width="100px"><br>12-14 personas</td>
                    <td><img src="https://i.ibb.co/KySR7pH/backgrounderaser-1678747088.png"
                            width="100px"><br>35-40 personas</td>
                    <td><img src="https://i.ibb.co/FWV1kdZ/backgrounderaser-1678750052-1.png"
                            width="100px"><br>35-40 personas</td>
                </tr>
                <tr>
                    <th>Grande</th>
                    <td><img src="https://i.ibb.co/PFrcpnQ/backgrounderaser-1678729422.png"
                            width="100px"><br>30 personas</td>
                    <td><img src="https://i.ibb.co/7Vj2VBm/backgrounderaser-1678742681-1.png"
                            width="90px"><br>26-28 personas</td>
                    <td><img src="https://i.ibb.co/F7pK5Ch/backgrounderaser-1678747498.png"
                            width="100px"><br>50 personas</td>
                    <td>No disponible</td>
                </tr>
                <tr>
                    <th>Extra grande</th>
                    <td><img src="https://i.ibb.co/WtMtzJC/backgrounderaser-1678731628.png"
                            width="100px"><br>70 personas</td>
                    <td><img src="https://i.ibb.co/Z8HwWfc/backgrounderaser-1678751247-1.png"
                            width="100px"><br>66-68 personas</td>
                    <td>No disponible</td>
                    <td><img src="https://i.ibb.co/fDnW78T/backgrounderaser-1678750417-1.png"
                            width="120px"><br>100 personas</td>
                </tr>
            </table>
        </section>
        <form action="" id="form_proPersonalizado">
            <table id="personalizacion">
                <tbody>
                <tr>
                    <h3>Previsualización de modelo</h3>
                    <div class="dropzone" id="formDrop">
                        <input type="url" placeholder="Ingresar enlace" id="ingreso_enlace"
                            onclick="quitarPlaceHolder(event)">
                        <input type="hidden" name="enlace" id="aux_IngresarEnlace">
                    </div>
                </tr>
                </tbody>
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
    <script src="../script/script_InteracciónPrincipal.js"></script>
</body>

</html>