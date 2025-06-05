<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Obtener los datos enviados a través de POST
$clavesucursal = isset($_POST['claveSucursal']) ? $_POST['claveSucursal'] : '';
$ubicacionsucursal = isset($_POST['ubicacionSucursal']) ? $_POST['ubicacionSucursal'] : '';

// Verificar si ambos datos fueron proporcionados
if ($clavesucursal && $ubicacionsucursal) {
    // Llamar al procedimiento almacenado
    $sql = "CALL ModificarSucursal(?, ?);";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param("is", $clavesucursal, $ubicacionsucursal);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Enviar respuesta exitosa
            echo "Sucursal actualizada correctamente.";
        } else {
            // Enviar error
            echo "Error al actualizar la sucursal: " . $stmt->error;
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