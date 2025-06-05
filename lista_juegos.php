<?php
// Incluir la librería FPDF
require './pdf/vendor/setasign/fpdf/fpdf.php';
require 'conexion.php'; // Archivo de conexión a la base de datos

// Clase personalizada para agregar encabezado y pie de página
class PDF extends FPDF {
    function Header() {
        $this->Image('./assets/img/logo_santana_dd1.png', 10, 10, 30);
        $this->SetFont('Arial', 'B', 7);
        $this->SetXY(10, 10);
        $this->Cell(0, 6, 'LISTA DE CONTENIDO DE JUEGOS', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 6);
        $this->Cell(0, 10, utf8_decode('Mueblería SANTANA SANCHEZ, Conocido Huertas, Jilotepec Edo Méx'), 0, 0, 'C');
    }
}

// Crear el objeto PDF
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 7);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(30, 6, 'ID Juego', 1, 0, 'C', true);
$pdf->Cell(60, 6, 'Nombre del Juego', 1, 0, 'C', true);
$pdf->Cell(100, 6, 'Productos Asociados', 1, 1, 'C', true);

// Llamar al procedimiento almacenado
$query = "CALL ObtenerJuegosConProductos()";
$resultado = $conexion->query($query);

if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($juego = $resultado->fetch_assoc()) {
            $idJuego = $juego['ID_JUEGO'];
            $nombreJuego = utf8_decode($juego['NOMBRE_JUEGO'] . " " . $juego['CARACTERISTICAS_JUEGO']);
            $productos = utf8_decode($juego['LISTA_PRODUCTOS']);

            // Dividir productos en líneas individuales
            $productosLista = explode("-", $productos);
            $productosFormateados = "";
            foreach ($productosLista as $producto) {
                if (!empty(trim($producto))) {
                    $productosFormateados .= trim($producto) . "\n";
                }
            }
            
            // Obtener altura necesaria según los productos
            $alturaCelda = max(6, substr_count($productosFormateados, "\n") * 4);

            // Guardar la posición Y antes de escribir la fila
            $yInicio = $pdf->GetY();

            // Imprimir las celdas alineadas
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(30, $alturaCelda, $idJuego, 1, 0, 'C');
            $pdf->Cell(60, $alturaCelda, $nombreJuego, 1, 0, 'L');
            
            // Guardar posición X antes de MultiCell
            $x = $pdf->GetX();
            $pdf->MultiCell(100, 4, $productosFormateados, 1, 'L');
            
            // Ajustar la posición para la siguiente fila
            $pdf->SetY($yInicio + $alturaCelda);
        }
    } else {
        $pdf->Cell(0, 6, 'No se encontraron juegos.', 0, 1, 'C');
    }
} else {
    echo "Error al ejecutar el procedimiento 'ObtenerJuegosConProductos': " . $conexion->error;
}

$conexion->close();

date_default_timezone_set('America/Mexico_City');
$fecha = date("Y-m-d");
$archivo_pdf = "LISTA_JUEGOS_$fecha.pdf";

$pdf->Output('I', $archivo_pdf);
?>

