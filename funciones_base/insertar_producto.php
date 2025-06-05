<?php
// Incluir el archivo de conexión a la base de datos
include('../conexion.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y validar los datos
    $claveProducto = isset($_POST['clave_producto']) ? $_POST['clave_producto'] : null;
    $nombreProducto = isset($_POST['nombre_producto']) ? $_POST['nombre_producto'] : null;
    $marca = isset($_POST['marca']) ? intval($_POST['marca']) : null;
    $caracteristicas = isset($_POST['caracteristicas']) ? $_POST['caracteristicas'] : null;
    $color = isset($_POST['color']) ? intval($_POST['color']) : null;
    $precioContado = isset($_POST['precio_contado']) ? floatval($_POST['precio_contado']) : null;
    $crediContado = isset($_POST['credi_contado']) ? floatval($_POST['credi_contado']) : null;
    $credito = isset($_POST['credito']) ? floatval($_POST['credito']) : null;
    $enganche = isset($_POST['enganche']) ? floatval($_POST['enganche']) : null;
    $comision = isset($_POST['comision']) ? floatval($_POST['comision']) : null;
    $clasificacion = isset($_POST['clasificacion']) ? intval($_POST['clasificacion']) : null;

    // Validar que ningún campo esté vacío o inválido
    if ($claveProducto && $nombreProducto && $marca && $caracteristicas && $color && $precioContado && $crediContado && $credito && $enganche && $comision && $clasificacion) {
        $query = "INSERT INTO productos (CLAVE_PRODUCTO, NOMBRE_PRODUCTO, ID_MARCA, CARACTERISTICAS_PRODUCTO, ID_COLOR, PRECIO_CONTADO, PRECIO_CREDI_CONTADO, PRECIO_CREDITO, ENGANCHE, COMISION, ID_CLASIFICACION) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conexion->prepare($query)) {
            $stmt->bind_param("ssisidddddi", $claveProducto, $nombreProducto, $marca, $caracteristicas, $color, $precioContado, $crediContado, $credito, $enganche, $comision, $clasificacion);

            if ($stmt->execute()) {
                echo "Producto insertado correctamente.";
            } else {
                echo "Error al insertar el producto: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }
    } else {
        echo "Todos los campos son requeridos y deben ser válidos.";
    }
}

$conexion->close();
?>



