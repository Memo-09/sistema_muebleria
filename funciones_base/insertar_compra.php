<?php
include('../conexion.php'); // Conectar a la base de datos

header("Content-Type: application/json"); // Definir la respuesta como JSON

// Verificar si los datos fueron enviados mediante POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar que los campos no estén vacíos
    if (
        empty($_POST["idProveedor"]) || empty($_POST["idProducto"]) || 
        empty($_POST["precioBase"]) || empty($_POST["cantidad"]) || 
        empty($_POST["precioTotal"]) || empty($_POST["precioCredito"])
    ) {
        echo json_encode(["success" => false, "error" => "Todos los campos son obligatorios."]);
        exit;
    }

    // Obtener valores y limpiar datos
    $idProveedor = intval($_POST["idProveedor"]);
    $idProducto = $_POST["idProducto"];
    $precioBase = floatval($_POST["precioBase"]);
    $cantidad = intval($_POST["cantidad"]);
    $precioTotal = floatval($_POST["precioTotal"]);
    $precioCredito = floatval($_POST["precioCredito"]);

    // Validar valores numéricos
    if ($idProveedor <= 0 || $cantidad <= 0 || $precioBase <= 0 || $precioTotal <= 0 || $precioCredito <= 0) {
        echo json_encode(["success" => false, "error" => "Los valores numéricos deben ser mayores a 0."]);
        exit;
    }

    // Preparar la consulta para llamar al procedimiento almacenado
    $query = "CALL InsertarCompra(?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conexion, $query)) {
        mysqli_stmt_bind_param($stmt, "isdddd", $idProveedor, $idProducto, $cantidad, $precioBase, $precioTotal, $precioCredito);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["success" => true]); // Respuesta exitosa
        } else {
            echo json_encode(["success" => false, "error" => "Error al ejecutar la consulta."]);
        }

        mysqli_stmt_close($stmt); // Cerrar la consulta preparada
    } else {
        echo json_encode(["success" => false, "error" => "Error en la preparación de la consulta."]);
    }

    mysqli_close($conexion); // Cerrar conexión
} else {
    echo json_encode(["success" => false, "error" => "Método no permitido."]);
}
?>
