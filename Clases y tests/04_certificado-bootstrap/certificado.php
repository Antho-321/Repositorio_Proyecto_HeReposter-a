<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h3>Certificado</h3>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Universidad Técnica del Norte
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Por haber:
                    <?php
                    //iniciar sesion
                    session_start();
                    echo $_SESSION['resultado'][0];
                    ?>
                </li>
                <li class="list-group-item">
                    Nombre:
                    <?php
                    echo $_SESSION['resultado'][1];
                    ?>
                </li>
                <li class="list-group-item">
                    Curso:
                    <?php
                    echo $_SESSION['resultado'][2];
                    ?>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>