<?php
$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión a la base de datos: ' . $conn->connect_error);
}

// Inicializar variables
$idBuscado = '';
$libroEncontrado = false;

// Si el formulario ha sido enviado
if (isset($_POST['buscar'])) {
    // Obtener el ID buscado
    $idBuscado = $_POST['idBuscado'];

    // Consultar si existe un libro con el ID proporcionado
    $query = "SELECT * FROM libros WHERE id = $idBuscado";
    $result = $conn->query($query);

    // Verificar si se encontró un libro
    if ($result->num_rows > 0) {
        $libroEncontrado = true;

        // Almacenar el ID en una variable de sesión
        session_start();
        $_SESSION['idLibroEditar'] = $idBuscado;

        // Redireccionar a updatelibros2.php
        header("Location: updatelibros2.php");
        exit();
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
        <h1>Buscar Libro por ID</h1>
        <form action="updatelibros.php" method="post" class="login-form">
            <label for="idBuscado">ID del Libro: </label><br />
            <input type="text" name="idBuscado" value="<?php echo $idBuscado; ?>" /><br /><br />
            <input type="submit" name="buscar" value="Buscar" /><br /><br />
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
