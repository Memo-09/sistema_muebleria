<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por AJAX
    $venta = isset($_POST['venta']) ? $_POST['venta'] : null;
    $credito = isset($_POST['credito']) ? $_POST['credito'] : null;
    $credicontado = isset($_POST['credicontado']) ? $_POST['credicontado'] : null;
    $contado = isset($_POST['contado']) ? $_POST['contado'] : null;
    $abonado = isset($_POST['enganche']) ? $_POST['enganche'] : null;
    $pagoMin = isset($_POST['pagominimo']) ? $_POST['pagominimo'] : null;
    $pagoMax = isset($_POST['pagomaximo']) ? $_POST['pagomaximo'] : null;
    $enganche = isset($_POST['enganche1']) ? $_POST['enganche1'] : null;

    // Validar que los datos no estén vacíos
    if (empty($venta) || empty($credito) || empty($credicontado) || empty($contado) || empty($abonado) || empty($pagoMin) || empty($pagoMax) || empty($enganche)) {
        echo json_encode(['success' => false, 'error' => 'Faltan datos para actualizar los precios']);
        exit;
    }

    // Iniciar transacción para asegurar la integridad de los datos
    $conexion->begin_transaction();

    try {
        // Llamar al procedimiento almacenado con 9 parámetros
        $consulta = "CALL actualizarPreciosVenta(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($consulta);
        
        // Asegúrate de pasar 9 parámetros correctamente
        $stmt->bind_param("ddddddddd", $venta, $credito, $credicontado, $contado, $abonado, $pagoMin, $pagoMax, $credito, $enganche);

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar el procedimiento almacenado: " . $stmt->error);
        }

        // Confirmar la transacción
        $conexion->commit();
        echo json_encode(['success' => true, 'message' => 'Precios actualizados correctamente.']);

    } catch (Exception $e) {
        // Si hubo un error, revertir la transacción
        $conexion->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Cerrar la consulta y la conexión
    if ($stmt) {
        $stmt->close();
    }
    $conexion->close();
} else {
    // Si la solicitud no es POST, devolver error
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>

