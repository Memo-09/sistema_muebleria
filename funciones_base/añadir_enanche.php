<?php
include('../conexion.php');

if (isset($_POST["claveventa"])) {
    $idVenta = $_POST["claveventa"];
    $cantidad = $_POST["cantidad"];
    
    // Usamos un procedimiento almacenado para insertar el enganche
    $query = "CALL InsertarEnganche2Venta(?, ?, @mensaje);";
    
    // Preparar la consulta para ejecutar el procedimiento almacenado
    if ($stmt = $conexion->prepare($query)) {
        // Vincular los parámetros
        $stmt->bind_param("id", $idVenta, $cantidad);

        // Ejecutar el procedimiento almacenado
        if ($stmt->execute()) {
            // Recuperar el mensaje
            $result = $conexion->query("SELECT @mensaje AS mensaje");
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['mensaje'];  // Mostrar el mensaje devuelto
            } else {
                echo "Error al recuperar el mensaje.";
            }
        } else {
            echo "Error al ejecutar el procedimiento almacenado.";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "No se recibió un ID de venta.";
}
?>




