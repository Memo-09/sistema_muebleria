function eliminarProducto(claveProducto) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar el producto con ID ${claveProducto}?`)) {
        return;
    }

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    console.log("URL de la solicitud:", baseURL + "/funciones_base/eliminar_producto.php"); // Agregado para depuración

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_producto.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                console.log("Respuesta del servidor:", response); // Agregado para depuración
                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    location.reload(); // Recargar la página para reflejar cambios
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            } catch (error) {
                console.error("Error al procesar la respuesta JSON:", error); // Más detalles del error
                alert("Hubo un error al procesar la respuesta del servidor.");
            }
        } else {
            console.error("Error en la solicitud AJAX. Código de estado:", xhr.status); // Mostrar código de estado
            alert("Error en la solicitud al servidor.");
        }
    };

    // Manejar errores en la conexión
    xhr.onerror = function () {
        console.error("Error en la conexión con el servidor:", xhr.statusText); // Más detalles del error
        alert("Hubo un error en la conexión con el servidor.");
    };

    // Enviar la solicitud con el ID del producto
    xhr.send(`claveProducto=${claveProducto}`);
}
