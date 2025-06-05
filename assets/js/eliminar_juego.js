function togglePopupEliminarJuego(nombre, caracteristicas) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar el Juego con Nombre: ${nombre}, ${caracteristicas}?`)) {
        return;
    }

    // Obtener la URL base correctamente
    var baseURL = window.location.origin + "/" + window.location.pathname.split("/")[1];

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_juego.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        console.log(xhr.responseText); // Para depuración

        try {
            const response = JSON.parse(xhr.responseText);
            alert(response.message); // Mostrar mensaje del servidor

            if (response.success) {
                location.reload(); // Recargar página si la eliminación fue exitosa
            }
        } catch (e) {
            alert("❌ Error al procesar la respuesta del servidor.");
        }
    };

    xhr.onerror = function () {
        alert("❌ Hubo un error en la conexión con el servidor.");
    };

    // Enviar los datos al servidor
    xhr.send(`nombre=${encodeURIComponent(nombre)}&caracteristicas=${encodeURIComponent(caracteristicas)}`);
}
