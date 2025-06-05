<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por AJAX
    $venta = $_POST['venta'];

    // Crear una respuesta para enviar al cliente
    $response = [];

    try {
        // Preparar el procedimiento almacenado
        $stmt = $conexion->prepare("CALL ObtenerEngancheVenta(?)");

        // Asignar los parámetros
        $stmt->bind_param("i", $venta);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $result = $stmt->get_result();

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Obtener los datos de la venta
            $row = $result->fetch_assoc();

            // Asignar los valores a la respuesta
            $response['success'] = true;
            $response['enganche'] = $row['ENGANCHE_DATO'];
            $response['parciales'] = $row['NUMERO_PARCIALIDAD'];
        } else {
            $response['success'] = false;
            $response['error'] = 'No se encontraron datos para esta venta';
        }

        // Cerrar la conexión y las consultas
        $stmt->close();
        $conexion->close();
    } catch (Exception $e) {
        // Manejar errores
        $response['success'] = false;
        $response['error'] = 'Error al obtener los datos: ' . $e->getMessage();
    }

    // Enviar la respuesta como JSON
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>

