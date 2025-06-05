<?php
ob_start(); // Inicia el buffer de salida para evitar que cualquier dato se envíe antes de tiempo

require './pdf/vendor/setasign/fpdf/fpdf.php';
require './barras/vendor/autoload.php';  // Carga el autoload de Composer

use Picqer\Barcode\BarcodeGeneratorPNG;

include('conexion.php');

// Obtener los datos desde la URL
$id_venta = isset($_GET['id_venta']) ? $_GET['id_venta'] : 0;
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$apellido1 = isset($_GET['apellido1']) ? $_GET['apellido1'] : '';
$apellido2 = isset($_GET['apellido2']) ? $_GET['apellido2'] : '';
$nombre_cliente= $nombre ." ".$apellido1." ".$apellido2;

// Crear el PDF
$pdf = new Fpdf('P', 'mm', array(80, 320));

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
$pdf->Cell(70, 10, utf8_decode('ESTADO DE CUENTA'), 0, 1, 'C');
$pdf->Ln(2);

// Línea horizontal
$pdf->SetLineWidth(0.2);
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(2);

// Información de la venta
date_default_timezone_set('America/Mexico_City'); // Ajusta según tu ubicación
$pdf->SetFont('Courier', '', 6);
$pdf->Cell(70, 6, utf8_decode("Fecha: " . date("d/m/Y")), 0, 1);
$pdf->MultiCell(70, 4, utf8_decode("ID de Venta: {$id_venta}"));
$pdf->MultiCell(70, 4, utf8_decode("Cliente: {$nombre_cliente}"));
$pdf->Ln(2);

// Línea horizontal
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(3);

// Preparar la consulta para obtener los detalles de la venta
$sql2 = "CALL obtener_productos_venta(?);";
$stmt2 = $conexion->prepare($sql2);
$stmt2->bind_param("i", $id_venta);  // Vinculamos el parámetro de la venta
$stmt2->execute();
$result2 = $stmt2->get_result();  // Obtener los resultados de la consulta

// Aquí agregamos la información del estado de cuenta
$pdf->SetFont('Courier', 'B', 6);
$pdf->Cell(47, 6, utf8_decode("Nombre del Producto"), 1, 0, 'C');
$pdf->Cell(23, 6, utf8_decode("Cantidad"), 1, 1, 'C'); // Salto de línea

$pdf->SetFont('Courier', '', 6);

// Recorrer los resultados y agregarlos a la tabla
while ($row2 = $result2->fetch_assoc()) {
    $nombre = utf8_decode($row2['NOMBRE_COMPLETO_PRODUCTO']);
    
    // Si el nombre tiene más de 35 caracteres, lo recortamos y añadimos "..."
    if (mb_strlen($nombre, 'UTF-8') > 35) {
        $nombre = mb_substr($nombre, 0, 32, 'UTF-8') . '...';
    }

    $pdf->Cell(47, 6, $nombre, 1, 0, 'C');
    $pdf->Cell(23, 6, utf8_decode($row2['NUMERO_PRODUCTOS']), 1, 1, 'C');
}

$stmt2->close();

$pdf->Ln(2);

// Línea horizontal
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(3);

// Preparar la consulta para obtener los detalles de la venta
$sql3 = "CALL obtener_abono_reciente(?);";
$stmt3 = $conexion->prepare($sql3);
$stmt3->bind_param("i", $id_venta);  // Vinculamos el parámetro de la venta
$stmt3->execute();
$result3 = $stmt3->get_result();  // Obtener los resultados de la consulta

// Aquí agregamos la información del estado de cuenta
$pdf->SetFont('Courier', 'B', 6);
$pdf->Cell(35, 6, utf8_decode("Fecha Abono Reciente"), 1, 0, 'C');
$pdf->Cell(35, 6, utf8_decode("Cantidad"), 1, 1, 'C'); // Salto de línea

$pdf->SetFont('Courier', '', 6);

