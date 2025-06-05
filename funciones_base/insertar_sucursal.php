<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió la sucursal
if (!isset($_POST['sucursal']) || empty($_POST['sucursal'])) {
    echo json_encode(["success" => false, "message" => "El campo Sucursal no puede estar vacío."]);
    exit;
}

// Obtener el valor de la sucursal
$sucursal = $_POST['sucursal'];

// Preparar la consulta para llamar al procedimiento almacenado
$sql = "CALL InsertarSucursal(?)";

if ($stmt = $conexion->prepare($sql)) {
    // Vincular el parámetro
    $stmt->bind_param("s", $sucursal);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Sucursal insertada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al insertar la sucursal: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>
