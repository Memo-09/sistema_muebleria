function cerrarSesion() {
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Llamada al archivo PHP para cerrar la sesión
    fetch(baseURL + "/funciones_base/cerrar_sesion.php")
        .then(response => response.text()) // Respuesta de PHP (no necesitamos hacer nada con el texto)
        .then(data => {
            // Mostrar el mensaje de "Hasta pronto"
            alert("¡HASTA PRONTO!");

            // Redirigir al usuario a la página de inicio de sesión
            window.location.href = "signin.php";
        })
        .catch(error => {
            console.log('Error al cerrar sesión:', error);
        });
}
