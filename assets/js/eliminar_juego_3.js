function togglePopupEliminarJuego(nombre, caracteristicas) {
    if (!confirm(`¿Estás seguro de que deseas eliminar el Juego con Nombre: ${nombre}, ${caracteristicas}?`)) {
        return;
    }

    // Obtener la URL base correctamente
    const baseURL = window.location.origin + "/" + window.location.pathname.split("/")[1];

    // Imprimir la URL y los datos para depuración
    console.log("Enviando solicitud a:", baseURL + "/funciones_base/eliminar_juego.php");
    console.log("Datos enviados:", `nombre=${encodeURIComponent(nombre)}&caracteristicas=${encodeURIComponent(caracteristicas)}`);

    // Configurar la solicitud AJAX con Fetch API
    fetch(baseURL + "/funciones_base/eliminar_juego.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `nombre=${encodeURIComponent(nombre)}&caracteristicas=${encodeURIComponent(caracteristicas)}`
    })
    .then(response => response.json()) // Convertir respuesta a JSON
    .then(data => {
        console.log("Respuesta del servidor:", data); // Imprimir la respuesta del servidor
        alert(data.message); // Mostrar mensaje de respuesta
    })
    .catch(error => {
        console.error("Error al procesar la solicitud:", error); // Mostrar error si ocurre un problema con la solicitud
        alert("Error al procesar la solicitud:", error);
    });
}
