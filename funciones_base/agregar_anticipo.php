<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por AJAX
    $venta = $_POST['venta'];
    $abonobase = $_POST['abonobase'];
    $restantebase = $_POST['restantebase'];
    $abono = $_POST['abono'];
    $fecha = $_POST['fecha'];
    $restaRestante = $_POST['restaRestante'];
    $sumaabonado = $_POST['sumaabonado'];

    // Validar que no se pueda agregar un abono si el restante ya es 0
    if ($restantebase == 0) {
        echo json_encode(['success' => false, 'error' => 'No se agregará ya que ya completó su venta.']);
        exit;
    }

    // Validar que el abono no sea mayor al restante
    if ($abono > $restantebase) {
        echo json_encode(['success' => false, 'error' => 'El abono no puede ser mayor al monto restante.']);
        exit;
    }

    // Iniciar transacción para asegurar la integridad de los datos
    $conexion->begin_transaction();

    try {
        // Preparar el procedimiento almacenado
        $stmt = $conexion->prepare("CALL InsertarAbonoVenta(?, ?, ?, ?, ?)");

        // Asignar los parámetros
        $stmt->bind_param("isddd", $venta, $fecha, $abono, $sumaabonado, $restaRestante);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si hubo un error en la ejecución
        if ($stmt->errno) {
            throw new Exception("Error al ejecutar el procedimiento: " . $stmt->error);
        }

        // Confirmar la transacción si todo es exitoso
        $conexion->commit();

        // Enviar respuesta de éxito
        echo json_encode(['success' => true, 'message' => 'Anticipo agregado correctamente y valores actualizados']);

    } catch (mysqli_sql_exception $e) {
        // Si hubo un error, revertir la transacción
        $conexion->rollback();

        // Manejar el error específico si el procedimiento almacenado lanza una excepción
        if (strpos($e->getMessage(), 'No se puede registrar el abono en esta fecha') !== false) {
            echo json_encode(['success' => false, 'error' => 'No se puede registrar el abono en esta fecha. Ya existe un registro con la misma fecha e ID de venta.']);
        } else {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // Cerrar la conexión y las consultas
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>









