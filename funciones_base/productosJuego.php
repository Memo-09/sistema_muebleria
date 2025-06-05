<?php
include('../conexion.php');

// Verificar si se recibe el ID_JUEGO
if (isset($_POST['id_juego'])) {
    $id_juego = $_POST['id_juego'];

    // Llamar al procedimiento almacenado
    $query = "CALL detalleProductosSucursal(?)";

    // Preparar la consulta
    if ($stmt = $conexion->prepare($query)) {
        $stmt->bind_param("i", $id_juego);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                // Concatenación corregida con el operador de concatenación "."
                $productos[] = [
                    'clave_producto' => $row['CLAVE_PRODUCTO'],
                    'nombre_producto' => $row['NOMBRE_PRODUCTO'] . " " . $row['CARACTERISTICAS_PRODUCTO']. " MARCA:" . $row['DESCRIPCION_MARCA'], // Concatenación correcta
                    'cantidad' => $row['CANTIDAD']
                ];
            }

            echo json_encode([
                'success' => true,
                'data' => $productos
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se encontraron productos para este juego.'
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al preparar la consulta SQL.'
        ]);
    }

    $conexion->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No se ha recibido el ID del juego.'
    ]);
}
?>
