<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por AJAX
    $fechaBono = $_POST['fecha'];  // Cambiar el nombre de fechaBono a fecha
    $claveVenta = $_POST['claveVenta'];  // Cambiar idVenta a claveVenta
    $totalAbonado = $_POST['totalAbonado'];  // Cambiar abonado a totalAbonado
    $restante = $_POST['restante'];

    // Validar que los datos no estén vacíos
    if (empty($claveVenta) || empty($fechaBono) || empty($totalAbonado) || empty($restante)) {
        echo json_encode(['success' => false, 'error' => 'Faltan datos para actualizar el anticipo']);
        exit;
    }

    // Preparar la consulta para ejecutar el procedimiento almacenado
    try {
        // Asegúrate de que el procedimiento almacenado está recibiendo los datos correctos
        $stmt = $conexion->prepare("CALL EliminarAbonoVenta(?, ?, ?, ?)");
        $stmt->bind_param("isdd", $claveVenta, $fechaBono, $totalAbonado, $restante);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Anticipo actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al ejecutar la consulta: ' . $stmt->error]);
        }

        // Cerrar la conexión
        $stmt->close();
        $conexion->close();
    } catch (Exception $e) {
        // Capturar cualquier error y devolver un mensaje adecuado
        echo json_encode(['success' => false, 'error' => 'Error en la ejecución del procedimiento: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>


