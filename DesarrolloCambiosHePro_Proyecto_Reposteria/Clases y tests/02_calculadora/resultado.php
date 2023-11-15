<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h3>Resultados del cálculo</h3>
    <?php
        session_start();
        $suma=$_SESSION['suma']; //array con índices no numéricos
        $resta=$_SESSION['resta'];
    ?>
    <table>
        <thead>
            <th>Operación</th>
            <th>Resultado</th>
        </thead>
        <tbody>
            <tr><td>Suma</td><td><?php echo $suma; ?></td></tr>
            <tr><td>Resta</td><td><?php echo $resta; ?></td></tr>
        </tbody>
    </table>
</body>
</html>