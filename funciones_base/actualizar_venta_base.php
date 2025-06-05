<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por POST
    $id_venta = $_POST['id_venta'] ?? null;
    $pago_minomo = $_POST['pago_minomo'] ?? null;
    $pago_max = $_POST['pago_max'] ?? null;
    $descripcion_dia = $_POST['descripcion_dia'] ?? null;
    $descripcion_tipopago = $_POST['descripcion_tipopago'] ?? null;

    // Validar que los valores obligatorios no estén vacíos
    if (!$id_venta || !$pago_minomo || !$pago_max || !$descripcion_dia || !$descripcion_tipopago) {
        echo json_encode(['success' => false, 'error' => 'Faltan datos para actualizar la venta.']);
        exit;
    }

    try {
        // Preparar la consulta para ejecutar el procedimiento almacenado
        $stmt = $conexion->prepare("CALL ActualizarVentaPago(?, ?, ?, ?, ?)");
        $stmt->bind_param("iddss", $id_venta, $pago_minomo, $pago_max, $descripcion_dia, $descripcion_tipopago);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Venta actualizada correctamente.']);
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        // Cerrar la consulta
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}
?>
