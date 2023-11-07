<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h3>Login básico</h3>
    <form action="controller.php">
        <label>Usuario:</label>
        <input type="text" name="usuario" require>
        <label>Clave:</label>
        <input type="password" name="clave">
        <input type="submit" value="Acceder">
    </form>
</body>
</html>