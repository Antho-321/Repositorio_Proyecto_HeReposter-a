<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h3>Calculadora MVC con PHP</h3>
    <form action="controller.php">
        <label>Ingrese el número 1: </label>
        <input type="number" name="num1" min=0 max=100 require>
        <label>Ingrese el número 2: </label>
        <input type="number" name="num2" min=0 max=100 require>
        <input type="submit" value="Calcular">
    </form>
</body>
</html>