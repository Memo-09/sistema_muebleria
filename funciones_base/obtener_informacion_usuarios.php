<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Asegurar que la respuesta es JSON

include('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];

    $sql = "CALL ObtenerUsuarioDetalles(?)"; // Llamar al procedimiento almacenado
    $stmt = $conexion->prepare($sql);
    
    if ($stmt === false) {
        echo json_encode(["error" => "Error en la preparación de la consulta"]);
        exit;
    }

    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row); // Enviar la respuesta en formato JSON
    } else {
        echo json_encode(["error" => "No se encontraron datos"]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["error" => "Solicitud inválida"]);
}
?>

