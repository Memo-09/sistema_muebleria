<?php
// Conexión a la base de datos
include('../conexion.php');

// Obtener los datos enviados desde la solicitud AJAX
$idColaborador = $_POST['idColaborador'];
$idDia = $_POST['idDia'];

// Llamar al procedimiento almacenado para obtener las ventas
$query = "CALL ObtenerVentasColaborador(?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $idColaborador, $idDia); // Vincular los parámetros
$stmt->execute();
$result = $stmt->get_result();

// Crear un arreglo para almacenar las filas de resultados
$ventas = array();
while ($fila = $result->fetch_assoc()) {
    $ventas[] = $fila;
}

// Cerrar la conexión
$stmt->close();
$conexion->close();

// Devolver los datos como JSON
echo json_encode($ventas);
?>

