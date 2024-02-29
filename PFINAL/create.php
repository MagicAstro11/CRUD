<?php

//si el formulario ha sido enviado procedo a ingresar contenido en la bbdd
if(isset($_POST['enviar']) == 1){
	$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");
	//conexion a bbdd
    // Obtener valores del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Hashear la contraseña
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta de inserción
    $query = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$hashedPassword')";

    if(mysqli_query($conn, $query)){ 
        // Si la consulta se ejecutó con éxito, redireccionar a la lista de usuarios
        header('Location: listausuarios.php');
    } else { 
        // Si hubo un error, mostrar mensaje de error
        echo "ERROR AL INTENTAR REALIZAR EL GUARDADO.";
    }

	// Cerrar la conexión a la base de datos
	$conn->close();

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Usuarios</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div id="wrapper">
        <h1>Nuevo Usuario</h1>
        <form action="create.php" method="post" class="login-form">
            <label for="nombre">Nombre: </label><br />
            <input type="text" name="nombre" /><br /><br />
            <label for="email">Email: </label><br />
            <input type="text" name="email" /><br /><br />
            <label for="contrasena">Contraseña: </label><br />
            <input type="password" name="contrasena" /><br /><br />
            <input type="submit" name="guardar" value="Guardar" /><br /><br />
            <a class="button button-primary" href="home.php">Volver</a>
            <input type="hidden" name="enviar" value="1" />
        </form>
    </div>
</body>
</html>