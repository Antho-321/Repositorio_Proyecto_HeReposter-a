<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <form action="controller.php">
        <div class="mb-3">
            <label for="" class="form-label">Nombres:</label>
            <input type="text" name="nombres" required id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Curso:</label>
            <select name="curso" id="">
                <option value="Java">Java</option>
                <option value="PHP">PHP</option>
                <option value="JavaScript">JavaScript</option>
            </select>
        </div>
        <div class="mb-3">

            <label for="" class="form-label">Nota 1:</label>
            <input type="number" name="nota1" min="0" max="10" required id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nota 2:</label>
            <input type="number" name="nota2" min="0" max="10" required id="">
        </div>
        <input class="btn btn-primary" type="submit" value="Registrar">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>