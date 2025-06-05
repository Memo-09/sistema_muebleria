<?php
ob_start(); // Inicia el buffer de salida para evitar que cualquier dato se envíe antes de tiempo

require './pdf/vendor/setasign/fpdf/fpdf.php';
include('conexion.php');

// Obtener los datos desde la URL
$id_venta = isset($_GET['id_venta']) ? $_GET['id_venta'] : 0;
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$apellido1 = isset($_GET['apellido1']) ? $_GET['apellido1'] : '';
$apellido2 = isset($_GET['apellido2']) ? $_GET['apellido2'] : '';
$total = isset($_GET['total']) ? $_GET['total'] : 0;
$abonado = isset($_GET['abonado']) ? $_GET['abonado'] : 0;
$restante = isset($_GET['restante']) ? $_GET['restante'] : 0;

// Preparar la consulta para obtener los detalles de la venta
$sql = "CALL obtener_detalle_venta(?);";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_venta);  // Vinculamos el parámetro de la venta
$stmt->execute();
$result = $stmt->get_result();  // Obtener los resultados de la consulta

// Crear el PDF
$pdf = new Fpdf('P', 'mm', array(80, 270));

// Establecer márgenes de 1 cm (izquierda, arriba, derecha)
$pdf->SetMargins(5, 5, 10); // 10mm = 1cm
$pdf->AddPage();

// Logo (asegúrate de que la ruta a la imagen sea correcta)
$image_path = './assets/img/logo_santana_dd1.png';
if (!file_exists($image_path)) {
    die('La imagen no existe.');
}
$pdf->Image($image_path, 15, 10, 50);
$pdf->Ln(20);

// Información adicional centrada y en negrita
$pdf->SetFont('Courier', 'B', 8);  // Cambié la fuente a 'Times' para todo el texto
$pdf->Cell(70, 4, utf8_decode("Muebleria SANTANA SANCHEZ"), 0, 1, 'C');
$pdf->Cell(70, 4, utf8_decode("Conocido Huertas, Jilotepec edo Méx"), 0, 1, 'C');
$pdf->Cell(70, 4, utf8_decode("Teléfono: 5514793942"), 0, 1, 'C');
$pdf->Cell(70, 4, utf8_decode("Correo: santanasad875@gmail.com"), 0, 1, 'C');
$pdf->Ln(5);  // Espacio entre la información y la siguiente sección

// Título
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(70, 10, utf8_decode('TICKET DE VENTA'), 0, 1, 'C');
$pdf->Ln(2);

// Línea horizontal
$pdf->SetLineWidth(0.2);
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(2);

// Información de la venta
$pdf->SetFont('Courier', '', 6);
$pdf->MultiCell(70, 4, utf8_decode("Clave de Venta: {$id_venta}"));
$pdf->MultiCell(70, 4, utf8_decode("Cliente: {$nombre} {$apellido1} {$apellido2}"));
$pdf->MultiCell(70, 4, utf8_decode("Total: $" . number_format($total, 2)));
$pdf->MultiCell(70, 4, utf8_decode("Abonado: $" . number_format($abonado, 2)));
$pdf->MultiCell(70, 4, utf8_decode("Restante: $" . number_format($restante, 2)));
$pdf->Ln(2);

// Línea horizontal
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(3);

// Aquí agregamos la tabla con los productos
$pdf->SetFont('Courier', 'B', 6);
$pdf->Cell(40, 6, utf8_decode("Producto"), 1, 0, 'C');
$pdf->Cell(15, 6, utf8_decode("Precio"), 1, 0, 'C');
$pdf->Cell(15, 6, utf8_decode("Cantidad"), 1, 1, 'C'); // Salto de línea

$pdf->SetFont('Courier', '', 5);

