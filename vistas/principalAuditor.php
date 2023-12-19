<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Auditoria</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>Auditoria</h3>
    <table>
        <tr>
            <td>
                <form action="../controller/controllerAuditor.php">
                    <input type="hidden" value="listar" name="opcion">
                    <input type="submit" value="Consultar todos los datos">
                </form>
            </td>
            <td>
                <form action="../controller/controllerAuditor.php">
                    <input type="hidden" value="reporte" name="opcion">
                    <input type="submit" value="Consultar reporte">
                </form>
            </td>
        </tr>
    </table>
    <table style="position: relative; left: -200px">
        <thead>
            <tr>
                <th>ID_AUDITORIA</th>
                <th>CEDULA_USUARIO</th>
                <th>FECHA</th>
                <th>HORA</th>
                <th>TABLA_AFECTADA</th>
                <th>OPERACION_REALIZADA</th>
                <th>NOMBRE_USUARIO</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            include_once '../model/Auditor.php';
            //verificamos si existe en sesion el listado de productos:
            if (isset($_SESSION['listado'])) {
                $listado = unserialize($_SESSION['listado']);
                foreach ($listado as $res) {
                    echo "<tr>";
                    echo "<td>" . $res->getID_AUDITORIA() . "</td>";
                    echo "<td>" . $res->getCEDULA_USUARIO() . "</td>";
                    echo "<td>" . $res->getFECHA() . "</td>";
                    echo "<td>" . $res->getHORA() . "</td>";
                    echo "<td>" . $res->getTABLA_AFECTADA() . "</td>";
                    echo "<td>" . $res->getOPERACION_REALIZADA() . "</td>";
                    echo "<td>" . $res->getNOMBRE_USUARIO() . "</td>";
                }
            } else {
                echo "<tr><td colspan=7>No se han cargado datos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>