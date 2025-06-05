<?php
include('../conexion.php');

$idVenta = $_POST['idVenta'];
$consulta = "CALL obtener_abonos_por_venta($idVenta)";
$resultado = mysqli_query($conexion, $consulta);

$datos = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $datos[] = [
        'fecha' => $fila['FECHA_BONO'],
        'abono' => $fila['ABONO_DINERO']
    ];
}

mysqli_next_result($conexion);
mysqli_close($conexion);

echo json_encode($datos);
?>
