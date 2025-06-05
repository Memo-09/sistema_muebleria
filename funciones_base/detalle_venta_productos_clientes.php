<?php
include('../conexion.php');

if (isset($_POST['id_venta'])) {
    $id_venta = $_POST['id_venta'];

    $consulta = "CALL obtener_detalles_venta_productos($id_venta)";
    $resultado = mysqli_query($conexion, $consulta);

    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr>
            <td>' . htmlspecialchars($fila['CLAVE_PRODUCTO']) . '</td>
            <td>' . htmlspecialchars($fila['NOMBRE_COMPLETO']) . '</td>
            <td>' . htmlspecialchars($fila['NUMERO_PRODUCTOS']) . '</td>
        </tr>';
    }

    mysqli_close($conexion);
}
?>
