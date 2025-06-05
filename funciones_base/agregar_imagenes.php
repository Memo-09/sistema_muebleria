<?php
$carpetaDestino = __DIR__ . "/../assets/img/product/";

if (!file_exists($carpetaDestino)) {
    mkdir($carpetaDestino, 0755, true);
}

if (!empty($_FILES['imagenProducto']) && isset($_POST['claveProducto'])) {
    $clave = trim($_POST['claveProducto']);
    $total = count($_FILES['imagenProducto']['name']);
    $archivosRecibidos = [];

    include('../conexion.php');

    $huboInsercion = false; // bandera para saber si al menos una imagen fue insertada

    for ($i = 0; $i < $total; $i++) {
        $tmpFilePath = $_FILES['imagenProducto']['tmp_name'][$i];
        $originalName = $_FILES['imagenProducto']['name'][$i];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
            echo "❌ Formato no válido para la imagen #" . ($i + 1) . "";
            exit;
        }

        $baseNombre = $clave . "_" . ($i + 1);
        $nuevoNombre = $baseNombre . "." . $extension;
        $rutaDestino = $carpetaDestino . $nuevoNombre;

        foreach (['jpg', 'jpeg', 'png'] as $ext) {
            $archivoExistente = $carpetaDestino . $baseNombre . "." . $ext;
            if (file_exists($archivoExistente) && $archivoExistente !== $rutaDestino) {
                unlink($archivoExistente);
            }
        }

        if (move_uploaded_file($tmpFilePath, $rutaDestino)) {
            $archivosRecibidos[] = $nuevoNombre;

            $mensaje = "";
            $stmt = mysqli_prepare($conexion, "CALL insertar_imagen_producto(?, ?, @mensaje)");
            mysqli_stmt_bind_param($stmt, "ss", $clave, $nuevoNombre);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $resultado = mysqli_query($conexion, "SELECT @mensaje AS mensaje");
            if ($fila = mysqli_fetch_assoc($resultado)) {
                if ($fila['mensaje'] === 'Imagen registrada con éxito') {
                    $huboInsercion = true; // marcamos que hubo al menos una inserción
                }
            }
        } else {
            echo "<script>alert('❌ Error al subir la imagen: $nuevoNombre');</script>";
            exit;
        }
    }

    // Mostrar solo un alert final
    if ($huboInsercion) {
        echo "✅ Imágenes agregadas con éxito";
    } else {
        echo "ℹ️✅ Las imágenes están actualizadas con éxito";
    }

} else {
    echo "⚠️ No se recibieron imágenes o falta la clave del producto.";
}


