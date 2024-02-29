<?php
session_start();

$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

// Si se ha enviado el formulario de eliminación
if (isset($_POST['eliminar'])) {

    // Consulta de eliminación
    $queryEliminar = "DELETE FROM libros WHERE id = ".$_POST['id']."";

    // Ejecutar la consulta de eliminación
    if (mysqli_query($conn, $queryEliminar)) {
        // Limpiar la variable de sesión después de la eliminación exitosa
        header("Location: listalibros.php");
        exit();
    } else {
        // Si hubo un error, mostrar un mensaje de error
        echo "Error al intentar realizar la eliminación.";
    }
}

// Obtener todos los libros para mostrar la lista
$query2 = "SELECT * FROM libros";
$resultListaLibros = $conn->query($query2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buscar y Lista de Libros</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="wrapper" class="margenes">
        <h1>Buscar y Eliminar Libro por ID</h1>
        <form action="deletelibros.php" method="post" class="login-form">
            <label for="id">ID del Libro: </label><br />
            <input type="text" name="id" /><br /><br />
            <input type="submit" name="eliminar" value="Eliminar" /><br /><br />
        </form>

    </div>

    <div id="wrapper" class="margenes">
        <h1>Lista de Libros</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Fecha Publicación</th>
                    <th>Categoría</th>
                    <th>ISBN</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($libro = $resultListaLibros->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $libro['id']; ?></td>
                        <td><?php echo $libro['titulo']; ?></td>
                        <td><?php echo $libro['autor']; ?></td>
                        <td><?php echo $libro['descripcion']; ?></td>
                        <td><?php echo $libro['precio']; ?></td>
                        <td><?php echo $libro['fecha_publicacion']; ?></td>
                        <td><?php echo $libro['categoria']; ?></td>
                        <td><?php echo $libro['isbn']; ?></td>
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
