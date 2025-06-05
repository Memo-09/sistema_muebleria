<?php
// Incluir la librería FPDF
require './pdf/vendor/setasign/fpdf/fpdf.php';
require 'conexion.php'; // Archivo de conexión a la base de datos

// Crear la clase personalizada para agregar encabezado y pie de página
class PDF extends FPDF {
    // Encabezado
    function Header() {
        // Agregar imagen
        $this->Image('./assets/img/logo_santana_dd1.png', 10, 6, 30);
        
        // Establecer fuente y título
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'REPORTE DE COMPRAS', 0, 1, 'C');
        $this->Ln(5);
        
        // Encabezados de la tabla
        $this->SetFont('Arial', 'B', 8);
        $this->SetFillColor(200, 200, 200);
        
        $this->Cell(20, 7, 'ID Compra', 1, 0, 'C', true);
        $this->Cell(30, 7, 'Fecha', 1, 0, 'C', true); // Nueva columna para fecha de compra
        $this->Cell(40, 7, 'Proveedor', 1, 0, 'C', true);
        $this->Cell(90, 7, 'Producto', 1, 0, 'C', true);
        $this->Cell(15, 7, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(20, 7, 'Precio Base', 1, 0, 'C', true);
        $this->Cell(20, 7, 'Precio Total', 1, 0, 'C', true);
        $this->Cell(25, 7, utf8_decode('Precio Crédito'), 1, 1, 'C', true); // Movido al final
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Mueblería SANTANA SÁNCHEZ - Jilotepec, Edo. Méx'), 0, 0, 'C');
    }
}

// Crear el PDF en formato horizontal
$pdf = new PDF('L', 'mm', 'Letter'); // 'L' = Landscape (horizontal)
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);

// Obtener datos de la base de datos
$query = "CALL ObtenerComprasDetalles()";
$resultado = $conexion->query($query);

while ($fila = $resultado->fetch_assoc()) {
    // Concatenar nombre del producto con características y marca
    $producto = utf8_decode($fila['NOMBRE_PRODUCTO'] . ' ' . $fila['CARACTERISTICAS_PRODUCTO'] . ' - ' . $fila['DESCRIPCION_MARCA']);

    // Limitar el texto del producto a 26 caracteres con "..."
    if (strlen($producto) > 50) {
        $producto = substr($producto, 0, 50) . '...';
    }

    // Agregar los datos a la tabla
    $pdf->Cell(20, 6, $fila['ID_COMPRA'], 1, 0, 'C');
    $pdf->Cell(30, 6, $fila['FECHA_COMPRA'], 1, 0, 'C'); // Nueva columna con la fecha de compra
    $pdf->Cell(40, 6, utf8_decode($fila['DESCRIPCION_PROVEEDOR']), 1, 0, 'L');
    $pdf->Cell(90, 6, $producto, 1, 0, 'L');
    $pdf->Cell(15, 6, $fila['CANTIDAD DE PRODUCTOS'], 1, 0, 'C');
    $pdf->Cell(20, 6, '$' . number_format($fila['PRECIO_BASE'], 2), 1, 0, 'C');
    $pdf->Cell(20, 6, '$' . number_format($fila['PRECIO_TOTAL'], 2), 1, 0, 'C');
    $pdf->Cell(25, 6, '$' . number_format($fila['PRECIO_CREDITO'], 2), 1, 1, 'C'); // Movido al final

    // Agregar una nueva página si el contenido es demasiado largo
    if ($pdf->GetY() > 190) { // Ajustado para formato horizontal
        $pdf->AddPage();
    }
}

// Cerrar conexión
$conexion->close();

// Nombre del archivo con fecha actual
date_default_timezone_set('America/Mexico_City'); // Ajusta según tu ubicación
$fecha = date("Y-m-d");
$archivo_pdf = "LISTA_COMPRAS_$fecha.pdf";

// Salida del PDF al navegador
$pdf->Output('I', $archivo_pdf);
?>



