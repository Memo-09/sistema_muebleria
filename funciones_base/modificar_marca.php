<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Obtener los datos enviados a través de POST
$clavemarca = isset($_POST['idMarca']) ? $_POST['idMarca'] : '';
$nombremarca = isset($_POST['descripcionMarca']) ? $_POST['descripcionMarca'] : '';

// Verificar si ambos datos fueron proporcionados
if ($clavemarca && $nombremarca) {
    // Llamar al procedimiento almacenado
    $sql = "CALL actualizarMarcaPorId(?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param("is", $clavemarca, $nombremarca);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Enviar respuesta exitosa
            echo "Marca actualizada correctamente.";
        } else {
            // Enviar error
            echo "Error al actualizar la marca: " . $stmt->error;
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
