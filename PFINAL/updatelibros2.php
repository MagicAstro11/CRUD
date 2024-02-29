<?php
session_start();

// Verificar si la variable de sesión existe y tiene un valor
if (isset($_SESSION['idLibroEditar']) && !empty($_SESSION['idLibroEditar'])) {
    $idLibroEditar = $_SESSION['idLibroEditar'];

    $conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

    // Verificar la conexión
    if ($conn->connect_error) {
        die('Error de conexión a la base de datos: ' . $conn->connect_error);
    }

    // Si el formulario ha sido enviado
    if (isset($_POST['guardar'])) {
        // Recoger datos del formulario
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $fecha = $_POST['fecha'];
        $categoria = $_POST['categoria'];
        $isbn = $_POST['isbn'];

        // Consulta de actualización
        $query = "UPDATE libros SET titulo='$titulo', autor='$autor', descripcion='$descripcion', precio='$precio', fecha_publicacion='$fecha', categoria='$categoria', isbn='$isbn' WHERE id=$idLibroEditar";

        // Ejecutar la consulta
        if (mysqli_query($conn, $query)) {
            // Si la consulta se ejecutó con éxito, redirigir a la lista de libros
            header('Location: listalibros.php');
            exit();
        } else {
            // Si hubo un error, mostrar un mensaje de error
            echo "Error al intentar realizar la actualización.";
        }
    }

    // Consultar detalles del libro con el ID proporcionado
    $query = "SELECT * FROM libros WHERE id = $idLibroEditar";
    $result = $conn->query($query);

    // Verificar si se encontró el libro
    if ($result->num_rows > 0) {
        $libro = $result->fetch_assoc();
    } else {
        // Redireccionar o mostrar un mensaje de error si no se encuentra el libro
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
    <title>Librería Baroja - Editar Libro</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="wrapper" class="margenes">
        <h1>Editar Libro</h1>
        <form action="updatelibros2.php" method="post" class="login-form">
            <label for="titulo">Titulo: </label><br />
            <input type="text" name="titulo" value="<?php echo $libro['titulo']; ?>" /><br /><br />

            <label for="autor">Autor: </label><br />
            <input type="text" name="autor" value="<?php echo $libro['autor']; ?>" /><br /><br />

            <label for="descripcion">Descripción: </label><br />
            <input type="text" name="descripcion" value="<?php echo $libro['descripcion']; ?>" /><br /><br />

            <label for="precio">Precio: </label><br />
            <input type="text" name="precio" value="<?php echo $libro['precio']; ?>" /><br /><br />

            <label for="fecha">Fecha Publicacion (YYYY-MM-DD): </label><br />
            <input type="text" name="fecha" value="<?php echo $libro['fecha_publicacion']; ?>" /><br /><br />

            <label for="categoria">Categoría: </label><br />
            <input type="text" name="categoria" value="<?php echo $libro['categoria']; ?>" /><br /><br />

            <label for="isbn">ISBN: </label><br />
            <input type="text" name="isbn" value="<?php echo $libro['isbn']; ?>" /><br /><br />

            <input type="submit" name="guardar" value="Guardar Cambios" /><br /><br />
            <a class="button button-primary" href="listalibros.php">Volver</a>
        </form>
    </div>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>