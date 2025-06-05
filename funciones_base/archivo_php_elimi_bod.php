<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar que se han enviado los parámetros necesarios
if (isset($_POST['ID_BODEGA']) && isset($_POST['CLAVE_PRODUCTO'])) {
    $idBodega = $_POST['ID_BODEGA'];
    $claveProducto = $_POST['CLAVE_PRODUCTO'];

    // Preparar la consulta DELETE sin usar prepared statements
    $query = "DELETE FROM suc_productos WHERE ID_CENTRO_OPERACIONES = $idBodega AND CLAVE_PRODUCTO = '$claveProducto';";

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

