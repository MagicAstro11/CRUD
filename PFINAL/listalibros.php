<?php
session_start();

// Verificar si el usuario ha iniciado sesión

// Conectar a la base de datos y consultar contenido de libros
$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");
$query = "SELECT * FROM libros";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería Baroja - Libros</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="home">
    <div id="wrapper">
        <h1>Lista de Libros</h1>
        <a href="createlibros.php" class='button button-crear'>Nuevo Libro</a>
        <a href="updatelibros.php" class='button button-editar'>Editar Libro</a>
        <a href="deletelibros.php" class='button button-borrar'>Eliminar Libro</a>
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
                <?php while ($libro = $result->fetch_assoc()): ?>
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

    <a href="logout.php" id="cerrarSesion" class="button button-primary">Cerrar la sesión</a>
    <a href="Home.php" id="home" class="button button-primary">Home</a>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
