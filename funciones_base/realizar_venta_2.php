<?php
// Incluir la conexión
include('../conexion.php');

try {
    // Recibir los datos en formato JSON
    $datos = json_decode($_POST['datos'], true);

    // Validar que los datos no estén vacíos
    if (!$datos) {
        throw new Exception("No se recibieron datos válidos.");
    }

    // Sanitizar y asignar los datos
    $cliente_id = intval($datos['cliente']);
    $total_venta_credito = floatval($datos['credito']);
    $total_credi_contado = floatval($datos['creditoContado']);
    $total_contado = floatval($datos['contado']);
    $fecha_registro = $datos['fechaRegistro'];
    $fecha_contado = $datos['fechaLimiteContado'];
    $fecha_credi_contado = $datos['fechaLimiteCrediContado'];
    $fecha_credito = $datos['fechaLimiteCredito'];
    $pago_minimo = floatval($datos['pagoMinimo']);
    $pago_max = floatval($datos['pagoMaximo']);
    $abonado = floatval($datos['enganche']);
    $restante = $total_venta_credito - $abonado;
    $status_venta = 1;

    // Validar fechas
    $fecha_registro = date('Y-m-d', strtotime($fecha_registro));
    if (!$fecha_registro || !$fecha_contado || !$fecha_credi_contado || !$fecha_credito) {
        throw new Exception("Una o más fechas no son válidas.");
    }

    // 1. Registrar la venta en la tabla `ventas`
    $query = "CALL registrarVenta(
        $cliente_id, 
        $total_venta_credito, 
        $status_venta, 
        '$fecha_contado', 
        '$fecha_credi_contado', 
        '$fecha_credito', 
        $total_credi_contado, 
        $total_contado, 
        $abonado, 
        $restante, 
        '$fecha_registro', 
        $pago_minimo, 
        $pago_max
    );";

    // Ejecutar la consulta
    /*if ($conexion->query($query) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Venta registrada con éxito."]);
    } else {
        throw new Exception("Error al registrar la venta: " . $conexion->error);
    }

    // Aquí imprimimos los datos de la tabla de productos en formato JSON para que el cliente lo pueda usar
    if (isset($datos['productos']) && is_array($datos['productos'])) {
        // Imprimir en consola los registros de los productos
        echo "<script>console.log(" . json_encode($datos['productos']) . ");</script>";
    }*/

} catch (Exception $e) {
    // Manejo de errores
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    error_log($e->getMessage()); // Registrar el error en el log del servidor
    http_response_code(400);
}













