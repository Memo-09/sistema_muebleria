<?php
// Incluir la librería FPDF
require './pdf/vendor/setasign/fpdf/fpdf.php';
require 'conexion.php'; // Tu archivo de conexión a la base de datos

// Crear la clase personalizada para agregar el pie de página y encabezado en todas las páginas
class PDF extends FPDF {
    // Sobrecargar el método Header()
    function Header() {
        // Agregar la imagen al PDF (ajustando la posición y el tamaño)
        $this->Image('./assets/img/logo_santana_dd1.png', 10, 10, 30); // 10mm de margen a la izquierda, 10mm de margen desde arriba, 30mm de ancho
        
        // Establecer la fuente para el título
        $this->SetFont('Arial', 'B', 7);
        $this->SetXY(10, 10); // Cambiar la posición del título para que no se sobreponga con la imagen
        $this->Cell(0, 6, 'LISTA DE PRODUCTOS', 0, 1, 'C');
        $this->Ln(5); // Espacio después del título

        // Establecer la fuente para los encabezados de la tabla
        $this->SetFont('Arial', 'B', 7); // Letra para los encabezados
        $this->SetFillColor(200, 200, 200); // Color de fondo para los encabezados
        
        // Encabezados de la tabla
        $this->Cell(20, 6, 'Clave', 1, 0, 'C', true);
        $this->Cell(85, 6, 'Producto', 1, 0, 'C', true);
        $this->Cell(30, 6, 'Marca', 1, 0, 'C', true);
        $this->Cell(25, 6, 'Color', 1, 0, 'C', true);
        $this->Cell(20, 6, 'Contado', 1, 0, 'C', true);
        $this->Cell(22, 6, 'CrediContado', 1, 0, 'C', true);
        $this->Cell(20, 6, 'Credito', 1, 0, 'C', true);
        $this->Cell(18, 6, 'Enganche', 1, 0, 'C', true);
        $this->Cell(18, 6, 'Comision', 1, 1, 'C', true);
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

// Crear el objeto PDF en orientación horizontal y tamaño carta
$pdf = new PDF('L', 'mm', 'Letter'); // 'L' = Landscape (horizontal)
$pdf->AddPage();
$pdf->SetFont('Arial', '', 7); // Letra para los datos

// Obtener los datos desde la base de datos usando el procedimiento almacenado
$query = "CALL listaproductos()";
$resultado = $conexion->query($query);

// Inicializar contador de productos
$contador_productos = 0;

while ($fila = $resultado->fetch_assoc()) {
    // Concatenar nombre del producto con características
    $nombre_con_caracteristicas = utf8_decode($fila['NOMBRE_PRODUCTO'] . ' ' . $fila['CARACTERISTICAS_PRODUCTO'] . '');

    // Limitar el texto a 44 caracteres y agregar '...' si es más largo
    if (strlen($nombre_con_caracteristicas) > 44) {
        $nombre_con_caracteristicas = substr($nombre_con_caracteristicas, 0, 50) . '...';
    }

    // Establecer color de fondo blanco sin cambios
    $pdf->SetFillColor(255, 255, 255); // Color de fondo blanco

    // Agregar los datos al PDF
    $pdf->Cell(20, 6, utf8_decode($fila['CLAVE_PRODUCTO']), 1, 0, 'C', true);
    $pdf->Cell(85, 6, $nombre_con_caracteristicas, 1, 0, 'L', true);
    $pdf->Cell(30, 6, utf8_decode($fila['DESCRIPCION_MARCA']), 1, 0, 'C', true);
    $pdf->Cell(25, 6, utf8_decode($fila['DESCRIPCION_COLOR']), 1, 0, 'C', true);
    $pdf->Cell(20, 6, '$' . number_format($fila['PRECIO_CONTADO'], 2), 1, 0, 'C', true);
    $pdf->Cell(22, 6, '$' . number_format($fila['PRECIO_CREDI_CONTADO'], 2), 1, 0, 'C', true);
    $pdf->Cell(20, 6, '$' . number_format($fila['PRECIO_CREDITO'], 2), 1, 0, 'C', true);
    $pdf->Cell(18, 6, '$' . number_format($fila['ENGANCHE'], 2), 1, 0, 'C', true);
    $pdf->Cell(18, 6, '$' . number_format($fila['COMISION'], 2), 1, 1, 'C', true);

    // Incrementar el contador de productos
    $contador_productos++;

    // Comprobar si el total de filas alcanza el límite para una página y agregar una nueva página
    if ($pdf->GetY() > 250) {
        $pdf->AddPage();
    }
}

// Cerrar conexión
$conexion->close();

// Definir el nombre del archivo con la fecha de hoy
date_default_timezone_set('America/Mexico_City'); // Ajusta según tu ubicación
$fecha = date("Y-m-d");
$archivo_pdf = "LISTA_PRODUCTOS_$fecha.pdf";

// Agregar el total de productos al final
$pdf->Ln(5); // Espacio antes de la línea de total
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(0, 6, "Total de productos: $contador_productos", 0, 1, 'C');

// Salida del PDF al navegador
$pdf->Output('I', $archivo_pdf); // 'I' para visualizar en el navegador
?>
