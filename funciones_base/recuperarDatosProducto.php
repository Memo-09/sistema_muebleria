<?php
include('../conexion.php'); // Ya tienes la conexión aquí, no es necesario agregarla nuevamente

// Verificar si los parámetros están disponibles
if (isset($_POST['nombre_producto']) && isset($_POST['caracteristicas_producto'])) {
    $nombre = $_POST['nombre_producto'];
    $caracteristicas = $_POST['caracteristicas_producto'];

    // Preparar la consulta para ejecutar el procedimiento almacenado
    $stmt = $conexion->prepare("CALL obtenerDatosJuegoProducto(?, ?)");
    $stmt->bind_param("ss", $nombre, $caracteristicas);  // "ss" para cadenas (VARCHAR)

    // Ejecutar el procedimiento almacenado
    if ($stmt->execute()) {
        // Obtener el resultado
        $result = $stmt->get_result();

        // Comprobar si hay resultados
        if ($result->num_rows > 0) {
            // Fetch all results as associative array
            $data = $result->fetch_assoc();

            // Responder en formato JSON
            echo json_encode(["success" => true, "data" => $data]);
        } else {
            echo json_encode(["success" => false, "message" => "No se encontraron resultados."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error al ejecutar el procedimiento."]);
    }

    $conexion->close();
} else {
    echo json_encode(["success" => false, "message" => "Parámetros no proporcionados."]);
}
?>
