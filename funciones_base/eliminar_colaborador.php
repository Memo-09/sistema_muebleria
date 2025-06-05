<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

header('Content-Type: application/json');

// Verificar si se envió el ID del colaborador mediante POST
if (isset($_POST['idColaborador'])) {
    $idColaborador = $_POST['idColaborador'];

    // Verificar si el colaborador está siendo referenciado en cliente_colaborador
    $verificarSql = "SELECT COUNT(*) AS total FROM cliente_colaborador WHERE ID_COLABORADOR = ?";
    if ($verificarStmt = $conexion->prepare($verificarSql)) {
        $verificarStmt->bind_param("i", $idColaborador);
        $verificarStmt->execute();
        $resultado = $verificarStmt->get_result();
        $fila = $resultado->fetch_assoc();

        if ($fila['total'] > 0) {
            // El colaborador está siendo referenciado
            echo json_encode([
                'success' => false,
                'message' => 'No se puede eliminar el colaborador porque tiene Clientes a su Nombre.'
            ]);
        } else {
            // El colaborador no está siendo referenciado, proceder a eliminar
            $eliminarSql = "CALL EliminarPorColaborador(?);";
            if ($eliminarStmt = $conexion->prepare($eliminarSql)) {
                $eliminarStmt->bind_param("i", $idColaborador);
                if ($eliminarStmt->execute()) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Colaborador eliminado correctamente.'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error al eliminar el colaborador: ' . $eliminarStmt->error
                    ]);
                }
                $eliminarStmt->close();
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error en la preparación de la consulta de eliminación: ' . $conexion->error
                ]);
            }
        }
        $verificarStmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la preparación de la consulta de verificación: ' . $conexion->error
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Falta el ID del colaborador.'
    ]);
}

// Cerrar la conexión
$conexion->close();
?>


