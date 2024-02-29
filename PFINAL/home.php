<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería Baroja - HOME</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="wrapper">
        <h1> ¿A qué sección deseas acceder?</h1>
        <a href="listausuarios.php" class='button button-primary'>Usuarios</a>
        <a href="listalibros.php" class='button button-primary'>Libros</a>
    </div>
    <a href="logout.php" id="cerrarSesion" class="button button-primary">Cerrar la sesión</a>
</body>
</html>
