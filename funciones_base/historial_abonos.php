<?php
include('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger el valor enviado desde JavaScript
    $claveVenta = $_POST['claveVenta'];

    // Procedimiento almacenado para obtener los productos asociados a una venta
    $sql = "CALL GetAbonosVentaByID(?);";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param("i", $claveVenta);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener los resultados de la consulta
            $result = $stmt->get_result();

            // Verificar si se encontraron resultados
            $productos = [];
            if ($result->num_rows > 0) {
                // Recorrer y almacenar los resultados
                while ($row = $result->fetch_assoc()) {
                    $productos[] = $row;
                }

                // Devolver los productos en formato JSON
                echo json_encode($productos);
            } else {
                // No se encontraron productos
                echo json_encode([]);
            }
        } else {
            // Enviar error si la consulta no se ejecuta
            echo json_encode(["error" => "Error al ejecutar la consulta: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Error en la preparación de la consulta: " . $conexion->error]);
    }

    $conexion->close();
}
?>