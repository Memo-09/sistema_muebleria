<?php
include('../conexion.php'); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos desde el formulario
    $clave = $_POST['clave'] ?? ''; // Clave del cliente que se desea actualizar
    $nombre = $_POST['nombre'] ?? '';
    $ap_p = $_POST['ap_p'] ?? '';
    $ap_m = $_POST['ap_m'] ?? '';
    $calle = $_POST['calle'] ?? '';
    $numero_exterior = $_POST['numero_exterior'] ?? '';
    $numero_interior = $_POST['numero_interior'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $colonia = $_POST['colonia'] ?? '';
    $municipio = $_POST['municipio'] ?? '';
    $id_colaborador = $_POST['id_colaborador'] !== 'seleccion' ? $_POST['id_colaborador'] : null;

    // Verificar que la clave del cliente no esté vacía
    if (empty($clave)) {
        echo json_encode(["success" => false, "error" => "Clave del cliente no proporcionada."]);
        exit;
    }

    // Preparar la consulta para llamar al procedimiento almacenado
    $sql = "CALL actualizar_cliente_todo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        echo json_encode(["success" => false, "error" => "Error al preparar la consulta: " . $conexion->error]);
        exit;
    }

    // Vincular parámetros y ejecutar
    $stmt->bind_param(
        "issssssssssi",
        $clave, $nombre, $ap_p, $ap_m, $calle, $numero_exterior, $numero_interior,
        $telefono, $correo, $colonia, $municipio, $id_colaborador
    );

    if ($stmt->execute()) {
        // Capturar los mensajes del procedimiento almacenado
        $result = $stmt->get_result();
        $messages = [];

        while ($row = $result->fetch_assoc()) {
            $messages[] = $row['resultado'];
        }

        // Enviar respuesta exitosa con los mensajes obtenidos
        echo json_encode(["success" => true, "messages" => $messages]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al ejecutar la consulta: " . $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["success" => false, "error" => "Método de solicitud no permitido."]);
}
?>
