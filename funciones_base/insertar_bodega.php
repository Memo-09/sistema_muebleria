<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió la bodega
if (!isset($_POST['bodega']) || empty(trim($_POST['bodega']))) {
    echo json_encode(["success" => false, "message" => "El campo Bodega no puede estar vacío."]);
    exit;
}

// Obtener el valor de la bodega
$bodega = trim($_POST['bodega']);

// Preparar la consulta para llamar al procedimiento almacenado
$sql = "CALL insertar_bodega(?, @mensaje)";
if ($stmt = $conexion->prepare($sql)) {
    // Vincular el parámetro
    $stmt->bind_param("s", $bodega);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Recuperar el mensaje devuelto por el procedimiento almacenado
        $resultado = $conexion->query("SELECT @mensaje AS mensaje");
        if ($resultado && $fila = $resultado->fetch_assoc()) {
            echo json_encode(["success" => true, "message" => $fila['mensaje']]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo recuperar el mensaje."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error al insertar la Bodega: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>

