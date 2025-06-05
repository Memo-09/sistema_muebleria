<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Asegurar que la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

// Obtener los datos del formulario
$juego = isset($_POST['idJuego']) ? trim($_POST['idJuego']) : null;
$existencias = isset($_POST['existencias']) ? trim($_POST['existencias']) : null;

// Validaciones básicas
if (!$juego || !$existencias || !is_numeric($existencias) || (int)$existencias < 0) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
    exit;
}

$conexion->begin_transaction(); // Iniciar transacción

try {
    // Preparar la consulta llamando al procedimiento almacenado
    $consulta = "CALL ActualizarExistencias(?, ?)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("si", $juego, $existencias);

    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar el procedimiento almacenado: " . $stmt->error);
    }

    $conexion->commit(); // Confirmar la transacción

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Cantidad actualizada correctamente']);

} catch (Exception $e) {
    $conexion->rollback(); // Revertir la transacción en caso de error
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// Cerrar conexiones
$stmt->close();
$conexion->close();
?>
