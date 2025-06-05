<?php
// Incluir el archivo de conexión a la base de datos
include('../conexion.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y validar los datos
    $marca = isset($_POST['marca']) ? trim($_POST['marca']) : null;

    // Validar campos requeridos
    if ($marca) {
        $query = "CALL insertarMarca(?);";

        if ($stmt = $conexion->prepare($query)) {
            $stmt->bind_param("s", $marca);

            if ($stmt->execute()) {
                // Devolver mensaje de éxito al cliente
                echo json_encode(["success" => true, "message" => "Marca insertada correctamente."]);
            } else {
                // Devolver error específico al cliente
                echo json_encode(["success" => false, "message" => "Error al insertar la Marca: " . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Error en la preparación de la consulta: " . $conexion->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Todos los campos son requeridos y deben ser válidos."]);
    }
}

$conexion->close();
?>
