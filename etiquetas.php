<?php
require './pdf/vendor/setasign/fpdf/fpdf.php';

// Establecer la conexión a la base de datos
require 'conexion.php';

class PDF extends FPDF {
    function Header() {
        // Configurar el encabezado
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'ETIQUETAS', 0, 1, 'C');
        $this->Ln(5);
    }

    function generarTabla($nombre, $marca, $credito, $credi_contado, $contado, $enganche, $comision) {
        // Configurar la fuente para la tabla
        $this->SetFont('Times', '', 10);

        // Definir el ancho de las columnas
        $ancho_columna1 = 130;
        $ancho_columna2 = 60;

        // Fila principal que abarca las dos columnas (PRODUCTO) y la imagen
        $this->SetFont('Times', 'B', 11); // Fuente en negrita para el título
        
        // Colocar la imagen a la izquierda (por ejemplo, con un tamaño de 30x30)
        $this->Image('./assets/img/logo_santana_dd1.png', 10, $this->GetY(), 30, 10); 
        
        // Mover el puntero de la posición Y para colocar el texto al lado de la imagen
        $this->SetXY(40, $this->GetY() - 3); // Ajustamos la posición para colocar el texto a la derecha de la imagen
        $this->Cell($ancho_columna1 + $ancho_columna2 - 55, 15, "DETALLE DEL PRODUCTO", 0, 1, 'C'); // Fila que abarca las dos columnas

        // Colocar los datos en las dos columnas alternadamente
        $this->SetFont('Times', '', 10); // Volver a la fuente normal

        // Primera columna: NOMBRE: LAVADORA
        $this->Cell($ancho_columna1, 10, "NOMBRE: " . $nombre, 0, 0, 'L'); // Columna 1 sin borde
        $this->Cell($ancho_columna2, 10, "MARCA: " . $marca, 0, 1, 'L'); // Columna 2 sin borde
        
        // Segunda fila: CREDITO y CREDI-CONTADO
        $this->Cell($ancho_columna1, 10, "CREDITO: $" . number_format($credito, 2), 0, 0, 'L'); // Columna 1 sin borde
        $this->Cell($ancho_columna2, 10, "CREDI-CONTADO: $" . number_format($credi_contado, 2), 0, 1, 'L'); // Columna 2 sin borde
        
        // Tercera fila: ENGANCHE
        $this->Cell($ancho_columna1, 10, 'CONTADO: $'. number_format($contado, 2), 0, 0, 'L'); // Columna 2 vacía y sin borde
        $this->Cell($ancho_columna2, 10, "ENGANCHE: $" . number_format($enganche, 2), 0, 1, 'L'); // Columna 1 sin borde

        // Cuarta Fila Pago Semanal
        $this->Cell($ancho_columna1, 10, 'PAGO SEMANAL: $'. number_format($comision, 2), 0, 0, 'L'); // Columna 2 vacía y sin borde
        $this->Ln(8);

        // Dibujar el contorno exterior de la tabla para este producto
        $this->Rect(10, $this->GetY() - 50, 190, 50);  // Rectángulo con posición ajustada
    }

    // Función para dibujar el borde exterior de la tabla (opcional si lo usas para todas)
    function drawTableBorder() {
        // Este método ya no se necesita, ya que ahora dibujamos el borde dentro de la función generarTabla()
    }
}

// Consulta a la base de datos para obtener los productos y marcas
$sql = "CALL ObtenerProductosConMarcas()";
$result = mysqli_query($conexion, $sql);

// Crear una instancia del objeto PDF
$pdf = new PDF();

// Agregar una página
$pdf->AddPage();

// Contador de productos
$contador = 0;

// Recorrer los resultados de la consulta y pasarlos a la función generarTabla
while ($row = mysqli_fetch_assoc($result)) {
    // Si se ha mostrado 5 productos, agregar una nueva página
    if ($contador == 4) {
        $pdf->AddPage(); // Nueva página
        $contador = 0; // Reiniciar el contador
    }

    // Llamada a la función generarTabla con los datos
    $pdf->generarTabla(
        $row['NOMBRE_PRODUCTO']." ".$row['CARACTERISTICAS_PRODUCTO'], 
        $row['DESCRIPCION_MARCA'], 
        $row['PRECIO_CREDITO'], 
        $row['PRECIO_CREDI_CONTADO'],
        $row['PRECIO_CONTADO'],  
        $row['ENGANCHE'],
        $row['COMISION']
    );

    // Incrementar el contador
    $contador++;
}

// Salida del archivo PDF
$pdf->Output();

// Cerrar la conexión
mysqli_close($conexion);
?>
























