<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Obtener los datos enviados a través de POST
$claveProducto = mysqli_real_escape_string($conexion, $_POST['claveProducto']);
$nombreProducto = mysqli_real_escape_string($conexion, $_POST['nombreProducto']);
$nombreMarca = mysqli_real_escape_string($conexion, $_POST['marca']);
$nombreColor = mysqli_real_escape_string($conexion, $_POST['color']);
$caracteristicasProducto = mysqli_real_escape_string($conexion, $_POST['caracteristicas']);
$precioContado = mysqli_real_escape_string($conexion, $_POST['precioContado']);
$precioCrediContado = mysqli_real_escape_string($conexion, $_POST['crediContado']);
$precioCredito = mysqli_real_escape_string($conexion, $_POST['credito']);
$enganche = mysqli_real_escape_string($conexion, $_POST['enganche']);
$comision = mysqli_real_escape_string($conexion, $_POST['comision']);
$categoria = mysqli_real_escape_string($conexion, $_POST['categoria']); // Nueva categoría

// Llamar al procedimiento almacenado con la clasificación incluida
$sql = "CALL actualizarProducto('$claveProducto', '$nombreProducto', '$nombreMarca', '$nombreColor', 
        '$caracteristicasProducto', '$precioContado', '$precioCrediContado', '$precioCredito', 
        '$enganche', '$comision', '$categoria')";

if (mysqli_query($conexion, $sql)) {
    echo "Producto actualizado correctamente.";
} else {
    echo "Error al actualizar el producto: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>





