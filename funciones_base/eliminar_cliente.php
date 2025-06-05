<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió el ID del cliente
if (!isset($_POST['idCliente']) || empty($_POST['idCliente'])) {
    echo json_encode(["success" => false, "message" => "No se recibió el ID del cliente."]);
    exit;
}

// Escapar el valor del ID del cliente
$idCliente = mysqli_real_escape_string($conexion, $_POST['idCliente']);

// Iniciar transacción
mysqli_begin_transaction($conexion);

try {
    // Llamar al procedimiento almacenado para eliminar el cliente
    $sql = "CALL eliminar_cliente($idCliente)";
    if (mysqli_query($conexion, $sql)) {
        // Si se ejecuta correctamente, verificar si realmente se eliminó un cliente
        if (mysqli_affected_rows($conexion) > 0) {
            echo json_encode(["success" => true, "message" => "Cliente eliminado correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "No se encontró un Cliente con ese ID."]);
        }
    } else {
        throw new Exception(mysqli_error($conexion)); // Capturar error SQL
    }

    // Confirmar la transacción
    mysqli_commit($conexion);
} catch (Exception $e) {
    // Revertir transacción en caso de error
    mysqli_rollback($conexion);

    // Verificar si es un error del procedimiento almacenado
    $errorMessage = $e->getMessage();
    if (strpos($errorMessage, 'No se puede eliminar el cliente porque tiene ventas registradas') !== false) {
        echo json_encode(["success" => false, "message" => "No se puede eliminar el cliente porque tiene Ventas Pendientes."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar el cliente: $errorMessage"]);
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>