// Recorrer los resultados y agregarlos a la tabla
if ($row3 = $result3->fetch_assoc()) {
    $pdf->Cell(35, 6, $row3['FECHA_BONO'], 1, 0, 'C');
    $pdf->Cell(35, 6, $row3['ABONO_DINERO'], 1, 1, 'C');
}
$stmt3->close();
$pdf->Ln(3);


// Línea horizontal
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(3);

// Preparar la consulta para obtener los detalles de la venta
$sql = "CALL detalle_estadodecuenta(?);";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_venta);  // Vinculamos el parámetro de la venta
$stmt->execute();
$result = $stmt->get_result();  // Obtener los resultados de la consulta

// Aquí agregamos la información del estado de cuenta
$pdf->SetFont('Courier', 'B', 6);
$pdf->Cell(24, 6, utf8_decode("Total Venta"), 1, 0, 'C');
$pdf->Cell(23, 6, utf8_decode("Abonado"), 1, 0, 'C');
$pdf->Cell(23, 6, utf8_decode("Restante"), 1, 1, 'C'); // Salto de línea

$pdf->SetFont('Courier', '', 6);

// Recorrer los resultados y agregarlos a la tabla
if ($row = $result->fetch_assoc()) {
    $total_venta = "$" . number_format($row['TOTAL_VENTA'], 2);
    $abonado = "$" . number_format($row['ABONADO'], 2);
    $restante = "$" . number_format($row['RESTANTE'], 2);

    $pdf->Cell(24, 6, $total_venta, 1, 0, 'C');
    $pdf->Cell(23, 6, $abonado, 1, 0, 'C');
    $pdf->Cell(23, 6, $restante, 1, 1, 'C');
}

$pdf->Ln(2);

// Línea horizontal
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(3);

// Aquí agregamos la información del estado de cuenta
$pdf->SetFont('Courier', 'B', 6);
$pdf->Cell(24, 6, utf8_decode("Total Credito"), 1, 0, 'C');
$pdf->Cell(23, 6, utf8_decode("Total Cred.Contad."), 1, 0, 'C');
$pdf->Cell(23, 6, utf8_decode("Total Contado"), 1, 1, 'C'); // Salto de línea

$pdf->SetFont('Courier', '', 6);

// Recorrer los resultados y agregarlos a la tabla
$pdf->Cell(24, 6, "$" . number_format($row['TOTAL_VENTA_CREDITO'], 2), 1, 0, 'C');
$pdf->Cell(23, 6, "$" . number_format($row['TOTAL_CREDI_CONTADO'], 2), 1, 0, 'C');
$pdf->Cell(23, 6, "$" . number_format($row['TOTAL_CONTADO'], 2), 1, 1, 'C');

$pdf->Ln(3);

// Línea horizontal
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Ln(2);

// Información adicional (fecha actual, día de pago)
$pdf->SetFont('Courier', 'B', 6);
$pdf->Cell(70, 6, utf8_decode("Día de Pago: " . $row['DESCRIPCION_DIA']), 0, 1);
$pdf->Cell(70, 6, utf8_decode("Pago Minimo: " . number_format($row['PAGO_MINOMO'], 2)), 0, 1);
$pdf->Cell(70, 6, utf8_decode("Pago Maximo: " . number_format($row['PAGO_MAX'], 2)), 0, 1);
$pdf->Cell(70, 6, utf8_decode("Fecha limite de Credito: " . $row['FECHA_CREDITO']), 0, 1);
$pdf->Cell(70, 6, utf8_decode("Fecha Limite de Credi-Contado: " . $row['FECHA_CREDI_CONTADO']), 0, 1);
$pdf->Cell(70, 6, utf8_decode("Fecha Limite de Contado: " . $row['FECHA_CONTADO']), 0, 1);

$stmt->close();

// Título del recordatorio
$pdf->Ln(3);
$pdf->SetFont('Courier', 'B', 7);
$pdf->Cell(0, 4, utf8_decode('RECUERDA:'), 0, 1);

