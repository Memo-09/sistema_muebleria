<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodificar los datos JSON enviados desde JavaScript
    $jsonDatos = json_decode($_POST['datos'], true);

    // Verificar que los datos sean válidos
    if (!$jsonDatos) {
        echo json_encode(['error' => 'No se recibieron datos válidos']);
        exit;
    }

    // Extraer los datos recibidos
    $venta = $jsonDatos['venta'];
    $id = $jsonDatos['id'];
    $valorSeleccionado2 = $jsonDatos['valorSeleccionado2'];

    // Iniciar la transacción
    try {
        // Preparar la consulta para ejecutar el procedimiento almacenado
        $stmt = $conexion->prepare("CALL registrarProductoVenta(?, ?, 1, ?)");
        $stmt->bind_param('isi', $venta, $id, $valorSeleccionado2);
        $stmt->execute();

        // Verificar si hubo algún mensaje de error
        if ($stmt->errno) {
            throw new Exception($stmt->error);
        }

        // Confirmar la transacción
        $conexion->commit();

        // Responder con el éxito
        echo json_encode([
            'mensaje' => 'Producto agregado correctamente',
            'venta' => $venta,
            'id' => $id,
            'valorSeleccionado2' => $valorSeleccionado2
        ]);
    } catch (Exception $e) {
        // Si ocurre un error, revertir la transacción y capturar el mensaje de error
        $conexion->rollback();
        echo json_encode(['error' => 'Error al registrar el Producto en la Venta: ' . $e->getMessage()]);
    }
} else {
    // Si no es una solicitud POST, responder con un error
    echo json_encode(['error' => 'Método no permitido']);
}

// Cerrar la conexión
$conexion->close();
?>
