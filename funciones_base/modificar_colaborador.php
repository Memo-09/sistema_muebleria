<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Verificar si los datos han sido enviados mediante POST
if (isset($_POST['idColaborador'], $_POST['nombre'], $_POST['apP'], $_POST['apM'], $_POST['descripcionRol'])) {
    
    // Obtener los datos enviados
    $idColaborador = $_POST['idColaborador'];
    $nombre = $_POST['nombre'];
    $apP = $_POST['apP'];
    $apM = $_POST['apM'];
    $descripcionRol = $_POST['descripcionRol'];

    // Preparar la consulta UPDATE para actualizar los datos del colaborador
    $sql = "UPDATE colaboradores 
            SET 
                NOMBRE = ?, 
                AP_P = ?, 
                AP_M = ?, 
                ID_ROL = (SELECT ID_ROL FROM roles WHERE DESCRIPCION_ROL = ? LIMIT 1) 
            WHERE ID_COLABORADOR = ?";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param("ssssi", $nombre, $apP, $apM, $descripcionRol, $idColaborador); // 's' para string, 'i' para integer

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Colaborador con ID $idColaborador actualizado correctamente.";
        } else {
            // Si ocurre un error, mostrarlo
            echo "Error al actualizar el colaborador: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }

} else {
    echo "Faltan datos para realizar la actualización.";
}

// Cerrar la conexión
$conexion->close();
?>




