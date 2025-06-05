<?php
header('Content-Type: application/json');

// Incluir el archivo de conexión
require("../conexion.php");

// Verificar si se recibió el ID de la sucursal
if (isset($_POST['id_sucursal'])) {
    $id_sucursal = intval($_POST['id_sucursal']);

    // Consulta para contar los productos asociados
    $query = "SELECT COUNT(*) AS product_count FROM sucursal_productos WHERE ID_SUCURSAL = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id_sucursal);
    $stmt->execute();
    $stmt->bind_result($product_count);
    $stmt->fetch();
    $stmt->close();

    // Respuesta JSON
    echo json_encode(['product_count' => $product_count]);
} else {
    // Si no se envió el ID de la sucursal
    echo json_encode(['error' => 'ID de sucursal no proporcionado.']);
}
?>
