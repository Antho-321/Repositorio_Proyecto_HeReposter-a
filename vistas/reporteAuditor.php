<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
    <title>Reporte Auditor</title>
</head>

<body>
    <h3>Reporte</h3>
    <table>
        <tr>
            <td>
                <form action="../controller/controllerAuditor.php">
                    <input type="hidden" value="listar" name="opcion">
                    <input type="submit" value="Consultar todos los datos">
                </form>
            </td>
        </tr>
    </table>

    <form action="../controller/controllerAuditor.php" style="display: flex; flex-direction: row; align-items: center">
        <label for="tabla">Tabla:&NonBreakingSpace;&NonBreakingSpace;</label>
        <select name="nombre_tabla" id="tabla">
            <?php 
            session_start();
            $valores=array("canasta","cliente","comprobante_venta","pedido","producto","roles","usuarios");
            for ($i=0; $i < count($valores); $i++) {
                if (!isset($_SESSION['nombre_tabla'])) {
                    echo '<option value="'.$valores[$i].'">'.$valores[$i].'</option>';          
                }else{
                    
                    if ($valores[$i]==$_SESSION['nombre_tabla']) {
                        echo '<option value="'.$valores[$i].'" selected>'.$valores[$i].'</option>';
                    }
                    else{
                        echo '<option value="'.$valores[$i].'">'.$valores[$i].'</option>';
                    }
                }
            }
            ?>
        </select>
        <label for="tabla">&NonBreakingSpace;&NonBreakingSpace;Acción:&NonBreakingSpace;&NonBreakingSpace;</label>
        <select name="nombre_accion" id="tabla">
        <?php 
            session_start();
            $valores=array("INSERT","UPDATE","CREATE","DELETE");
            for ($i=0; $i < count($valores); $i++) {
                if (!isset($_SESSION['nombre_accion'])) {
                    echo '<option value="'.$valores[$i].'">'.$valores[$i].'</option>';          
                }else{
                    
                    if ($valores[$i]==$_SESSION['nombre_accion']) {
                        echo '<option value="'.$valores[$i].'" selected>'.$valores[$i].'</option>';
                    }
                    else{
                        echo '<option value="'.$valores[$i].'">'.$valores[$i].'</option>';
                    }
                }
            }
            ?>
        </select>
        
                    <input type="hidden" value="reporte" name="opcion">
                    <input type="submit" value="Consultar reporte" style="margin-left: 15px">
        </form>

                

    <table>
        <thead>
        <tr>
                <th>NRO_DE_OPERACIONES</th>
                <th>INDICADOR</th>
                <th>NRO_DE_USUARIOS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            include_once '../model/Reporte.php';
            //verificamos si existe en sesion el listado de productos:
            
            if (isset($_SESSION['reporte'])) {
                $listado = unserialize($_SESSION['reporte']);
                foreach ($listado as $res) {
                    echo "<tr><td>[" . $res->getNRO_DE_INSERCIONES()[3] . "-".$res->getNRO_DE_INSERCIONES()[2] ."]</td><td>Alto</td><td>".$res->getNRO_DE_USUARIOS()[0]."</td></tr>";
                    echo "<tr><td>[" . $res->getNRO_DE_INSERCIONES()[2] . "-".$res->getNRO_DE_INSERCIONES()[1] .")</td><td>Medio</td><td>".$res->getNRO_DE_USUARIOS()[1]."</td></tr>";
                    echo "<tr><td>[" . $res->getNRO_DE_INSERCIONES()[1] . "-".$res->getNRO_DE_INSERCIONES()[0] .")</td><td>Bajo</td><td>".$res->getNRO_DE_USUARIOS()[2]."</td></tr>";
                    // echo "<td>" . $res->getINDICADOR() . "</td>";</td>
                    // echo "<td>" . $res->getNRO_DE_USUARIOS() . "</td>";
                }
            } else {
                echo "<tr><td colspan=3>No se han cargado datos.</td></tr>";
            }
            $dataPoints = array(
                array("label" => "Alto", "y" => $res->getNRO_DE_USUARIOS()[0]),
                array("label" => "Medio", "y" => $res->getNRO_DE_USUARIOS()[1]),
                array("label" => "Bajo", "y" => $res->getNRO_DE_USUARIOS()[2])
            );

            ?>
        </tbody>
    </table>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Frecuencia de operacion"
        },
        data: [{
            type: "pie",
            indexLabel: "{label}: {y}",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    // Render the chart
    chart.render();
});
</script>
</html>