<?php
session_start();
include('../conexion.php');

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["contrasena"];

    // Llamar al procedimiento almacenado
    $sql = "CALL InicioDeSesion(?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $hash_contrasena = $fila["CONTRASENA"];
        $nombreCompleto = $fila["NOMBRE_COMPLETO"];  // Obtener el nombre completo

        // Comparar la contraseña ingresada con la almacenada en la base de datos
        if (password_verify($clave, $hash_contrasena)) {
            $_SESSION["usuario"] = $fila["USUARIO"];
            $_SESSION["rol"] = $fila["ID_ROL"];
            $_SESSION["nombre"] = $nombreCompleto;  // Guardar el nombre completo en la sesión

            // Responder con el éxito y el nombre completo
            echo json_encode(["success" => true, "nombre" => $nombreCompleto]);
        } else {
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Usuario no encontrado."]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["success" => false, "message" => "Acceso no permitido."]);
}
?>

