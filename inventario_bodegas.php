<?php
// Incluir la librería FPDF
require './pdf/vendor/setasign/fpdf/fpdf.php';
require 'conexion.php'; // Asegúrate de que esta línea incluye tu archivo de conexión a la base de datos

// Crear la clase personalizada para agregar el pie de página y encabezado en todas las páginas
class PDF extends FPDF {
    // Sobrecargar el método Header()
    function Header() {
        // Agregar la imagen al PDF (ajustando la posición y el tamaño)
        $this->Image('./assets/img/logo_santana_dd1.png', 10, 10, 30); // 10mm de margen a la izquierda, 10mm de margen desde arriba, 30mm de ancho
        
        // Establecer la fuente para el título
        $this->SetFont('Arial', 'B', 7);
        $this->SetXY(10, 10); // Cambiar la posición del título para que no se sobreponga con la imagen
        $this->Cell(0, 6, 'INVENTARIO DE BODEGA', 0, 1, 'C');
        $this->Ln(5); // Espacio después del título
    }

    // Sobrecargar el método Footer()
    function Footer() {
        // Posicionar el pie de página a 15mm del final
        $this->SetY(-15);
        // Establecer la fuente en cursiva, tamaño 6
        $this->SetFont('Arial', 'I', 6);
        // Agregar el texto del pie de página (centrado)
        $this->Cell(0, 10, utf8_decode('Muebleria SANTANA SANCHEZ, Conocido Huertas, Jilotepec Edo Méx'), 0, 0, 'C');
    }
}

// Crear el objeto PDF en orientación vertical ('P') y tamaño carta
$pdf = new PDF('P', 'mm', 'Letter'); // 'P' = Portrait (vertical)
$pdf->AddPage();
$pdf->SetFont('Arial', '', 7); // Letra para los datos

// Datos estáticos de ejemplo
// Crear la tabla con las dos primeras filas de la tabla
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetFillColor(200, 200, 200); // Color de fondo para las celdas de encabezado

// Encabezado de la tabla (clave y ubicación)
$pdf->Cell(40, 6, 'Clave de Bodega:', 1, 0, '', true);
$pdf->Cell(40, 6, '', 1, 0, 'C'); // Celda vacía para clave
$pdf->Cell(60, 6, 'Ubicacion:', 1, 0, '', true);
$pdf->Cell(55, 6, '', 1, 1, 'C'); // Celda vacía para ubicación

// Espacio antes de continuar con el inventario
$pdf->Ln(5); // Salto de línea

/// Aquí se agregará la tabla con los productos

// Encabezado de la tabla de inventario
$pdf->SetFont('Arial', 'B', 6); // Letra para los encabezados
$pdf->SetFillColor(200, 200, 200); // Color de fondo para los encabezados

$pdf->Cell(40, 6, 'Clave Producto', 1, 0, 'C', true);
$pdf->Cell(85, 6, 'Producto', 1, 0, 'C', true);
$pdf->Cell(40, 6, 'Color', 1, 0, 'C', true);
$pdf->Cell(30, 6, 'Existencias', 1, 1, 'C', true);

// Ejecutar el procedimiento
$query = "CALL obtener_productos()";
$resultado = $conexion->query($query);

// Verificar si hay productos
if ($resultado->num_rows > 0) {
    // Mostrar productos en el PDF
    while ($producto = $resultado->fetch_assoc()) {
        $nombre_producto_completo = $producto['NOMBRE_PRODUCTO'] . ' - ' . $producto['CARACTERISTICAS_PRODUCTO'] . ' - ' . $producto['DESCRIPCION_MARCA'];

        $pdf->SetFont('Arial', '', 6); // Letra para los datos
        $pdf->Cell(40, 6, $producto['CLAVE_PRODUCTO'], 1, 0, 'C');
        $pdf->Cell(85, 6, utf8_decode($nombre_producto_completo), 1, 0, '');
        $pdf->Cell(40, 6, utf8_decode($producto['DESCRIPCION_COLOR']), 1, 0, 'C');
        $pdf->Cell(30, 6, '', 1, 1, 'C'); // Aquí podrías ajustar la cantidad de existencias si está disponible
    }
} else {
    $pdf->Cell(0, 6, 'No se encontraron productos.', 0, 1, 'C');
}
$pdf->Ln(5); // Salto de línea

// Encabezado de la tabla (clave y ubicación)
$pdf->Cell(40, 6, 'Total de Productos:', 1, 0, '', true);
$pdf->Cell(40, 6, '', 1, 0, 'C'); // Celda vacía para clave
$pdf->Cell(60, 6, 'Total de Existencias:', 1, 0, '', true);
$pdf->Cell(55, 6, '', 1, 1, 'C'); // Celda vacía para ubicación

// Espacio antes de continuar con el inventario
$pdf->Ln(5); // Salto de línea

// Generar el nombre del archivo con la fecha actual
date_default_timezone_set('America/Mexico_City'); // Ajusta según tu ubicación
$fecha_actual = date('Y-m-d'); // Formato de fecha: Año-Mes-Día
$nombre_archivo = 'INVENTARIO_BODEGA_' . strtoupper($fecha_actual) . '.pdf'; // Convertir la fecha a mayúsculas

// Cerrar la conexión
$conexion->close();

// Salida del PDF con el nombre dinámico
$pdf->Output('I', $nombre_archivo); // 'I' para visualizar en el navegador
?>
