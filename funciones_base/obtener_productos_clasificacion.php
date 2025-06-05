<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Verificar si se ha recibido el ID del colaborador
if (isset($_POST['idSucursal'])) {
    $idSucursal = $_POST['idSucursal'];

    // Preparar la consulta para ejecutar el procedimiento almacenado
    $query = "CALL obtenerProductosPorClasificacion(?)";
    
    // Preparar la declaración
    $stmt = mysqli_prepare($conexion, $query);
    
    if (!$stmt) {
        // Si ocurre un error al preparar la consulta
        echo json_encode(array('error' => 'Error al preparar la consulta: ' . mysqli_error($conexion)));
        exit;
    }

    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt, "i", $idSucursal);
    
    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        // Obtener el resultado
        $resultado = mysqli_stmt_get_result($stmt);
        
        // Crear un array para almacenar los resultados
        $clientes = array();
        
        // Recorrer los resultados y llenar el array
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $clientes[] = $fila;
        }
        
        // Convertir el array a formato JSON y devolverlo
        echo json_encode($clientes);
    } else {
        // Si ocurre un error en la ejecución
        echo json_encode(array('error' => 'Error al ejecutar el procedimiento almacenado: ' . mysqli_error($conexion)));
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
} else {
    // Si no se recibe el idColaborador
    echo json_encode(array('error' => 'No se recibió el ID del colaborador.'));
}
?>