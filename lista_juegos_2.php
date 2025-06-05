<?php
// Incluir la librería FPDF
require './pdf/vendor/setasign/fpdf/fpdf.php';
require 'conexion.php'; // Archivo de conexión a la base de datos

// Clase personalizada para agregar encabezado y pie de página
class PDF extends FPDF {
    function Header() {
        $this->Image('./assets/img/logo_santana_dd1.png', 10, 10, 30);
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(10, 10);
        $this->Cell(0, 10, utf8_decode('LISTA DETALLADA DE JUEGOS'), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Mueblería SANTANA SANCHEZ, Conocido Huertas, Jilotepec Edo Méx'), 0, 0, 'C');
    }
}

// Crear el objeto PDF en formato horizontal (apaisado)
$pdf = new PDF('L', 'mm', 'Letter'); // Cambiar 'P' por 'L' para horizontal
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);

// Ejecutar la consulta para obtener los productos
$query = "CALL obtener_productos_por_clasificacion()";

if ($conexion->multi_query($query)) {
    // Primer resultado: Productos
    if ($resultadoProductos = $conexion->store_result()) {
        // Encabezados de la tabla para los productos
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(200, 200, 200);
        $pdf->Cell(30, 6, utf8_decode('Clave Producto'), 1, 0, 'C', true);
        $pdf->Cell(80, 6, utf8_decode('Nombre Producto'), 1, 0, 'C', true);  // Combinación de nombre y características
        $pdf->Cell(25, 6, utf8_decode('Precio Contado'), 1, 0, 'C', true);
        $pdf->Cell(40, 6, utf8_decode('Precio Credi Contado'), 1, 0, 'C', true);
        $pdf->Cell(30, 6, utf8_decode('Precio Crédito'), 1, 0, 'C', true);
        $pdf->Cell(25, 6, utf8_decode('Enganche'), 1, 0, 'C', true);
        $pdf->Cell(25, 6, utf8_decode('Comisión'), 1, 1, 'C', true);

        // Imprimir los productos obtenidos
        while ($producto = $resultadoProductos->fetch_assoc()) {
            $claveProducto = utf8_decode($producto['CLAVE_PRODUCTO']);
            $nombreProducto = utf8_decode($producto['NOMBRE_PRODUCTO']);
            $caracteristicas = utf8_decode($producto['CARACTERISTICAS_PRODUCTO']);
            $nombreYCaracteristicas = $nombreProducto . ' ' . $caracteristicas;
            
            // Formateo de los valores numéricos con dos decimales
            $precioContado = number_format($producto['PRECIO_CONTADO'], 2);
            $precioCrediContado = number_format($producto['PRECIO_CREDI_CONTADO'], 2);
            $precioCredito = number_format($producto['PRECIO_CREDITO'], 2);
            $enganche = number_format($producto['ENGANCHE'], 2);
            $comision = number_format($producto['COMISION'], 2);

            $pdf->SetFont('Arial', '', 7);
            $pdf->Cell(30, 6, $claveProducto, 1, 0, 'C');
            $pdf->Cell(80, 6, $nombreYCaracteristicas, 1, 0, 'L');  // Mostrar la combinación del nombre y las características
            $pdf->Cell(25, 6, $precioContado, 1, 0, 'C');
            $pdf->Cell(40, 6, $precioCrediContado, 1, 0, 'C');
            $pdf->Cell(30, 6, $precioCredito, 1, 0, 'C');
            $pdf->Cell(25, 6, $enganche, 1, 0, 'C');
            $pdf->Cell(25, 6, $comision, 1, 1, 'C');
        }

        // Liberar el resultado de productos
        $resultadoProductos->free();
    } else {
        echo "Error al ejecutar el procedimiento 'obtener_productos_por_clasificacion': " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();

    // Generar el PDF
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d");
    $archivo_pdf = "LISTA_DETALLADA_DE_JUEGOS_$fecha.pdf";
    $pdf->Output('I', $archivo_pdf);
} else {
    echo "Error al ejecutar las consultas: " . $conexion->error;
}
?>
