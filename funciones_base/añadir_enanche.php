<?php
include('../conexion.php');

if (isset($_POST["claveventa"]) && isset($_POST["cantidad"]) && isset($_POST["fecha"])) {
    $idVenta = $_POST["claveventa"];
    $cantidad = $_POST["cantidad"];
    $fecha = $_POST["fecha"]; // ⬅️ Capturamos la fecha enviada

    // Llamar al procedimiento almacenado con 3 parámetros de entrada y uno de salida
    $query = "CALL InsertarEnganche2Venta(?, ?, ?, @mensaje);";

    if ($stmt = $conexion->prepare($query)) {
        // 'ids' = int, double, string (DATE en formato 'YYYY-MM-DD')
        $stmt->bind_param("ids", $idVenta, $cantidad, $fecha);

        if ($stmt->execute()) {
            // Obtener el mensaje devuelto
            $result = $conexion->query("SELECT @mensaje AS mensaje");
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['mensaje'];
            } else {
                echo "Error al recuperar el mensaje.";
            }
        } else {
            echo "Error al ejecutar el procedimiento almacenado.";
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }

    $conexion->close();
} else {
    echo "Faltan parámetros (ID de venta, cantidad o fecha).";
}
?>





