<?php
// Incluye el archivo de conexión a la base de datos
require_once '../conexion.php'; // Asegúrate de que este archivo tiene la conexión a la BD

// Verifica que la solicitud sea un POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener los datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $caracteristicas = isset($_POST['caracteristicas']) ? $_POST['caracteristicas'] : null;
    $clave = isset($_POST['clave']) ? $_POST['clave'] : null;
    $precioContado = isset($_POST['precioContado']) ? $_POST['precioContado'] : 0;
    $precioCrediContado = isset($_POST['precioCrediContado']) ? $_POST['precioCrediContado'] : 0;
    $precioCredito = isset($_POST['precioCredito']) ? $_POST['precioCredito'] : 0;
    $enganche = isset($_POST['enganche']) ? $_POST['enganche'] : 0;
    $comision = isset($_POST['comision']) ? $_POST['comision'] : 0;
    $productos = isset($_POST['productos']) ? json_decode($_POST['productos'], true) : []; // Obtener el arreglo de productos con clave y cantidad

    // Validar que los campos no estén vacíos
    if (!$nombre || !$caracteristicas || !$clave) {
        echo json_encode([
            'success' => false,
            'message' => 'Por favor, ingrese todos los campos requeridos.'
        ]);
        exit;
    }

    // Iniciar la transacción
    mysqli_begin_transaction($conexion);

    try {
        // Insertar el juego
        $sqlJuego = "CALL insertarJuegoProducto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtJuego = mysqli_prepare($conexion, $sqlJuego);
        mysqli_stmt_bind_param(
            $stmtJuego,
            'ssssssssdd',
            $nombre,              // p_nombre_juego
            $caracteristicas,     // p_caracteristicas_juego
            $clave,               // p_clave_producto
            $nombre,              // p_nombre_producto
            $caracteristicas,     // p_caracteristicas_producto
            $precioContado,       // p_precio_contado
            $precioCrediContado,  // p_precio_credi_contado
            $precioCredito,       // p_precio_credito
            $enganche,            // p_enganche
            $comision             // p_comision
        );

        // Ejecutar el procedimiento para insertar el juego
        if (!mysqli_stmt_execute($stmtJuego)) {
            throw new Exception('Error al insertar el juego: ' . mysqli_error($conexion));
        }

        // Insertar los productos asociados a cada ID
        foreach ($productos as $producto) {
            $idProducto = $producto['id'];
            $cantidadProducto = $producto['cantidad'];

            // Insertar cada producto con la clave y cantidad usando el procedimiento insertado
            $sqlProducto = "CALL insertarJuegoProductos(?, ?)";
            $stmtProducto = mysqli_prepare($conexion, $sqlProducto);
            mysqli_stmt_bind_param($stmtProducto, 'si', $idProducto, $cantidadProducto);

            // Ejecutar el procedimiento para insertar cada producto
            if (!mysqli_stmt_execute($stmtProducto)) {
                throw new Exception('Error al insertar el producto con ID ' . $idProducto . ': ' . mysqli_error($conexion));
            }
        }

        // Confirmar la transacción
        mysqli_commit($conexion);
        echo json_encode([
            'success' => true,
            'message' => 'Juego y productos insertados correctamente.'
        ]);
    } catch (Exception $e) {
        // En caso de error, revertir la transacción
        mysqli_rollback($conexion);
        echo json_encode([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>





