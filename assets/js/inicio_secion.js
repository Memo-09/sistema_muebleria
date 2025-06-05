function iniciodeSecion() {
    let usuario = document.getElementById("usuario").value.trim();
    let contrasena = document.getElementById("contrasena").value.trim();

    // Validar que los campos no estén vacíos
    if (!usuario || !contrasena) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Crear el objeto FormData para enviar los datos
    let formData = new FormData();
    formData.append("usuario", usuario);
    formData.append("contrasena", contrasena);

    // Obtener la URL base sin importar la ubicación del archivo
    let baseURL = window.location.origin + window.location.pathname.split("/").slice(0, -1).join("/");

    // Enviar la solicitud AJAX con fetch
    fetch(baseURL + "/funciones_base/inicio_sesion.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la respuesta del servidor.");
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Mostrar el mensaje de bienvenida con el nombre completo
            alert("¡BIENVENIDO, " + data.nombre + "!");

            // Redirigir al usuario a index.php después del login exitoso
            window.location.href = "index.php"; 
        } else {
            alert(data.message); // Mostrar mensaje de error
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un problema con el inicio de sesión.");
    });
}

document.getElementById("contrasena").addEventListener("input", function() {
    this.value = this.value.toUpperCase();
});

