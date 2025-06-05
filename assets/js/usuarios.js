function togglePopupUsuarios(usuario) {
    const popup = document.getElementById("Usuario");
    const sidebar = document.getElementById("sidebar");

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    var formData = new FormData();
    formData.append('usuario', usuario);
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/obtener_informacion_usuarios.php", true);
    
    xhr.onload = function () {
        try {
            var response = JSON.parse(xhr.responseText); // Convertir la respuesta en JSON

            if (response.error) {
                console.error("Error:", response.error);
                alert(response.error);
            } else {
                // Insertar los valores en los inputs
                document.getElementById("nombreu").value = response.NOMBRE + " "+ response.AP_P+ " " + response.AP_M || "";
                document.getElementById("rolu").value = response.DESCRIPCION_ROL || "";
            }
        } catch (e) {
            console.error("Error en el formato de respuesta JSON:", e, xhr.responseText);
            alert("Error al procesar la respuesta del servidor.");
        }
    };
    
    xhr.onerror = function () {
        alert("Error en la solicitud AJAX.");
    };

    xhr.send(formData);

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupUusario");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none"; // Ocultar la ventana emergente
            if (sidebar) sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

            // Eliminar el listener para evitar múltiples asignaciones
            closePopup.removeEventListener("click", cerrarPopup);
        });
    }
}

