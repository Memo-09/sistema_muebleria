<?php
require './pdf/vendor/setasign/fpdf/fpdf.php';
require 'conexion.php';

class PDF extends FPDF {
    function Header() {
        $this->Image('./assets/img/logo_santana_dd1.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'INFORME DE MOROSIDAD DEL CLIENTE', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Mueblería SANTANA SÁNCHEZ - Jilotepec, Edo. Méx'), 0, 0, 'C');
    }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();

// Ejecutar procedimiento almacenado
$sql = "CALL sp_semanas_sin_abono();";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Encabezados de tabla
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetFillColor(200, 200, 200);

$pdf->Cell(25, 7, 'N.CREDITO', 1, 0, 'C', true);
$pdf->Cell(65, 7, 'NOMBRE', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'ULTIMA FECHA', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'SEMS. SIN ABONAR', 1, 0, 'C', true);
$pdf->Cell(45, 7, 'ESTATUS', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 6);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Asignar color por ESTATUS
        switch ($row['ESTATUS']) {
            case 'CORRIENTE':
                $pdf->SetFillColor(255, 255, 153); // Amarillo claro
                break;
            case 'TOLERANCIA':
                $pdf->SetFillColor(144, 238, 144); // Verde claro
                break;
            case 'GARANTÍA BLOQUEADA':
                $pdf->SetFillColor(255, 204, 153); // Naranja claro
                break;
            case 'CONVENIO EN PROCESO':
                $pdf->SetFillColor(173, 216, 230); // Azul claro
                break;
            case 'DEUDOR, NO PUEDE HACER VENTAS':
                $pdf->SetFillColor(255, 160, 122); // Rojo claro
                break;
            default:
                $pdf->SetFillColor(255, 255, 255); // Blanco
        }

        // Mostrar fila con fondo de color
        $pdf->Cell(25, 6, utf8_decode($row['ID_VENTA']), 1, 0, 'C', true);
        $pdf->Cell(65, 6, utf8_decode($row['NOMBRE_COMPLETO']), 1, 0, 'L', true);
        $pdf->Cell(30, 6, utf8_decode($row['ULTIMO_ABONO']), 1, 0, 'C', true);
        $pdf->Cell(25, 6, utf8_decode($row['SEMANAS_SIN_ABONO']), 1, 0, 'C', true);
        $pdf->Cell(45, 6, utf8_decode($row['ESTATUS']), 1, 1, 'C', true);
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron datos de morosidad.', 0, 1, 'C');
}

// Cierre
mysqli_stmt_close($stmt);

// Nombre del archivo
$archivo_pdf = "RE_MOROSIDAD_" . date('Ymd_His') . ".pdf";

// Salida en el navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $archivo_pdf . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

$pdf->Output('I', $archivo_pdf);
?>





