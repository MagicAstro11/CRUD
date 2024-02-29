<?php

//si el formulario ha sido enviado procedo a ingresar contenido en la bbdd
if(isset($_POST['enviar']) == 1){

	//conexion a bbdd
	$conn = new mysqli("localhost", "root", "", "LibreriaBaroja");

	//Consulta de insercion. Se reciben los valores de los inputs del formulario enviados por POST
	$query = "INSERT INTO libros (titulo, autor, descripcion, precio, fecha_publicacion, categoria, isbn) VALUES ( '".$_POST['titulo']."', '".$_POST['autor']."', '".$_POST['descripcion']."', '".$_POST['precio']."', '".$_POST['fecha']."', '".$_POST['categoria']."', '".$_POST['isbn']."' )";
	if(mysqli_query($conn, $query)){ 
        // si la consulta se ejecuto con exito muestro mensaje y redirecciono a home.php
		header('Location: listalibros.php');
	}else{ //si hubo error muestro mensaje de error
		echo "ERROR AL INTENTAR REALIZAR EL GUARDADO.";
	}

	//cierro conexion a bbdd
	$conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Insertar Libros</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<h1>Nuevo Libro</h1>
		<form action="createlibros.php" method="post" class="login-form">
			<label for="titulo">Titulo: </label><br />
			<input type="text" name="titulo" /><br /><br />
			<label for="autor">Autor: </label><br />
			<input type="text" name="autor" /><br /><br />
			<label for="descripcion">Descripción: </label><br />
			<input type="text" name="descripcion" /><br /><br />
            <label for="precio">Precio: </label><br />
			<input type="text" name="precio" /><br /><br />
            <label for="fecha">Fecha Publicacion (YYYY-MM-DD): </label><br />
			<input type="text" name="fecha" /><br /><br />
            <label for="categoria">Categoria: </label><br />
			<input type="text" name="categoria" /><br /><br />
            <label for="isbn">ISBN: </label><br />
			<input type="text" name="isbn" /><br /><br />
			<input type="submit" name="guardar" value="Guardar" /><br /><br />
			<a class="button button-primary" href="home.php">Volver</a>
			<input type="hidden" name="enviar" value="1" />
		</form>
		<p id="ejemplo"> EJEMPLO:
		'El Necronomicon', 'H.P. Lovecraft', 'Una recopilación de mitos y relatos de horror cósmico.', 19.99, '1927-07-01', 'Horror', '9788467029331'
		</p>
	</div>
</body>
</html>