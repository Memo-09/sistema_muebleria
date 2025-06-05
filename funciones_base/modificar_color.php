<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Obtener los datos enviados a través de POST
$clavecolor = isset($_POST['idColor']) ? intval($_POST['idColor']) : 0; // Asegurar que sea un número
$nombreColor = isset($_POST['descripcionColor']) ? trim($_POST['descripcionColor']) : '';

// Verificar si ambos datos fueron proporcionados
if ($clavecolor > 0 && !empty($nombreColor)) {
    // Llamar al procedimiento almacenado
    $sql = "CALL ActualizarColor(?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param("is", $clavecolor, $nombreColor);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Enviar respuesta exitosa
            echo "Color actualizado correctamente.";
        } else {
            // Enviar error
            echo "Error al actualizar el color: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
} else {
    echo "Por favor, ingrese todos los datos requeridos.";
}

// Cerrar la conexión
$conexion->close();
?>

