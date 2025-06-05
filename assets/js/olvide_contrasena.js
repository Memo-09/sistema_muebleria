function olvide_contrasena() {
    var nombre = prompt("Ingresa tu Nombre:");
    var apellido1 = prompt("Ingresa tu Apellido Paterno:");
    var apellido2 = prompt("Ingresa tu Apellido Materno:");

    // Validar que los campos no estén vacíos
    if (!nombre || !apellido1 || !apellido2) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    let formData = new FormData();
    formData.append("nombre", nombre);
    formData.append("apellido1", apellido1);
    formData.append("apellido2", apellido2);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    fetch(baseURL + "/funciones_base/obtener_usuario_contrasena.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Usuario y Contraseña: " + data.nombre);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un problema con la recuperación de usuario.");
    });
}