// Texto actualizado con los puntos detallados
$pdf->SetFont('Courier', '', 5);
$pdf->MultiCell(70, 5, utf8_decode(
    "- Es importante mantener tu cuenta al corriente conforme al plan de pagos contratado.\n" .
    "- Si han pasado más de dos semanas sin registrar un abono, la garantía que ofrece la mueblería será bloqueada temporalmente.\n" .
    "- En caso de incumplimiento, se realizará una reunión con el cliente o se establecerá contacto telefónico para revisar el detalle de los pagos y llegar a un acuerdo.\n" .
    "- La garantía de fábrica cubre únicamente defectos de fabricación y no aplica en casos de mal uso, daños por humedad, golpes o alteraciones al producto original.\n" .
    "- Para conservar la validez de esta garantía, es necesario cumplir con los pagos de forma regular y presentar tu comprobante de compra cuando se requiera."
));



// Crear el objeto generador de código de barras
$generator = new BarcodeGeneratorPNG();

// 1. Obtener el token correspondiente desde la base de datos
$sql_token = "SELECT TOKEN_VENTA FROM token_venta WHERE ID_VENTA = $id_venta";
$result_token = mysqli_query($conexion, $sql_token);

if ($result_token && mysqli_num_rows($result_token) > 0) {
    $row_token = mysqli_fetch_assoc($result_token);
    $token = $row_token['TOKEN_VENTA'];

    // 2. Construir la URL dinámica usando el token
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $dominio = $_SERVER['HTTP_HOST'];
    $ruta = "/Muebleria_2/historial_cliente.php?token=" . $token;
    $url_detalle = $protocolo . $dominio . $ruta;

} else {
    // Si no se encontró token
    $url_detalle = "Token no disponible";
}


// Generar el código de barras en formato PNG con la URL completa
$barcode = $generator->getBarcode($url_detalle, $generator::TYPE_CODE_128);

// Guardar el código de barras como un archivo temporal
$temp_file = 'codigo_barras/tmp_barcode.png';
file_put_contents($temp_file, $barcode);


// Agregar la imagen del código de barras al PDF
$pdf->Image($temp_file, 10, 275, 60, 20);  // Código de barras (ajusta según necesites)

// Texto a mostrar
$texto = utf8_decode("O accede al siguiente link: ");
$enlace = "AQUI";

// Calcular el ancho del texto
$pdf->SetFont('Courier', '', 5);
$ancho_texto = $pdf->GetStringWidth($texto);

$pdf->SetFont('Courier', 'U', 5);
$ancho_enlace = $pdf->GetStringWidth($enlace);

// Sumar anchos
$ancho_total = $ancho_texto + $ancho_enlace;

// Obtener el ancho de la página
$ancho_pagina = $pdf->GetPageWidth();

// Calcular posición X para centrar
$pos_x = ($ancho_pagina - $ancho_total) / 2;

// Establecer posición
$pdf->SetXY($pos_x, 295); // Debajo del código de barras

// Imprimir texto normal
$pdf->SetFont('Courier', '', 5);
$pdf->SetTextColor(0, 0, 0);
$pdf->Write(3, $texto);

// Imprimir enlace "AQUI"
$pdf->SetFont('Courier', 'U', 5);
$pdf->SetTextColor(0, 0, 255); // Azul
$pdf->Write(3, $enlace, $url_detalle);

// Restaurar color y fuente
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Courier', '', 10); // Tamaño por defecto


// Restaurar color y fuente
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 10); // Opcional: volver al tamaño normal




// Convertir el nombre del cliente a mayúsculas y reemplazar espacios por guiones bajos
$nombre_cliente = strtoupper("{$nombre_cliente}");
$nombre_cliente = str_replace(' ', '_', $nombre_cliente); // Reemplazar espacios con guiones bajos

// Definir el nombre del archivo en mayúsculas con la estructura ESTADO_CUENTA_NOMBRE_APELLIDO_NUMERO_VENTA.pdf
$estado_filename = "ESTADO_CUENTA_{$nombre_cliente}_{$id_venta}.pdf";

// Enviar el PDF directamente al navegador para su descarga
$pdf->Output('D', $estado_filename); // 'D' fuerza la descarga del archivo en lugar de guardarlo
?>
