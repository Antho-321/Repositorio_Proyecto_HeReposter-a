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
        <section id="Productos">
            <h1>Información sobre porciones</h1>
            <table>
                <tr>
                    <th>Person 1</th>
                    <th>Person 2</th>
                    <th>Person 3</th>
                </tr>
                <tr>
                    <td>Emil</td>
                    <td>Tobias</td>
                    <td>Linus</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>14</td>
                    <td>10</td>
                </tr>
            </table>
        </section>
    </div>

    <footer>
        <div id="Derechos">
            © 2023 Web Personal. Creado por Tito Córdova, De la Cruz Brayan, Luna Anthony
        </div>
    </footer>
    <script src="../script/script_querys.js"></script>
    <script src="../script/script_InteracciónPrincipal.js"></script>
</body>

</html>