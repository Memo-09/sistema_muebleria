function togglePopupEliminarJuego(nombre, caracteristicas) {
    if (!confirm(`¿Estás seguro de que deseas eliminar el Juego con Nombre: ${nombre}, ${caracteristicas}?`)) {
        return;
    }

    // Obtener la URL base correctamente
    const baseURL = window.location.origin + "/" + window.location.pathname.split("/")[1];

    // Verificar la URL completa en consola
    console.log("URL completa:", baseURL + "/funciones_base/eliminar_juego.php");

    // Construir la URL con los parámetros
    const url = baseURL + "/funciones_base/eliminar_juego.php?nombre=" + encodeURIComponent(nombre) + "&caracteristicas=" + encodeURIComponent(caracteristicas);

    // Imprimir la URL con parámetros para depuración
    console.log("URL con parámetros:", url);

    // Configurar la solicitud AJAX con Fetch API
    fetch(url, {
        method: "GET",
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json()) // Convertir respuesta a JSON
    .then(data => {
        console.log("Respuesta del servidor:", data); // Imprimir la respuesta del servidor en consola
        alert(data.message); // Mostrar mensaje de respuesta
    })
    .catch(error => {
        console.error("Error al procesar la solicitud:", error); // Mostrar error si ocurre un problema con la solicitud
        alert("Error al procesar la solicitud:", error);
    });
}

