<?php
require '../conexion.php'; // Asegúrate de que la ruta sea correcta

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar si se recibió el parámetro
    $idProveedor = isset($_POST['claveProveedor']) ? intval($_POST['claveProveedor']) : 0;

    if ($idProveedor <= 0) {
        echo json_encode(["success" => false, "message" => "ID de proveedor no válido."]);
        exit;
    }

    // Consulta para eliminar
    $sql = "DELETE FROM proveedores WHERE ID_PROVEEDOR = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idProveedor);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Proveedor eliminado correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar el proveedor."]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>

