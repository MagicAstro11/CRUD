<?php
session_start();

// Verificar si la variable de sesión existe y tiene un valor
if (isset($_SESSION['idUsuarioEditar']) && !empty($_SESSION['idUsuarioEditar'])) {
    $idUsuarioEditar = $_SESSION['idUsuarioEditar'];

    $conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

    // Verificar la conexión
    if ($conn->connect_error) {
        die('Error de conexión a la base de datos: ' . $conn->connect_error);
    }

    // Si el formulario ha sido enviado
    if (isset($_POST['guardar'])) {
        // Recoger datos del formulario
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hashear la contraseña

        // Consulta de actualización
        $query = "UPDATE usuarios SET nombre='$nombre', email='$email', contrasena='$contrasena' WHERE id=$idUsuarioEditar";

        // Ejecutar la consulta
        if (mysqli_query($conn, $query)) {
            // Si la consulta se ejecutó con éxito, redirigir a la lista de usuarios
            header('Location: listausuarios.php');
            exit();
        } else {
            // Si hubo un error, mostrar un mensaje de error
            echo "Error al intentar realizar la actualización.";
        }
    }

    // Consultar detalles del usuario con el ID proporcionado
    $query = "SELECT * FROM usuarios WHERE id = $idUsuarioEditar";
    $result = $conn->query($query);

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        // Redireccionar o mostrar un mensaje de error si no se encuentra el usuario
        header("Location: home.php");
        exit();
    }
} else {
    // Si no existe la variable de sesión, redirigir a home.php
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería Baroja - Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="wrapper" class="margenes">
        <h1>Editar Usuario</h1>
        <form action="updateusuarios.php" method="post" class="login-form">
            <label for="nombre">Nombre: </label><br />
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" /><br /><br />

            <label for="email">Email: </label><br />
            <input type="text" name="email" value="<?php echo $usuario['email']; ?>" /><br /><br />

            <label for="contrasena">Contraseña: </label><br />
            <input type="password" name="contrasena" /><br /><br />

            <input type="submit" name="guardar" value="Guardar Cambios" /><br /><br />
            <a class="button button-primary" href="listausuarios.php">Volver</a>
        </form>
    </div>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
