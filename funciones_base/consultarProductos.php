<?php
// Incluir el archivo de conexión a la base de datos
include("../conexion.php");

// Obtener el valor de la claveSucursal desde la solicitud POST
$claveSucursal = isset($_POST['claveSucursal']) ? $_POST['claveSucursal'] : '';

// Validar si se ha recibido la claveSucursal
if (!empty($claveSucursal)) {
    // Consulta SQL para obtener la cantidad de productos asociados a la claveSucursal
    $sql = "SELECT COUNT(*) AS cantidadProductos FROM suc_productos WHERE ID_CENTRO_OPERACIONES = ?";
    $stmt = $conexion->prepare($sql);

    // Verificar que la preparación de la consulta fue exitosa
    if ($stmt === false) {
        // Si ocurre un error, respondemos con un mensaje de error
        echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
        exit;
    }

    // Vincular el parámetro de tipo 's' para cadena (string)
    $stmt->bind_param("s", $claveSucursal);

    // Ejecutar la consulta
    $stmt->execute();

    // Vincular el resultado a la variable
    $stmt->bind_result($cantidadProductos);

    // Obtener el resultado
    $stmt->fetch();

    // Cerrar la declaración
    $stmt->close();

    // Devolver la cantidad de productos en formato JSON
    echo json_encode(['cantidadProductos' => $cantidadProductos]);
} else {
    // Si no se recibe la claveSucursal, respondemos con un mensaje de error
    echo json_encode(['error' => 'No se proporcionó una clave de sucursal.']);
}
?>
