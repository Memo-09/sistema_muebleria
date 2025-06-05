<?php
include('../conexion.php');

// Verificar los datos enviados por POST
$idSucursal = isset($_POST['idSucursal']) ? intval($_POST['idSucursal']) : 0;
$claveProducto = isset($_POST['claveProducto']) ? $_POST['claveProducto'] : '';
$nuevasExistencias = isset($_POST['nuevasExistencias']) ? intval($_POST['nuevasExistencias']) : 0;

// Validar que no falten datos
if ($idSucursal > 0 && !empty($claveProducto) && $nuevasExistencias > 0) {
    $mensaje = '';
    // Llamar al procedimiento almacenado
    $stmt = $conexion->prepare("CALL actualizar_existencias3(?, ?, ?, @mensaje)");
    $stmt->bind_param("isi", $idSucursal, $claveProducto, $nuevasExistencias);
    $stmt->execute();

    // Recuperar el mensaje de salida
    $result = $conexion->query("SELECT @mensaje AS mensaje");
    $row = $result->fetch_assoc();
    echo $row['mensaje'];
} else {
    echo "Error: Datos incompletos o inválidos.";
}
?>
