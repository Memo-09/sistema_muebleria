<?php
ini_set('display_errors', 1);  // Mostrar errores en pantalla
error_reporting(E_ALL);  // Mostrar todos los tipos de errores

include('../conexion.php'); // Asegurar la conexión

// Verificar si los parámetros fueron enviados correctamente
if (!isset($_POST['nombre']) || !isset($_POST['caracteristicas'])) {
    echo 'Faltan parámetros';
    exit;
}

// Sanitizar los datos de entrada
$nombre_juego = mysqli_real_escape_string($conexion, $_POST['nombre']);
$caracteristicas_juego = mysqli_real_escape_string($conexion, $_POST['caracteristicas']);

// Llamar al procedimiento almacenado
$query = "CALL eliminarJuegoYProductos('$nombre_juego', '$caracteristicas_juego');";

if (mysqli_query($conexion, $query)) {
    // Si la ejecución es exitosa, devolver un mensaje claro
    echo 'El juego y sus productos asociados fueron eliminados correctamente.';
} else {
    // Si ocurre un error, devolver un mensaje de error limpio
    echo 'Hubo un error al intentar eliminar el juego y los productos: ' . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>









