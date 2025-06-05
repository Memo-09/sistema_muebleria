<?php
// Incluir el archivo de conexión
include('../conexion.php');

// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos de la solicitud AJAX
    $bodega = isset($_POST['bodega']) ? $_POST['bodega'] : null;
    $producto = isset($_POST['clave']) ? $_POST['clave'] : null;
    $existencias = 1;  // Establecer un valor predeterminado para existencias

    // Verificar que los datos sean válidos
    if ($bodega && $producto) {
        // Preparar la consulta para insertar el producto
        $stmt = $conexion->prepare("CALL InsertarSucProducto3(?, ?, ?, @mensaje)");

        if ($stmt === false) {
            echo "Error al preparar la consulta: " . $conexion->error;
        } else {
            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("isi", $bodega, $producto, $existencias);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Obtener el mensaje desde la variable de salida
                $resultado = $conexion->query("SELECT @mensaje AS mensaje");

                if ($resultado) {
                    $fila = $resultado->fetch_assoc();
                    // Devuelve el mensaje en texto simple
                    echo $fila['mensaje'];
                } else {
                    echo "Error al recuperar el mensaje del procedimiento.";
                }
            } else {
                echo "Error al ejecutar la consulta: " . $stmt->error;
            }

            // Cerrar la declaración
            $stmt->close();
        }
    } else {
        echo "Datos incompletos.";
    }
} else {
    echo "Solicitud no válida.";
}

// Cerrar la conexión si ya no es necesaria
$conexion->close();
?>





