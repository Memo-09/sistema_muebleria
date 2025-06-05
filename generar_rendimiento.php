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
        $this->Cell(0, 10, 'RENDIMIENTO DEL COLABORADOR', 0, 1, 'C');
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
$dia_texto = $_GET['dia_texto'] ?? '';
  

// Mostrar información antes de la tabla
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 6, utf8_decode('COLABORADOR: ' . $colaborador_texto), 0, 1, 'L');
$pdf->Cell(0, 6, utf8_decode('DIA: ' . $dia_texto), 0, 1, 'L');
$pdf->Ln(4);


$dias_semana = [
    "LUNES" => 1,
    "MARTES" => 2,
    "MIERCOLES" => 3,
    "JUEVES" => 4,
    "VIERNES" => 5,
    "SABADO" => 6,
    "DOMINGO" => 7
];

// Verificar si el día es válido
if (array_key_exists($dia_texto, $dias_semana)) {
    // Obtener el número correspondiente al día
    $numero_dia = $dias_semana[$dia_texto];

    // Obtener la fecha actual
    $fecha_actual = new DateTime();

    // Calcular el día de la semana actual
    $dia_actual = $fecha_actual->format('N'); // 1 = Lunes, 7 = Domingo

    // Calcular la diferencia entre el día actual y el día deseado
    $diferencia_dias = $numero_dia - $dia_actual;

    // Si el día ya pasó en esta semana, sumamos 7 días
    if ($diferencia_dias < 0) {
        $diferencia_dias += 7;
    }

    // Sumar la diferencia de días a la fecha actual
    $fecha_actual->modify("$diferencia_dias day");

    // Obtener la fecha en formato Y-m-d
    $fecha = $fecha_actual->format('Y-m-d');
} else {
    $fecha = 'Día no válido';  // En caso de que el día no sea válido
}

$pdf->SetFont('Arial', 'B', 7);

// Establecer el color de fondo (gris)
// Establecer el color de fondo (gris)
$pdf->SetFillColor(192, 192, 192);  // Color gris (valor RGB)

// Encabezados de la tabla
$pdf->Cell(20, 6, 'FECHA:', 1, 0, 'L', true);  // Primera celda con "Fecha" y fondo gris
$pdf->Cell(40, 6, $fecha, 1, 1, 'C', true);    // Segunda celda con la fecha calculada y fondo gris
$pdf->Ln(5);

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

