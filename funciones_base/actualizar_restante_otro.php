<?php
// Incluye tu archivo de conexión a la base de datos
include('../conexion.php');

// Verificar si los parámetros necesarios están presentes
if (isset($_POST['idVenta']) && isset($_POST['anticipo']) && isset($_POST['nuevoRestante'])) {
    // Obtener los valores desde el formulario (POST)
    $idVenta = $_POST['idVenta'];
    $anticipo = $_POST['anticipo'];
    $nuevoRestante = $_POST['nuevoRestante'];

    // Intentar ejecutar el procedimiento almacenado
    try {
        // Preparar la consulta para ejecutar el procedimiento almacenado
        $stmt = $conexion->prepare("CALL ActualizarRestanteYAgregarAnticipo(?, ?, ?)");
        
        // Vincular los parámetros
        $stmt->bind_param("idd", $idVenta, $anticipo, $nuevoRestante);  // "i" para integer, "d" para double
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Si se ejecutó correctamente, devolver un mensaje de éxito
            echo "Anticipo guardado y restante actualizado correctamente.";
        } else {
            // Si ocurrió algún error, mostrar un mensaje de error
            echo "Error al actualizar el restante o guardar el anticipo: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } catch (Exception $e) {
        // Si ocurre un error con el procedimiento almacenado, capturarlo y mostrar el mensaje
        echo "Error: " . $e->getMessage();  // Esto mostrará el mensaje del SIGNAL SQLSTATE lanzado en el procedimiento
    }
} else {
    // Si faltan los parámetros, mostrar un error
    echo "Faltan parámetros necesarios.";
}

// Cerrar la conexión
$conexion->close();
?>



