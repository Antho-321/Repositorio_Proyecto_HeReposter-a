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
    $user = "anthonyluisluna225";
    $pass = "anthonyluisluna225";
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
    <link rel="stylesheet" type="text/css" href="../styles/estilo_Modificación_CarritoDeCompras.css" id="estilo">
    <link rel="shortcut icon" href="../favicon.ico">
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
                    <a href="index.php">Inicio</a>
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
            <div class="tabla_info">
                <div class="fila" id="primera_fila">
                    <br class="col">
                    <p class="col">Dedicatoria/s</p>
                    <p class="col">Masa</p>
                    <p class="col">Sabor</p>
                    <p class="col">Relleno</p>
                    <p class="col">Cobertura</p>
                    <p class="col">Precio unitario</p>
                    <p class="col">Cantidad</p>
                </div>

            </div>
        </section>
        <section id="Info_adicional">
            <h2>Total</h2>
            <p class="col"><?= $Subtotal ?> $</p>
            <div class="tabla_info">
                <div class="fila">
                    <label class="col" for="fecha_entrega">Fecha de entrega:</label>
                    <div id="entrada_fecha" class="col">
                        <input type="date" id="fecha_entrega" name="fecha_entrega">
                    </div>
                </div>
                <div class="fila">
                    <label class="col" for="time">Hora:</label>
                    <div id="entrada_tiempo" class="col">
                        <input type="time">
                    </div>

                </div>
            </div>
            <div id="botones_carrito">
                <input id="fin_pedido" type="button" value="Finalizar pedido" onclick="añadirBtnPago()">

            </div>

            <p>Nota: Pronto incorporaremos la entrega a
                domicio. Los pedidos que realices puedes
                retirarlos de nuestro local desde las 24h
                transcurridas.<br>
                Dirección: Av. Atahualpa y Tobías Mena, a
                unos pasos del coliseo de la Bola Amarilla
            </p>
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