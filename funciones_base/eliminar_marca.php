<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió la clave de la marca
if (!isset($_POST['claveMarca']) || empty($_POST['claveMarca'])) {
    echo json_encode(["success" => false, "message" => "No se recibió la clave de la marca."]);
    exit;
}

$clavemarca = $_POST['claveMarca'];

// Escapar el valor de la clave de la marca
$clavemarca = mysqli_real_escape_string($conexion, $clavemarca);

// Verificar si la marca está siendo utilizada en la tabla productos (o cualquier otra tabla relevante)
$sqlCheck = "SELECT COUNT(*) FROM productos WHERE ID_MARCA = ?";
$stmtCheck = $conexion->prepare($sqlCheck);

if ($stmtCheck) {
    // Vincular parámetros
    $stmtCheck->bind_param("i", $clavemarca);

    // Ejecutar la consulta
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();

    // Si la marca está siendo utilizada, no permitir la eliminación
    if ($count > 0) {
        echo json_encode(["success" => false, "message" => "La marca está siendo utilizada en productos. No se puede eliminar."]);
        $stmtCheck->close();
        $conexion->close();
        exit;
    }

    // Cerrar la declaración de verificación
    $stmtCheck->close();
} else {
    echo json_encode(["success" => false, "message" => "Error al verificar si la marca está siendo utilizada: " . $conexion->error]);
    $conexion->close();
    exit;
}

// Consulta para eliminar la marca utilizando una sentencia preparada
$sqlDelete = "DELETE FROM marcas WHERE ID_MARCA = ?";
if ($stmtDelete = $conexion->prepare($sqlDelete)) {
    // Vincular el parámetro
    $stmtDelete->bind_param("i", $clavemarca);

    // Ejecutar la consulta
    if ($stmtDelete->execute()) {
        // Comprobar si se eliminó alguna fila
        if ($stmtDelete->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Marca eliminada correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "No se encontró una marca con esa clave."]);
        }
    } else {
        // Respuesta de error
        echo json_encode(["success" => false, "message" => "Error al eliminar la marca: " . $stmtDelete->error]);
    }

    $stmtDelete->close();
} else {
    // Error al preparar la consulta
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>

