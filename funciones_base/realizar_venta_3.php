<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Decodificar los datos recibidos desde el cliente
$datos = json_decode($_POST['datos'], true);

// Verificar si los datos contienen los campos esperados
if (isset($datos['cliente'], $datos['credito'], $datos['enganche'])) {

    // Extraer las variables
    $cliente_id = $datos['cliente'];
    $total_venta_credito = $datos['credito'];
    $status_venta = 1;
    $fecha_registro = $datos['fechaRegistro'];
    $fecha_contado = $datos['fechaLimiteContado'];
    $fecha_credi_contado = $datos['fechaLimiteCrediContado'];
    $fecha_credito = $datos['fechaLimiteCredito'];
    $total_credi_contado = $datos['creditoContado'];
    $total_contado = $datos['contado'];
    $abonado = $datos['enganche_dado'];
    $restante = $total_venta_credito - $abonado;
    $pago_minimo = $datos['pagoMinimo'];
    $pago_max = $datos['pagoMaximo'];
    $dia = $datos['dia'];
    $tipoPago = $datos['tipopago'];
    $numero_parcial = $datos['parcial'];
    $enganche = $datos['enganche'];
    $enganche_dado = $datos['enganche_dado'];
    $productosVentas = $datos['productosVentas'];

    // Generar token único
    $token = bin2hex(random_bytes(16));

    // Iniciar transacción
    mysqli_begin_transaction($conexion);

    try {
        // Registrar venta
        $query1 = "CALL registrarVenta(
            $cliente_id, 
            $total_venta_credito, 
            '$status_venta', 
            '$fecha_contado', 
            '$fecha_credi_contado', 
            '$fecha_credito', 
            $total_credi_contado, 
            $total_contado, 
            $abonado, 
            $restante, 
            '$fecha_registro', 
            $pago_minimo, 
            $pago_max, 
            $dia,
            $tipoPago,
            $total_venta_credito,
            $numero_parcial,
            $enganche,
            $enganche_dado
        )";
        if (!mysqli_query($conexion, $query1)) {
            throw new Exception("Error al registrar la venta: " . mysqli_error($conexion));
        }

        // Registrar productos
        if (isset($productosVentas) && !empty($productosVentas)) {
            foreach ($productosVentas as $producto) {
                $query2 = "CALL registrarVentaProducto(
                    '" . $producto['claveProducto'] . "', 
                    " . $producto['cantidad'] . ", 
                    " . $producto['idAlmacen'] . "
                )";
                if (!mysqli_query($conexion, $query2)) {
                    throw new Exception("Error al registrar el producto: " . mysqli_error($conexion));
                }
            }
        } else {
            throw new Exception("No se recibieron productos o la lista de productos está vacía.");
        }

        // Registrar primer abono
        $query3 = "CALL InsertarPrimerAbonoVenta('$fecha_registro', $abonado)";
        if (!mysqli_query($conexion, $query3)) {
            throw new Exception("Error al registrar el abono: " . mysqli_error($conexion));
        }

        // Insertar token
        $query4 = "CALL InsertarTokenVenta('$token')";
        if (!mysqli_query($conexion, $query4)) {
            throw new Exception("Error al insertar el token: " . mysqli_error($conexion));
        }

        // Confirmar transacción
        mysqli_commit($conexion);

        // Solo mostrar mensaje de éxito
        echo "Venta registrada correctamente.";

    } catch (Exception $e) {
        mysqli_rollback($conexion);
        echo "Error: " . $e->getMessage();
    }
}
?>



