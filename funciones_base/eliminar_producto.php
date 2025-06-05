<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Incluir la conexión a la base de datos
include('../conexion.php');

// Verificar si se recibió la claveProducto y mostrarla
if (isset($_POST['claveProducto'])) {
    $claveProducto = mysqli_real_escape_string($conexion, $_POST['claveProducto']); // Escapar la claveProducto para seguridad

    // Consulta para verificar si el producto está asociado a alguna sucursal
    $sql = "SELECT COUNT(*) AS total FROM suc_productos WHERE CLAVE_PRODUCTO = '$claveProducto'";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $sql);

    // Comprobar si la consulta fue exitosa
    if ($result) {
        // Obtener el resultado de la consulta
        $row = mysqli_fetch_assoc($result);
        $totalSucursales = $row['total'];

        // Verificar si el producto está asociado a alguna sucursal
        if ($totalSucursales > 0) {
            echo json_encode(["success" => false, "message" => "El producto no se puede eliminar porque está siendo utilizado en una Sucursal o Bodega."]);
        } else {
            // Si no está asociado a ninguna sucursal, proceder con la eliminación
            $sqlEliminarProducto = "DELETE FROM productos WHERE CLAVE_PRODUCTO = '$claveProducto'";
            
            // Ejecutar la eliminación
            if (mysqli_query($conexion, $sqlEliminarProducto)) {
                echo json_encode(["success" => true, "message" => "Producto eliminado correctamente."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al eliminar el producto: " . mysqli_error($conexion)]);
            }
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error al verificar el producto: " . mysqli_error($conexion)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No se recibió la clave del producto"]);
}

// Cerrar la conexión
mysqli_close($conexion);
?>







