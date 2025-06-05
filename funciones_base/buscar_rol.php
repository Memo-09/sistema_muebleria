<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Verificar si se ha recibido el ID del colaborador
if (isset($_POST['idColaborador'])) {
    $idColaborador = $_POST['idColaborador'];

    // Llamar al procedimiento almacenado para obtener el rol del colaborador
    $query = "CALL ObtenerRolColaborador(?)"; // Procedimiento almacenado

    if ($stmt = $conexion->prepare($query)) {
        // Vincular los parámetros
        $stmt->bind_param("i", $idColaborador);

        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado
        $result = $stmt->get_result();
        
        if ($result && $row = $result->fetch_assoc()) {
            // Si se encuentra el rol, devolverlo en formato JSON
            echo json_encode([
                'success' => true,
                'rolDescripcion' => $row['DESCRIPCION_ROL'] // Campo del rol del colaborador
            ]);
        } else {
            // Si no se encuentra el rol
            echo json_encode(['success' => false, 'error' => 'No se encontró el rol del colaborador.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al ejecutar la consulta: ' . $conexion->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No se ha recibido el ID del colaborador.']);
}

// Cerrar la conexión
$conexion->close();
?>
