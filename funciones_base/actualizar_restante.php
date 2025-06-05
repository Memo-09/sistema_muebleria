<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Habilitar la visualización de errores para diagnóstico (solo en desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Comprobar si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los valores enviados desde JavaScript
    $claveVenta = $_POST['claveVenta'];
    $total = $_POST['total'];  // Este es el parámetro TOTAL_VENTA
    $restanteContado = $_POST['restanteContado'];  // Este es el parámetro RESTANTE

    // Crear la consulta SQL para actualizar el campo RESTANTE y TOTAL_VENTA en la tabla ventas
    $sql = "UPDATE ventas SET RESTANTE = ?, TOTAL_VENTA = ? WHERE ID_VENTA = ?";

    // Preparar la consulta
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros: 'd' para decimal/double, 'i' para integer
        $stmt->bind_param("ddi", $restanteContado, $total, $claveVenta);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Verificar si la consulta afectó alguna fila
            if ($stmt->affected_rows > 0) {
                // Imprimir "Venta actualizada correctamente"
                echo "Venta actualizada correctamente";
            } else {
                // Si no se encontró la venta o no hubo cambios
                echo "Error";
            }
        } else {
            // Enviar error si la consulta no se ejecuta
            echo "Error";
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        // Enviar error si hay un problema al preparar la consulta
        echo "Error";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no es una solicitud POST, enviar error
    echo "Error";
}
