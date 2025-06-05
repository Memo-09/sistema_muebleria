function olvide_contrasena() {
    var nombre = prompt("Ingresa tu Nombre:").toUpperCase(); // Convertir a mayúsculas
    var apellido1 = prompt("Ingresa tu Apellido Paterno:").toUpperCase(); // Convertir a mayúsculas
    var apellido2 = prompt("Ingresa tu Apellido Materno:").toUpperCase(); // Convertir a mayúsculas

    // Validar que los campos no estén vacíos
    if (!nombre || !apellido1 || !apellido2) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    console.log(nombre);
    console.log(apellido1);
    console.log(apellido2);

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
            // Si el usuario se encuentra, mostrar el usuario y contraseña en una alerta
            alert("Usuario Y Contraseña: " + data.usuario);
        } else {
            // Si no se encuentra el usuario, mostrar mensaje de error
            alert("Usuario y Contraseña no encontrados");
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un problema con la recuperación de usuario.");
    });
}



