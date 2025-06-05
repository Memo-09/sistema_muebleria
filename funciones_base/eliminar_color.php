<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió el ID del color
if (!isset($_POST['claveColor']) || empty($_POST['claveColor'])) {
    echo json_encode(["success" => false, "message" => "No se recibió la clave del color."]);
    exit;
}

// Obtener el ID del color
$clavecolor = $_POST['claveColor'];

// Verificar si el color está siendo utilizado en otra tabla (por ejemplo, en productos)
$sqlCheck = "SELECT COUNT(*) FROM productos WHERE ID_COLOR = ?";
$stmtCheck = $conexion->prepare($sqlCheck);

if ($stmtCheck) {
    // Vincular parámetros
    $stmtCheck->bind_param("i", $clavecolor);

    // Ejecutar la consulta
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();

    // Si el color está siendo utilizado, no permitir la eliminación
    if ($count > 0) {
        echo json_encode(["success" => false, "message" => "El color está siendo utilizado en productos. No se puede eliminar."]);
        $stmtCheck->close();
        $conexion->close();
        exit;
    }

    // Cerrar la declaración de verificación
    $stmtCheck->close();
} else {
    echo json_encode(["success" => false, "message" => "Error al verificar si el color está siendo utilizado: " . $conexion->error]);
    $conexion->close();
    exit;
}

// Preparar la consulta SQL para eliminar el color
$sqlDelete = "DELETE FROM colores WHERE ID_COLOR = ?";
$stmtDelete = $conexion->prepare($sqlDelete);

if ($stmtDelete) {
    // Vincular parámetros
    $stmtDelete->bind_param("i", $clavecolor);

    // Ejecutar la consulta
    if ($stmtDelete->execute()) {
        // Verificar si se eliminó alguna fila
        if ($stmtDelete->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Color eliminado correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "No se encontró un color con esa clave."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error al ejecutar la consulta: " . $stmtDelete->error]);
    }

    // Cerrar la declaración
    $stmtDelete->close();
} else {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>


