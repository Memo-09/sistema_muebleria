<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió el color
if (!isset($_POST['color']) || empty($_POST['color'])) {
    echo json_encode(["success" => false, "message" => "El campo Color no puede estar vacío."]);
    exit;
}

// Obtener el valor del color
$color = $_POST['color'];

// Preparar la consulta para llamar al procedimiento almacenado
$sql = "CALL insertar_color(?)";

if ($stmt = $conexion->prepare($sql)) {
    // Vincular el parámetro
    $stmt->bind_param("s", $color);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Color insertado correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al insertar el color: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>

