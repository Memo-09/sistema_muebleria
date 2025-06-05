<?php
// Incluir archivo de conexión a la base de datos
include('../conexion.php');

// Recibir los datos del formulario enviados mediante POST
$nombre = $_POST['nombre'];
$ap_p = $_POST['ap_p'];
$ap_m = $_POST['ap_m'];
$calle = $_POST['calle'];
$numero_exterior = $_POST['numero_exterior'];
$numero_interior = $_POST['numero_interior'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$colonia = $_POST['colonia'];
$municipio = $_POST['municipio'];
$id_colaborador = $_POST['id_colaborador'];

// Preparar la llamada al procedimiento almacenado
$query = "CALL InsertarClienteYRelacion(
    '$nombre', 
    '$ap_p', 
    '$ap_m', 
    '$calle', 
    '$numero_exterior', 
    '$numero_interior', 
    '$telefono', 
    '$correo', 
    '$colonia', 
    '$municipio', 
    '$id_colaborador'
)";

// Ejecutar la consulta
if ($conexion->query($query) === TRUE) {
    // Si la ejecución es exitosa
    $response = array(
        "success" => true,
        "message" => "Cliente insertado exitosamente."
    );
} else {
    // Si ocurre un error
    $response = array(
        "success" => false,
        "message" => "Error al insertar el cliente: " . $conexion->error
    );
}

// Devolver la respuesta en formato JSON
echo json_encode($response);

// Cerrar la conexión
$conexion->close();
?>


