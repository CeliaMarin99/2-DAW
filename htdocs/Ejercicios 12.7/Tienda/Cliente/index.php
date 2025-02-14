<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Buscar por código</h2>
    <form action="peticion.php" method="get">
        Código: <input type="text" name="codigo" required>
        <input type="submit" value="buscar">
    </form>

    <h2>Buscar por nombre</h2>
    <form action="peticion.php" method="get">
       Nombre: <input type="text" name="nombre" required>
        <input type="submit" value="buscar">
    </form>

    <h2>Buscar por rango de precios</h2>
    <form action="peticion.php" method="get">
    Mínimo <input type="number" name="min" required>
    Máximo <input type="number" name="max" required>
        <input type="submit" value="buscar">
    </form>

</body>
</html>

