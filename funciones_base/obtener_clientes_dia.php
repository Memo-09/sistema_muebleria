<?php
// Incluir la conexión a la base de datos
require_once('../conexion.php');

// Verificar si se han recibido los parámetros necesarios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idColaborador = $_POST['idColaborador'] ?? null;
    $idDia = $_POST['idDia'] ?? null;
    // Verificar que los parámetros no sean nulos
    if ($idColaborador !== null && $idDia !== null) {
        // Preparar la llamada al procedimiento almacenado
        $query = "CALL ObtenerClienteColaboradorDia(?, ?)";

        if ($stmt = mysqli_prepare($conexion, $query)) {
            // Enlazar los parámetros
            mysqli_stmt_bind_param($stmt, 'ii', $idColaborador, $idDia);

            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);

            // Obtener el resultado
            $resultado = mysqli_stmt_get_result($stmt);

            // Verificar si hay resultados
            $clientes = [];
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $clientes[] = $fila;
            }

            // Cerrar la sentencia
            mysqli_stmt_close($stmt);

            // Devolver los resultados en formato JSON
            echo json_encode($clientes);
        } else {
            // Si la consulta no se prepara correctamente
            echo json_encode(["error" => "Error al preparar la consulta"]);
        }
    } else {
        echo json_encode(["error" => "Faltan parámetros"]);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    echo "<script>alert('Método no permitido');</script>";
}
