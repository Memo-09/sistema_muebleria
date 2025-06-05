<?php
require_once '../conexion.php'; // Asegúrate de que este archivo tiene la conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proveedor = trim($_POST['proveedor']);

    if (empty($proveedor)) {
        echo json_encode(["success" => false, "message" => "El campo proveedor no puede estar vacío."]);
        exit;
    }

    $sql = "INSERT INTO proveedores (DESCRIPCION_PROVEEDOR) VALUES (?)";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $proveedor);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Proveedor registrado con éxito."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al insertar el proveedor."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error en la consulta SQL."]);
    }
    
    $conexion->close();
} else {
    echo json_encode(["success" => false, "message" => "Método de solicitud no permitido."]);
}
?>
