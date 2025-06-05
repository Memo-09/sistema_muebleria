<?php
// Incluir el archivo de conexión a la base de datos
include('../conexion.php'); // Asegúrate de que este archivo configure correctamente la conexión a la base de datos

// Verificar si los datos han sido enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener la clave de la sucursal
    $claveBodega = intval($_POST['claveBodega']); // Asegurar que sea un entero

    // Verificar si existen productos enviados
    if (isset($_POST['productos']) && is_array($_POST['productos'])) {
        $productos = $_POST['productos'];

        // Preparar una conexión para las transacciones
        $conexion->begin_transaction();
        try {
            // Recorrer los productos y ejecutar el procedimiento almacenado
            foreach ($productos as $producto) {
                // Sanitizar y validar los datos
                $claveProducto = htmlspecialchars($producto['claveProducto'], ENT_QUOTES, 'UTF-8');
                $existencias = intval($producto['existencias']); // Asegurar que sea un entero

                // Preparar y ejecutar la consulta
                $stmt = $conexion->prepare("CALL InsertarSucProducto(?, ?, ?)");
                $stmt->bind_param("isi", $claveBodega, $claveProducto, $existencias); // Vincular parámetros
                $stmt->execute();
                $stmt->close();
            }

            // Confirmar la transacción
            $conexion->commit();
            echo "Productos insertados correctamente en la Bodega";
        } catch (Exception $e) {
            // Revertir los cambios si ocurre un error
            $conexion->rollback();
            echo "Error al insertar los productos: " . $e->getMessage();
        }
    } else {
        echo "No se han recibido productos.";
    }
} else {
    echo "No se han recibido datos.";
}
?>


