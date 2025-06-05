<?php
include('../conexion.php'); // Incluir la conexión existente

if (isset($_POST['id_centro_operaciones'])) {
    $idCentroOperaciones = intval($_POST['id_centro_operaciones']); // Sanitizar el dato

    // Llamar al procedimiento almacenado
    $sql = "CALL insertarProductosEnSucursal($idCentroOperaciones)";

    if (mysqli_query($conexion, $sql)) {
        echo "Productos agregados correctamente.";
    } else {
        echo "Error al insertar productos: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    echo "No se recibió el ID del centro de operaciones.";
}
?>

