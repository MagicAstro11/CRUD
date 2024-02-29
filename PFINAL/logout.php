<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al inicio de sesión u otra página de tu elección
header("Location: index.php");
exit();
?>