// Recorrer los resultados y agregarlos a la tabla
while ($row = $result->fetch_assoc()) {
    $nombre_producto = utf8_decode($row['NOMBRE_PRODUCTO']);
    $descripcion = utf8_decode($row['CARACTERISTICAS_PRODUCTO']);
    $marca = utf8_decode($row['DESCRIPCION_MARCA']);
    $precio_credito = "$" . number_format($row['PRECIO_CREDITO'], 2);
    $cantidad = $row['NUMERO_PRODUCTOS'];

    // Concatenamos el nombre del producto y las características
    $producto_completo = $nombre_producto . " " . $descripcion;
    
    // Limitar la longitud a 30 caracteres y agregar '...' si es más largo
    if (mb_strlen($producto_completo) > 30) {
        $producto_completo = mb_substr($producto_completo, 0, 35) . "...";
    }

    $pdf->Cell(40, 6, $producto_completo, 1, 0, 'C');
    $pdf->Cell(15, 6, $precio_credito, 1, 0, 'C');
    $pdf->Cell(15, 6, $cantidad, 1, 1, 'C');
}

$pdf->Ln(2);
// Línea horizontal
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(3);

// Agregar el convenio de crédito
$pdf->SetFont('Courier', '', 5);
$pdf->MultiCell(70, 4, utf8_decode("CONVENIO DE CREDITO"));
$pdf->MultiCell(70, 4, utf8_decode("1.- Celebran por una parte Mueblería Santana Sánchez 'El prestamista' representada por José Daniel Santana Sánchez, con domicilio en Jilotepec, Estado de México. Y por otra parte 'el cliente' cuyos datos aparecen en el presente ticket."));
$pdf->MultiCell(70, 4, utf8_decode("2.- El prestamista otorga al cliente un crédito en especie, por el monto y productos indicados en este ticket."));
$pdf->MultiCell(70, 4, utf8_decode("3.- La tasa de interés aplicable al crédito será del 5% anual, calculada mensualmente sobre el saldo pendiente de capital."));
$pdf->MultiCell(70, 4, utf8_decode("4.- El crédito deberá cumplirse en el plazo establecido, y cumplir con las cuotas fijadas en el presente ticket."));
$pdf->MultiCell(70, 4, utf8_decode("5.- El prestamista otorga un año como garantía de los productos, en caso de tener algún defecto de fábrica. (devolver en su caja, póliza y en buenas condiciones). No se hará valida la garantía si el artículo presenta rayones, golpes, hundimientos o perforaciones, que dañen la imagen o funciones, así como productos mojados, húmedos o quemados."));
$pdf->MultiCell(70, 4, utf8_decode("6.- Salida la mercancía de bodega no se aceptan cambios ni devoluciones."));
$pdf->MultiCell(70, 4, utf8_decode("7.- En caso de incumplimiento de un pago se dará de tolerancia una semana, para ponerse al corriente."));
$pdf->MultiCell(70, 4, utf8_decode("8.- El presente convenio tendrá vigencia de 1 año."));
$pdf->Ln(10);

// Nombre y Firma del cliente (centrado)
$pdf->SetFont('Courier', '', 6);
$pdf->Cell(70, 4, utf8_decode("___________________________"), 0, 1, 'C');  // Línea de firma
$pdf->Cell(70, 4, utf8_decode("Nombre y Firma cliente"), 0, 1, 'C');  // Texto de firma
$pdf->Ln(5);  // Espacio entre la firma y el agradecimiento

// Mensaje de agradecimiento
$pdf->SetFont('Courier', 'I', 6);
$pdf->Cell(70, 4, utf8_decode("AGRADECEMOS SU PREFERENCIA VUELVA PRONTO!!!"), 0, 1, 'C');  // Agradecimiento

// Convertir el nombre del cliente a mayúsculas y reemplazar espacios por guiones bajos
$nombre_cliente = strtoupper("{$nombre}_{$apellido1}_{$apellido2}");
$nombre_cliente = str_replace(' ', '_', $nombre_cliente); // Reemplazar espacios con guiones bajos

// Definir el nombre del archivo en mayúsculas con la estructura TICKET_NOMBRE_APELLIDO_NUMERO_VENTA.pdf
$ticket_filename = "TICKET_{$nombre_cliente}_{$id_venta}.pdf";

// Enviar el PDF directamente al navegador para su descarga
$pdf->Output('D', $ticket_filename); // 'D' fuerza la descarga del archivo en lugar de guardarlo
?>

