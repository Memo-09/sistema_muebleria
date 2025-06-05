<?php
// Incluir la librería FPDF
require './pdf/vendor/setasign/fpdf/fpdf.php';

// Incluir conexión a la base de datos
require 'conexion.php';

// Crear clase PDF que extiende FPDF
class PDF extends FPDF {
    function Header() {
        $this->Image('./assets/img/logo_santana_dd1.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'ESTADISTICAS DEL COLABORADOR', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Mueblería SANTANA SÁNCHEZ - Jilotepec, Edo. Méx'), 0, 0, 'C');
    }
}

// Crear el objeto PDF
$pdf = new PDF('P', 'mm', 'A4');  
$pdf->AddPage();

// Obtener datos enviados por GET
$colaborador_value = $_GET['colaborador_value'] ?? '';
$colaborador_texto = $_GET['colaborador_texto'] ?? '';
  

// Mostrar información antes de la tabla
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 6, utf8_decode('COLABORADOR: ' . $colaborador_texto), 0, 1, 'L');
$pdf->Ln(4);


// Llamar al procedimiento almacenado
$sql = "CALL ObtenerVentasPorColaboradorYDia(?, ?)";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, 'is', $colaborador_value, $dia_texto);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetFillColor(200, 200, 200); 

$pdf->Cell(15, 7, 'N. TARJETA', 1, 0, 'C', true);
$pdf->Cell(50, 7, 'NOMBRE', 1, 0, 'C', true);
$pdf->Cell(17, 7, 'RESTANTE', 1, 0, 'C', true);
$pdf->Cell(15, 7, 'ENGANCHE', 1, 0, 'C', true);
$pdf->Cell(20, 7, 'ENGANCHE P.', 1, 0, 'C', true);
$pdf->Cell(20, 7, 'RESTO ENG.', 1, 0, 'C', true);
$pdf->Cell(12, 7, 'PARCIAL', 1, 0, 'C', true);
$pdf->Cell(18, 7, 'ABONO', 1, 0, 'C', true);
$pdf->Cell(20, 7, 'INGRESO', 1, 1, 'C', true);

// Variables para totales
$total_abonos = 0;
$total_resto_enganche=0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $restante = $row['RESTANTE'];
        $abono = $row['PAGO_MINOMO'];
        $resto_enganche=$row['ENGANCHE'] - $row['ENGANCHE_DATO'];
        $parcialidad = $row['NUMERO_PARCIALIDAD'];  // Obtener la parcialidad

        if ($resto_enganche < 0) {
            $resto_enganche = 0;
        }
    
        // Si el restante es 0, cambia el color de la celda y el texto del abono
        if ($restante == 0) {
            // Color de fondo azul para toda la fila
            $pdf->SetFillColor(173, 216, 230); // Azul claro
            $abono_texto = 'LIQUIDADO';
            $ingreso_texto = 'NO AGREGAR';  // Texto en INGRESO
        } else {
            // Para otros días, muestra el abono y calcula el total
            $pdf->SetFillColor(255, 255, 255); // Color de fondo blanco
            $abono_texto = utf8_decode($abono);
            $ingreso_texto = '';  // Deja la celda de INGRESO en blanco
            // Si no está liquidado, sumar al total de abonos
            $total_abonos += $abono;
            $total_resto_enganche +=$resto_enganche;
        }
    
        // Validar si la parcialidad es 1, para poner la fila en rojo
        if ($parcialidad == 1) {
            $pdf->SetFillColor(255, 0, 0); // Fila en rojo
        }
    
        // Imprimir fila
        $pdf->Cell(15, 7, utf8_decode($row['ID_VENTA']), 1, 0, 'C', true);
        $pdf->Cell(50, 7, utf8_decode($row['NOMBRE'] . ' ' . $row['AP_P'] . ' ' . $row['AP_M']), 1, 0, 'C', true);
        $pdf->Cell(17, 7, utf8_decode($restante), 1, 0, 'C', true);
        $pdf->Cell(15, 7, utf8_decode($row['ENGANCHE']), 1, 0, 'C', true);
        $pdf->Cell(20, 7, utf8_decode($row['ENGANCHE_DATO']), 1, 0, 'C', true);
        $pdf->Cell(20, 7, utf8_decode($resto_enganche), 1, 0, 'C', true);
        $pdf->Cell(12, 7, utf8_decode($row['NUMERO_PARCIALIDAD']), 1, 0, 'C', true);
        $pdf->Cell(18, 7, $abono_texto, 1, 0, 'C', true);
        $pdf->Cell(20, 7, $ingreso_texto, 1, 1, 'C', true);

    
        // Restaurar el color de fondo para las filas siguientes
        $pdf->SetFillColor(255, 255, 255); // Restaura el color blanco para la siguiente fila
    }

    // Fila de subtotal
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(137, 7, 'SUBTOTAL DE DIA', 1, 0, 'R', true);

    // Establecer color de fondo a naranja solo para la celda de $total_resto_enganche
    $pdf->SetFillColor(255, 165, 0); // Naranja
    $pdf->Cell(12, 7, utf8_decode($total_resto_enganche), 1, 0, 'C', true);

    // Las demás celdas mantienen su color de fondo predeterminado
    $pdf->Cell(18, 7, utf8_decode($total_abonos), 1, 0, 'C', true);
    $pdf->Cell(20, 7, '', 1, 1, 'C', true);
} else {
    $pdf->Cell(0, 10, 'No se encontraron ventas para el colaborador y el día especificado.', 0, 1, 'C');
}

// Cerrar la conexión
mysqli_stmt_close($stmt);

// Generar el nombre del archivo
$nombre_colaborador = strtoupper(str_replace(' ', '_', $colaborador_texto));  
$archivo_pdf = "RENDIMIENTO_{$nombre_colaborador}_{$dia_texto}.pdf";  

// Mostrar el PDF en el navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $archivo_pdf . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

$pdf->Output('I', $archivo_pdf);
?>