// Si no es "quincenales", "semanales" o "mensuales", se agregan las siguientes tablas
if ($dia_texto != 'QUINCENALES' && $dia_texto != 'SEMANALES' && $dia_texto != 'MENSUALES') {
    // Agregar una segunda tabla "TARJETAS DE ANTERIORES DIAS"
    $pdf->AddPage(); // Nueva página para la tabla

    // Título de la segunda tabla
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(0, 10, 'TARJETAS DE ANTERIORES DIAS', 0, 1, 'C');
    $pdf->Ln(5);

    // Encabezados de la segunda tabla con un solo bloque de columnas
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(200, 200, 200); 

    // Bloque de columnas (sin segundo bloque)
    $pdf->Cell(23, 7, 'DIA', 1, 0, 'C', true);
    $pdf->Cell(23, 7, 'N. TARJETA', 1, 0, 'C', true);
    $pdf->Cell(23, 7, 'ABONO', 1, 0, 'C', true);
    $pdf->Cell(24, 7, 'INGRESO', 1, 0, 'C', true);
    $pdf->Cell(23, 7, 'DIA', 1, 0, 'C', true);
    $pdf->Cell(23, 7, 'N. TARJETA', 1, 0, 'C', true);
    $pdf->Cell(23, 7, 'ABONO', 1, 0, 'C', true);
    $pdf->Cell(24, 7, 'INGRESO', 1, 1, 'C', true);

    // Agregar las filas de datos (simulación de las filas para esta tabla)
    for ($i = 0; $i < 25; $i++) {
        // Primer bloque de datos
        $pdf->SetFillColor(173, 216, 230); // Azul claro para el día
        $pdf->Cell(23, 7, '', 1, 0, 'C', true); // Celda del DIA en azul claro
        $pdf->SetFillColor(255, 255, 255); // Blanco para las demás celdas
        $pdf->Cell(23, 7, '', 1, 0, 'C', true); // N. TARJETA
        $pdf->Cell(23, 7, '', 1, 0, 'C', true); // ABONO
        $pdf->Cell(24, 7, '', 1, 0, 'C', true); // INGRESO
        
        // Segundo bloque de datos (continuación en la misma fila)
        $pdf->SetFillColor(173, 216, 230); // Azul claro para el día
        $pdf->Cell(23, 7, '', 1, 0, 'C', true); // Celda del DIA en azul claro
        $pdf->SetFillColor(255, 255, 255); // Blanco para las demás celdas
        $pdf->Cell(23, 7, '', 1, 0, 'C', true); // N. TARJETA
        $pdf->Cell(23, 7, '', 1, 0, 'C', true); // ABONO
        $pdf->Cell(24, 7, '', 1, 1, 'C', true); // INGRESO
    }
    
    // Agregar el subtítulo "SUBTOTAL DE LAS TARJETAS FUERA DEL RENDIMIENTO"
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(162, 7, 'SUBTOTAL FUERA DEL RENDIMIENTO', 1, 0, 'R', true);
    $pdf->Cell(24, 7, '', 1, 1, 'C', true); // Celda vacía para el subtotal
    $pdf->Ln(5);
    
    // Encabezados de la última tabla
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(200, 200, 200); // Color gris claro para el encabezado
    
    // Crear la fila de encabezados
    $pdf->Cell(62, 7, 'SUBTOTAL POR T.DEL DIA', 1, 0, 'C', true);
    $pdf->Cell(62, 7, 'SUBTOTAL POR T. ANTERIORES', 1, 0, 'C', true);
    $pdf->Cell(62, 7, 'TOTAL', 1, 1, 'C', true);
    
    // Filas de datos (vacías por ahora, para los totales)
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetFillColor(255, 255, 255); // Blanco para las celdas
    
    // Primera fila con celdas vacías para los totales
    $pdf->Cell(62, 7, '', 1, 0, 'C', true); // Subtotal de tarjetas del día
    $pdf->Cell(62, 7, '', 1, 0, 'C', true); // Subtotal por tarjetas anteriores
    $pdf->Cell(62, 7, '', 1, 1, 'C', true); // Total




    $pdf->AddPage(); // Nueva página para la tabla
    // Título de la segunda tabla
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(0, 10, 'VALES DE ENTRADA Y SALIDA DE PRODUCTOS', 0, 1, 'C');
    $pdf->Ln(5);

    // Encabezados de la segunda tabla con un solo bloque de columnas
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->SetFillColor(200, 200, 200); 

    // Bloque de columnas (sin segundo bloque)
    $pdf->Cell(50, 7, 'DESCRIPCION DEL PRODUCTO', 1, 0, 'C', true);
    $pdf->Cell(20, 7, 'CANTIDAD', 1, 0, 'C', true);
    $pdf->Cell(60, 7, 'MOTIVO', 1, 0, 'C', true);
    $pdf->Cell(60, 7, 'NUMERO DE BODEGA O SUCURSAL', 1, 0, 'C', true);

    // Agregar un salto de línea después del encabezado
    $pdf->Ln();

    // Ahora, se generan las filas de datos
    for ($i = 0; $i < 25; $i++) {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(50, 7, '', 1, 0, 'C', true); // Celda del DIA en azul claro
        $pdf->Cell(20, 7, '', 1, 0, 'C', true); // N. TARJETA
        $pdf->Cell(15, 7, 'VENDIDO', 1, 0, 'C', true); // ABONO
        $pdf->Cell(15, 7, '(     )', 1, 0, 'C', true); // ABONO
        $pdf->Cell(15, 7, 'REGRESAD.', 1, 0, 'C', true); // ABONO
        $pdf->Cell(15, 7, '(     )', 1, 0, 'C', true); // ABONO
        $pdf->Cell(30, 7, 'BOD:', 1, 0, 'L', true); // INGRESO
        $pdf->Cell(30, 7, 'SUC:', 1, 0, 'L', true); // INGRESO
        
        // Agregar un salto de línea después de cada fila
        $pdf->Ln();
    }

    // Salto de línea después del ticket para dejar espacio
    $pdf->Ln(10);

    // Texto formal para engrapar el ticket
    $pdf->SetFont('Arial', 'I', 8); // Fuente en cursiva, tamaño 10
    $pdf->MultiCell(120, 5, utf8_decode("Engrapar el ticket de gasolina, reparación u otros gastos en esta sección de la hoja, correspondiente a la transacción realizada. Asegúrese de que incluya todos los detalles necesarios para los conceptos involucrados en el gasto."), 0, 'L');
}

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



