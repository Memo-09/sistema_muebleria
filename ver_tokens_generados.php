<?php
require 'conexion.php'; // Conexión a la BD

function generarToken() {
    return bin2hex(random_bytes(16)); // Token aleatorio de 32 caracteres
}

$sql = "SELECT ID_VENTA FROM ventas";
$resultado = $conexion->query($sql);

echo "<h2>Insertando tokens (solo donde no existan)</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<thead><tr><th>ID_VENTA</th><th>TOKEN GENERADO</th><th>ESTADO</th></tr></thead><tbody>";

while ($fila = $resultado->fetch_assoc()) {
    $id_venta = $fila['ID_VENTA'];

    // Verificamos si ya existe un token para esta venta
    $verificar = $conexion->prepare("SELECT TOKEN_VENTA FROM token_venta WHERE ID_VENTA = ?");
    $verificar->bind_param("i", $id_venta);
    $verificar->execute();
    $verificar->store_result();

    if ($verificar->num_rows == 0) {
        // No existe, se genera e inserta
        $token = generarToken();
        $insertar = $conexion->prepare("INSERT INTO token_venta (ID_VENTA, TOKEN_VENTA) VALUES (?, ?)");
        $insertar->bind_param("is", $id_venta, $token);

        if ($insertar->execute()) {
            echo "<tr><td>$id_venta</td><td>$token</td><td style='color:green;'>✅ Insertado</td></tr>";
        } else {
            echo "<tr><td>$id_venta</td><td>—</td><td style='color:red;'>❌ Error al insertar</td></tr>";
        }

        $insertar->close();
    } else {
        // Ya existe
        echo "<tr><td>$id_venta</td><td>—</td><td style='color:orange;'>⚠️ Ya existe</td></tr>";
    }

    $verificar->close();
}

echo "</tbody></table>";
?>

