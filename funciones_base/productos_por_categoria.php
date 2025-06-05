<?php
include('../conexion.php');

if (isset($_POST['id_categoria'])) {
    $idCategoria = intval($_POST['id_categoria']);

    // Preparar el procedimiento almacenado
    $stmt = $conexion->prepare("CALL obtener_productos_por_id_categoria(?)");
    $stmt->bind_param("i", $idCategoria);
    
    if ($stmt->execute()) {
        $resultado = $stmt->get_result();

        while ($fila = $resultado->fetch_assoc()) {
            $nombreCompleto = htmlspecialchars($fila['NOMBRE_COMPLETO']);
            $marca = htmlspecialchars($fila['DESCRIPCION_MARCA']);
            $clasificacion = htmlspecialchars($fila['DESCRIPCION_CLASIFICACION']);
            $precio = number_format($fila['PRECIO_CREDITO'], 2, '.', ',');
            $existencias = (int)$fila['TOTAL_EXISTENCIAS']; // como entero real
            $imagen = $fila['IMAGEN_PRODUCTO']; // como entero real

            // Botón según existencias
            if ($existencias > 0) {
                $boton = '<button class="boton-item">AGREGAR</button>';
            } else {
                $boton = '<button class="boton-item3" disabled>NO DISPONIBLE</button>';
            }

            echo '
            <div class="item">
                <span class="titulo-item">' . $nombreCompleto . '</span>
                <img src="./assets/img/product/'.$imagen.'" alt="" class="img-item">
                <div class="precios-container">
                    <span class="precio-item">$' . $precio . '</span>
                </div>
                <span class="existencias-item" style="display:none;">' . $existencias . '</span>
                ' . $boton . '
                <button class="boton-item2">VER PRODUCTO</button>
            </div>';
        }

        $stmt->close();

        // Limpia el buffer de resultados si vas a hacer otra consulta después
        while ($conexion->more_results() && $conexion->next_result()) {
            $conexion->use_result();
        }

    } else {
        echo "Error en la ejecución del procedimiento.";
    }

    $conexion->close();
}
?>



