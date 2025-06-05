<?php
include('../conexion.php');

if (isset($_POST["id_venta"])) {
    $idVenta = $_POST["id_venta"];

    $query = "CALL ActualizarStatusVentaEnDeudores(?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idVenta);

    if ($stmt->execute()) {
        echo "Estatus actualizado correctamente";
    } else {
        echo "Error al actualizar el estatus.";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "No se recibió un ID de venta.";
}
?>
