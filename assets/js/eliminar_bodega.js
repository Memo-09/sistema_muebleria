// ELIMINAR BODEGA -------------------------------------------------------------------
function togglePopupEliminarBodega(claveBodega) {
    const popup = document.getElementById("popupEliminarBodega");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupEliminarBod");
    const bodegaIdLabel = document.getElementById("bodegaIdLabel");

    // Mostrar el ID de la bodega en el label
    bodegaIdLabel.textContent = `${claveBodega}`;

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";

    // Pasar el ID de la bodega a la función que maneja la eliminación
    const btnEliminarBodega = document.getElementById("btnEliminarBodega"); // Asegúrate de que el ID sea correcto
    btnEliminarBodega.onclick = function () {
        eliminarBodega(claveBodega); // Llamar a la función de eliminación
    };

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.onclick = function () {
        popup.style.display = "none";
        sidebar.style.display = "flex";
    };
}

function eliminarBodega(claveBodega) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar la Bodega con ID ${claveBodega}?`)) {
        return;
    }

    // Obtener la URL base
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_bodega.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        console.log(xhr.responseText);  // Esto es para depuración: muestra lo que el servidor está respondiendo.

        try {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message); // Mostrar mensaje de éxito
                location.reload(); // Recargar la página para reflejar cambios
            } else {
                alert(response.message); // Mostrar mensaje de error
            }
        } catch (e) {
            alert("Error al procesar la respuesta del servidor. La respuesta no es JSON.");
        }
    };

    xhr.onerror = function () {
        alert("Hubo un error en la conexión con el servidor.");
    };

    // Enviar la solicitud con el ID de la bodega
    xhr.send(`claveBodega=${claveBodega}`);
}
