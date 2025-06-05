function eliminarJuego(nombre, caracteristicas) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar el Juego con Nombre: ${nombre}, ${caracteristicas}?`)) {
        return;
    }

    // Obtener la URL base correctamente (ruta sin el archivo actual)
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Crear la URL completa con la ruta al archivo PHP
    const url = baseURL + "/funciones_base/eliminar_juego.php";

    // Crear una nueva instancia de XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);  // Usar POST en lugar de GET

    // Configurar los encabezados para enviar datos en formato URL codificado
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Mostrar solo el mensaje sin la respuesta completa del servidor
            const mensaje = xhr.responseText.trim();
            alert(mensaje); // Mostrar la respuesta completa del servidor

            // Verificar si la respuesta indica que la eliminación fue exitosa
            if (mensaje === 'El juego y sus productos asociados fueron eliminados correctamente.') {
                // Recargar la página si la eliminación fue exitosa
                location.reload();
            }
        } else {
            alert("Error en la solicitud al servidor.");
        }
    };

    xhr.onerror = function () {
        alert("Hubo un error en la conexión con el servidor.");
    };

    // Enviar los parámetros en el cuerpo de la solicitud POST
    const data = `nombre=${encodeURIComponent(nombre)}&caracteristicas=${encodeURIComponent(caracteristicas)}`;
    xhr.send(data);  // Enviar la solicitud con los datos
}
