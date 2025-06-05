<?php
// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Validar si se recibió el ID del producto
if (!isset($_POST['claveSucursal']) || empty($_POST['claveSucursal'])) {
    echo json_encode(["success" => false, "message" => "No se recibió la clave del producto."]);
    exit;
}

// Escapar el valor de la clave del producto
$claveSucursal = mysqli_real_escape_string($conexion, $_POST['claveSucursal']);

// Consulta para eliminar el producto
$sql = "CALL EliminarCentroOperacionesConProductos($claveSucursal);";

// Ejecutar la consulta
if (mysqli_query($conexion, $sql)) {
    // Comprobar si se eliminó alguna fila
    if (mysqli_affected_rows($conexion) > 0) {
        echo json_encode(["success" => true, "message" => "Sucursal eliminado correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "No se encontró una Sucursal con esa clave."]);
    }
} else {
    // Respuesta de error
    $error = mysqli_error($conexion);
    echo json_encode(["success" => false, "message" => "Error al eliminar el producto: $error"]);
}

// Cerrar la conexión
mysqli_close($conexion);
?>