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
        $this->Cell(0, 6, 'LISTA DE PRODUCTOS POR SUCURSAL', 0, 1, 'C');
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

// Obtener el ID de la sucursal desde el parámetro GET
$idSucursal = isset($_GET['idSucursal']) ? $_GET['idSucursal'] : null;
$ubicacion = isset($_GET['ubicacion']) ? $_GET['ubicacion'] : null;

if ($idSucursal) {
    // Crear el objeto PDF en orientación vertical ('P') y tamaño carta
    $pdf = new PDF('P', 'mm', 'Letter'); // 'P' = Portrait (vertical)
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 7); // Letra para los datos

    // Obtener los productos de la sucursal usando el procedimiento almacenado
    $query_productos = "CALL ObtenerProductosCentroOperaciones(?)"; // Llamar al procedimiento con el parámetro
    $stmt_productos = $conexion->prepare($query_productos);
    $stmt_productos->bind_param("i", $idSucursal); // Usando el ID de la sucursal como parámetro
    $stmt_productos->execute();
    $resultado_productos = $stmt_productos->get_result();

    // Imprimir la clave de la sucursal
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(0, 6, 'Clave de la Sucursal: ' . utf8_decode($idSucursal), 0, 1);
    $pdf->Cell(0, 6, 'Ubicacion: ' . utf8_decode($ubicacion), 0, 1);
    $pdf->Ln(5); // Espacio después de la clave de sucursal

    // Establecer la fuente para los encabezados de la tabla
    $pdf->SetFont('Arial', 'B', 6); // Letra para los encabezados
    $pdf->SetFillColor(200, 200, 200); // Color de fondo para los encabezados

    // Ancho total de la página: 210mm (tamaño carta en orientación vertical)
    $ancho_total = 190; // Dejar algo de margen en los laterales (20mm)

    // Definir el ancho de las celdas (puedes ajustar estos valores)
    $pdf->Cell(20, 6, 'Clave', 1, 0, 'C', true);
    $pdf->Cell(80, 6, 'Producto', 1, 0, 'C', true);
    $pdf->Cell(30, 6, 'Marca', 1, 0, 'C', true);
    $pdf->Cell(30, 6, 'Color', 1, 0, 'C', true);
    $pdf->Cell(30, 6, 'Existencias', 1, 1, 'C', true);

    // Inicializar contador de productos y existencias
    $contador_productos = 0;
    $total_existencias = 0;

    while ($fila = $resultado_productos->fetch_assoc()) {
        // Concatenar nombre del producto con características
        $nombre_con_caracteristicas = utf8_decode($fila['NOMBRE_PRODUCTO'] . ' ' . $fila['CARACTERISTICAS_PRODUCTO']);

        // Limitar el texto a 44 caracteres y agregar '...' si es más largo
        if (strlen($nombre_con_caracteristicas) > 44) {
            $nombre_con_caracteristicas = substr($nombre_con_caracteristicas, 0, 50) . '...';
        }

        // Establecer color de fondo blanco sin cambios
        $pdf->SetFillColor(255, 255, 255); // Color de fondo blanco

        // Agregar los datos al PDF
        $pdf->Cell(20, 6, utf8_decode($fila['CLAVE_PRODUCTO']), 1, 0, 'C', true);
        $pdf->Cell(80, 6, $nombre_con_caracteristicas, 1, 0, 'L', true);
        $pdf->Cell(30, 6, utf8_decode($fila['DESCRIPCION_MARCA']), 1, 0, 'C', true);
        $pdf->Cell(30, 6, utf8_decode($fila['DESCRIPCION_COLOR']), 1, 0, 'C', true);
        $pdf->Cell(30, 6, utf8_decode($fila['EXISTENCIAS']), 1, 1, 'C', true);

        // Incrementar el contador de productos y acumular las existencias
        $contador_productos++;
        $total_existencias += $fila['EXISTENCIAS'];

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
    $archivo_pdf = "LISTA_PRODUCTOS_SUCUARSAL_{$idSucursal}_$fecha.pdf";

    // Agregar el total de productos y existencias al final
    $pdf->Ln(5); // Espacio antes de la línea de total
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(0, 6, "Total de productos: $contador_productos", 0, 1, 'C');
    $pdf->Cell(0, 6, "Total de existencias: $total_existencias", 0, 1, 'C');

    // Salida del PDF al navegador
    $pdf->Output('I', $archivo_pdf); // 'I' para visualizar en el navegador
} else {
    echo "ID de sucursal no proporcionado.";
}
?>
