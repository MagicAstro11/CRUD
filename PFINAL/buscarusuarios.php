<?php
$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}

// Inicializar variables
$idBuscado = '';
$usuarioEncontrado = false;

// Si el formulario ha sido enviado
if (isset($_POST['buscar'])) {
    // Obtener el ID buscado
    $idBuscado = $_POST['idBuscado'];

    // Consultar si existe un usuario con el ID proporcionado
    $query = "SELECT * FROM usuarios WHERE id = $idBuscado";
    $result = $conn->query($query);

    // Verificar si se encontró un usuario
    if ($result->num_rows > 0) {
        $usuarioEncontrado = true;

        // Almacenar el ID en una variable de sesión
        session_start();
        $_SESSION['idUsuarioEditar'] = $idBuscado;

        // Redireccionar a updateusuarios.php
        header("Location: updateusuarios.php");
        exit();
    }
}

// Obtener todos los usuarios para mostrar la lista
$query2 = "SELECT * FROM usuarios";
$resultListaUsuarios = $conn->query($query2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buscar y Lista de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="wrapper" class="margenes">
        <h1>Buscar Usuario por ID</h1>
        <form action="buscarusuarios.php" method="post" class="login-form">
            <label for="idBuscado">ID del Usuario: </label><br />
            <input type="text" name="idBuscado" value="<?php echo $idBuscado; ?>" /><br /><br />
            <input type="submit" name="buscar" value="Buscar" /><br /><br />
        </form>
    </div>

    <div id="wrapper">
        <h1>Lista de Usuarios</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $resultListaUsuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['contrasena']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <a href="logout.php" id="cerrarSesion" class="button button-primary">Cerrar la sesión</a>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
