<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clave = $_POST['clave'];

    // Validar que la clave no esté vacía
    if (empty($clave)) {
        echo json_encode(['success' => false, 'error' => 'Clave del cliente no proporcionada.']);
        exit;
    }

    // Llamar al procedimiento almacenado
    $query = "CALL ObtenerColaboradoresCliente(?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Si hay resultados, los convertimos en JSON
    $colaboradores = [];
    while ($fila = $resultado->fetch_assoc()) {
        $colaboradores[] = $fila;
    }

    if (!empty($colaboradores)) {
        echo json_encode(['success' => true, 'colaboradores' => $colaboradores]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se encontraron colaboradores para este cliente.']);
    }

    // Cerrar conexión
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}
?>

