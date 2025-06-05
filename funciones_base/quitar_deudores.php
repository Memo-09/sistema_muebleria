<?php
require("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_venta"])) {
    $idVenta = intval($_POST["id_venta"]); // Convertir a entero por seguridad

    if ($idVenta > 0) {
        $query = "CALL QuitarDeudor(?)";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $idVenta);

        if (mysqli_stmt_execute($stmt)) {
            echo "Estatus actualizado correctamente";
        } else {
            echo "Error al actualizar el estatus: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "ID de venta no válido.";
    }
} else {
    echo "Solicitud no válida.";
}

mysqli_close($conexion);
?>
