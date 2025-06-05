<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Obtener los datos enviados a través de POST
$clavebodega = isset($_POST['claveBodega']) ? $_POST['claveBodega'] : '';
$ubicacionbodega = isset($_POST['ubicacionBodega']) ? $_POST['ubicacionBodega'] : '';

// Verificar si ambos datos fueron proporcionados
if ($clavebodega && $ubicacionbodega) {
    // Llamar al procedimiento almacenado
    $sql = "CALL ModificarSucursal(?, ?);";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param("is", $clavebodega, $ubicacionbodega);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Enviar respuesta exitosa
            echo "Bodega actualizada correctamente.";
        } else {
            // Enviar error
            echo "Error al actualizar la Bodega: " . $stmt->error;
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