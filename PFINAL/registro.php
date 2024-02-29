<?php
session_start(); // Iniciar sesión

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'LibreriaBaroja');

// Verificar la conexión
if ($conexion->connect_error) {
    die('Error de conexión a la base de datos: ' . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hashear la contraseña

    // Insertar datos en la tabla usuarios
    $query = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";
    $resultado = $conexion->query($query);

    if ($resultado) {
        // Redirigir al usuario a la página de inicio
        header('Location: index.php');
        exit();
    } else {
        // Mostrar un mensaje de error en caso de fallo en la inserción
        echo 'Error al registrarse. Por favor, inténtalo de nuevo.';
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería Baroja - Registro</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <form action="registro.php" method="post" class="login-form"> 
            Nombre: <input type="text" name="nombre" required><br>
            Email: <input type="email" name="email" required><br>
            Contraseña: <input type="password" name="contrasena" required><br>
            <input type="submit" value="Registrarse">
        </form>
    </div>
    </body>
</html>
