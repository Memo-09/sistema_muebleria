<?php
session_start();  // Inicia la sesión

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// El script se detiene aquí, no hay redirección en PHP
?>

