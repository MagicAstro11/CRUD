<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("location: index.php");
}

// Conectar a la base de datos y consultar contenido de libros
$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

$query = "SELECT * FROM usuarios";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería Baroja - Usuarios</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="home">

    <div id="wrapper">
        <h1>Lista de Usuarios</h1>
        <a href="create.php" class='button button-crear'>Nuevo Usuario</a>
        <a href="buscarusuarios.php" class='button button-editar'>Editar Usuario</a>
        <a href="delete.php" class='button button-borrar'>Eliminar Usuario</a>
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
                <?php while ($usuario = $result->fetch_assoc()): ?>
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
    <a href="Home.php" id="home" class="button button-primary">Home</a>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
