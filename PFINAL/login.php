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
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Obtener la información del usuario desde la base de datos
    $query = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // La contraseña es correcta, redirigir al usuario a la página principal
            $_SESSION["id"] = $usuario['id'];
            header('Location: home.php');
            exit();
        } else {
            // La contraseña es incorrecta, mostrar un mensaje de error
            echo 'Contraseña incorrecta';
        }
    } else {
        // Usuario no encontrado, mostrar un mensaje de error
        echo 'Usuario no encontrado';
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería Baroja - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post" class="login-form">
            Correo: <input type="text" name="email" required><br>
            Contraseña: <input type="password" name="contrasena" required><br>
            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
