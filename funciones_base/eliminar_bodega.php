<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió el ID de la bodega
if (!isset($_POST['claveBodega']) || empty($_POST['claveBodega'])) {
    echo json_encode(["success" => false, "message" => "No se recibió la clave de la Bodega."]);
    exit;
}

// Escapar el valor de la clave de la bodega
$claveBodega = $_POST['claveBodega']; // Se mantiene como está para una consulta preparada

// Preparar la consulta para llamar al procedimiento almacenado
$sql = "CALL EliminarCentroOperacionesConProductos(?)";

if ($stmt = $conexion->prepare($sql)) {
    // Vincular el parámetro
    $stmt->bind_param("i", $claveBodega);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Bodega eliminada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar la Bodega: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>
