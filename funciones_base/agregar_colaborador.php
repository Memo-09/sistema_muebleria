<?php
// Incluir la conexión a la base de datos
include('../conexion.php');

// Verificar si los datos han sido enviados mediante POST
if (isset($_POST['usuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['apP'], $_POST['apM'], $_POST['rol'])) {

    // Obtener los datos enviados
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena']; // La contraseña sin encriptar
    $nombre = $_POST['nombre'];
    $apP = $_POST['apP'];
    $apM = $_POST['apM'];
    $idRol = $_POST['rol'];

    // Encriptar la contraseña usando password_hash()
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Llamar al procedimiento almacenado para insertar el usuario y colaborador
    $sql = "CALL insertarUsuarioColaborador(?, ?, ?, ?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros (usando la contraseña encriptada)
        $stmt->bind_param("sssssi", $usuario, $contrasena_encriptada, $nombre, $apP, $apM, $idRol);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Usuario y colaborador agregados correctamente.";
        } else {
            echo "Error al agregar el usuario y colaborador: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }

} else {
    echo "Faltan datos para agregar al usuario o colaborador.";
}

// Cerrar la conexión
$conexion->close();
?>




