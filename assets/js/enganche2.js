function toggleEnganche2(id_venta) {
    let respuesta = prompt("Por favor, ingresa un número:");

    if (respuesta !== null) {
        // Validamos que la respuesta solo contenga números
        if (/^\d+$/.test(respuesta)) {
            // Obtener la URL base
            var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

            // Configurar la solicitud AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", baseURL + "/funciones_base/añadir_enanche.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Manejar la respuesta del servidor
            xhr.onload = function () {
                try {
                    alert(xhr.responseText); // Mostrar otro mensaje si es diferente
                    location.reload(); // Recargar la página

                } catch (e) {
                    alert("Error al procesar la respuesta del servidor.");
                }
            };

            xhr.onerror = function () {
                alert("Hubo un error en la conexión con el servidor.");
            };

            // Enviar la solicitud con los parámetros necesarios
            xhr.send(`claveventa=${id_venta}&cantidad=${respuesta}`);
        } else {
            alert("¡Solo se permiten números! Intenta de nuevo.");
        }
    }
}


function toggleEnganche(id_venta) {
    const popup = document.getElementById("popupAnadirEnganche");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked');

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupAnadirEnganche");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none"; // Ocultar la ventana emergente
            if (sidebar) sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

            // Desmarcar el checkbox seleccionado al cancelar
            if (checkbox) {
                checkbox.checked = false;
            }

            // Eliminar el listener para evitar múltiples asignaciones
            closePopup.removeEventListener("click", cerrarPopup);
        });
    }
}
