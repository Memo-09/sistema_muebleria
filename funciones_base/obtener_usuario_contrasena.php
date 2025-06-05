<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Obtener los valores del formulario (nombre, apellido1, apellido2)
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];

// Preparar la consulta para llamar al procedimiento almacenado
$query = "CALL ObtenerUsuarioPorNombre(?, ?, ?)";

// Preparar la sentencia
$stmt = $conexion->prepare($query);

// Vincular los parámetros a la consulta
$stmt->bind_param("sss", $nombre, $apellido1, $apellido2);

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener los datos
    $row = $result->fetch_assoc();

    // Enviar los datos como JSON
    echo json_encode([
        'success' => true,
        'usuario' => $row['USUARIO'],
        'contrasena' => $row['CONTRASENA']
    ]);
} else {
    // Si no se encuentra el usuario
    echo json_encode([
        'success' => false,
        'message' => 'No se encontró el usuario.'
    ]);
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>


