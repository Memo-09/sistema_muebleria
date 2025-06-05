<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['claveVenta'])) {
    $claveVenta = intval($_POST['claveVenta']);

    // Verificar que el ID sea válido
    if ($claveVenta <= 0) {
        echo json_encode(["success" => false, "message" => "ID de venta no válido."]);
        exit;
    }

    try {
        // Preparar la llamada al procedimiento almacenado
        $stmt = $conexion->prepare("CALL EliminarVenta(?)");
        $stmt->bind_param("i", $claveVenta);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Venta eliminada correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al eliminar la venta."]);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Solicitud no válida."]);
}
?>
