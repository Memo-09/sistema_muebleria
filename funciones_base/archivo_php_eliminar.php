<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar que se han enviado los parámetros necesarios
if (isset($_POST['ID_SUCURSAL']) && isset($_POST['CLAVE_PRODUCTO'])) {
    $idSucursal = $_POST['ID_SUCURSAL'];
    $claveProducto = $_POST['CLAVE_PRODUCTO'];

    // Preparar la consulta DELETE sin usar prepared statements
    $query = "DELETE FROM suc_productos WHERE ID_CENTRO_OPERACIONES = $idSucursal AND CLAVE_PRODUCTO = '$claveProducto';";

    // Ejecutar la consulta
    if ($conexion->query($query) === TRUE) {
        echo "Producto eliminado exitosamente";
    } else {
        echo "Error al eliminar el producto: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "Datos incompletos";
}
?>

