<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por AJAX
    $idVenta = $_POST['idVenta'];
    $claveProducto = $_POST['claveProducto'];
    $almacen = $_POST['almacen'];
    $cantidad = $_POST['cantidad'];

    // Verificar que los datos no estén vacíos
    if (empty($idVenta) || empty($claveProducto) || empty($almacen) || empty($cantidad)) {
        echo json_encode(['success' => false, 'error' => 'Faltan datos para eliminar el producto']);
        exit;
    }

    // Iniciar transacción para asegurar la integridad de los datos
    $conexion->begin_transaction();

    try {
        // Consulta para eliminar el producto de la venta
        $consulta1 = "DELETE FROM ventas_productos WHERE ID_VENTA = ? AND CLAVE_PRODUCTO = ?";
        $stmt1 = $conexion->prepare($consulta1);
        $stmt1->bind_param("is", $idVenta, $claveProducto);

        if (!$stmt1->execute()) {
            throw new Exception("Error al eliminar el producto de la venta: " . $stmt1->error);
        }

        // Consulta para actualizar las existencias en suc_productos
        $consulta2 = "UPDATE suc_productos SET EXISTENCIAS = EXISTENCIAS + ? WHERE ID_CENTRO_OPERACIONES = ? AND CLAVE_PRODUCTO = ?";
        $stmt2 = $conexion->prepare($consulta2);
        $stmt2->bind_param("iis", $cantidad, $almacen, $claveProducto);

        if (!$stmt2->execute()) {
            throw new Exception("Error al actualizar existencias: " . $stmt2->error);
        }

        // Si todo fue exitoso, confirmar la transacción
        $conexion->commit();
        echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente y existencias actualizadas.']);

    } catch (Exception $e) {
        // Si hubo un error, revertir la transacción
        $conexion->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Cerrar las consultas y la conexión
    $stmt1->close();
    $stmt2->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>
