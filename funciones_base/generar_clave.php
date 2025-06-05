<?php
// Incluir el archivo de conexión a la base de datos
include('../conexion.php'); // Asegúrate de que la ruta esté correcta

// Consulta para obtener la última clave registrada
$query = "SELECT CLAVE_PRODUCTO FROM productos ORDER BY CAST(CLAVE_PRODUCTO AS UNSIGNED) DESC LIMIT 1;";

// Ejecutar la consulta
$resultado = $conexion->query($query);

// Verificar si hay un resultado
if ($resultado && $resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $ultimoNumero = $row['CLAVE_PRODUCTO']; // Cambia 'ultimo_numero' por 'CLAVE_PRODUCTO'

    // Enviar la clave como respuesta
    echo trim($ultimoNumero); // Trim elimina espacios en blanco innecesarios
} else {
    // Si no hay registros, iniciamos con la clave base
    echo "9500000000001";
}

// Cerrar la conexión
$conexion->close();
?>



