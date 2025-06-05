<?php
require_once '../conexion.php'; // Asegúrate de incluir tu archivo de conexión

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProveedor = isset($_POST['id_proveedor']) ? intval($_POST['id_proveedor']) : 0;
    $descripcionProveedor = isset($_POST['descripcion_proveedor']) ? trim($_POST['descripcion_proveedor']) : '';

    // Validaciones
    if ($idProveedor <= 0 || empty($descripcionProveedor)) {
        echo json_encode(["success" => false, "message" => "Datos inválidos."]);
        exit;
    }

    // Consulta de actualización
    $sql = "UPDATE proveedores SET DESCRIPCION_PROVEEDOR = ? WHERE ID_PROVEEDOR = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $descripcionProveedor, $idProveedor);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Proveedor actualizado correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar el proveedor."]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>
