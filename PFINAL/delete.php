<?php
session_start();

$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}

// Si se ha enviado el formulario de eliminación
if (isset($_POST['eliminar'])) {
    // Obtener el ID almacenado en el formulario
    $idEliminar = $_POST['id'];

    // Consulta de eliminación
    $queryEliminar = "DELETE FROM usuarios WHERE id = $idEliminar";

    // Ejecutar la consulta de eliminación
    if (mysqli_query($conn, $queryEliminar)) {
        // Redireccionar a la lista de usuarios después de la eliminación exitosa
        header("Location: listausuarios.php");
        exit();
    } else {
        // Si hubo un error, mostrar un mensaje de error
        echo "Error al intentar realizar la eliminación.";
    }
}

// Obtener todos los usuarios para mostrar la lista
$query2 = "SELECT * FROM usuarios";
$resultListaUsuarios = $conn->query($query2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buscar y Eliminar Usuario por ID</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="wrapper" class="margenes">
        <h1>Buscar y Eliminar Usuario por ID</h1>
        <form action="delete.php" method="post" class="login-form">
            <label for="id">ID del Usuario: </label><br />
            <input type="text" name="id" /><br /><br />
            <input type="submit" name="eliminar" value="Eliminar" /><br /><br />
        </form>
    </div>

    <div id="wrapper" class="margenes">
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
    
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
