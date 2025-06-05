<?php
include('../conexion.php'); // Conectar a la base de datos

// Verificar si se ha recibido el parámetro 'claveCompra' desde AJAX
if (isset($_POST['claveCompra'])) {
    // Obtener el ID de la compra
    $id_compra = $_POST['claveCompra'];

    // Preparar la consulta para llamar al procedimiento almacenado
    $query = "CALL EliminarCompra(?);";
    
    // Preparar la declaración
    if ($stmt = mysqli_prepare($conexion, $query)) {
        // Vincular el parámetro
        mysqli_stmt_bind_param($stmt, "i", $id_compra);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Respuesta en formato JSON para indicar éxito
            echo json_encode([
                'success' => true,
                'message' => 'Compra eliminada correctamente.'
            ]);
        } else {
            // En caso de error en la ejecución
            echo json_encode([
                'success' => false,
                'message' => 'Error al eliminar la compra.'
            ]);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        // Error al preparar la consulta
        echo json_encode([
            'success' => false,
            'message' => 'Error al preparar la consulta.'
        ]);
    }
} else {
    // En caso de no recibir el parámetro 'claveCompra'
    echo json_encode([
        'success' => false,
        'message' => 'No se ha proporcionado un ID de compra.'
    ]);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
