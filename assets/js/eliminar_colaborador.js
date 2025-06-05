//ELIMINAR SUCURSAL -------------------------------------------------------------------
function togglePopupEliminarColaborador(claveColaborador) {
    const popup = document.getElementById("popupEliminarColaborador");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupEliminarCol");
    const productoIdLabel = document.getElementById("colaboradorlIdLabel");

    // Mostrar el ID del producto en el label
    productoIdLabel.textContent = `${claveColaborador}`;

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";

    // Pasar el ID del producto a la función que maneja la eliminación
    const btnEliminarColaborador = document.getElementById("btnEliminarColaborador");
    btnEliminarColaborador.onclick = function () {
        eliminarSucursal(claveColaborador); // Llamar a la función de eliminación
    };

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.onclick = function () {
        popup.style.display = "none";
        sidebar.style.display = "flex";
    };
}

function eliminarSucursal(claveColaborador) {
    if (!confirm(`¿Estás seguro de que deseas eliminar el Colaborador con ID ${claveColaborador}?`)) {
        return;
    }

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_colaborador.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        console.log(xhr.responseText);

        try {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message);
                location.reload();
            } else {
                alert(response.message);
            }
        } catch (e) {
            console.error("Error en el formato de la respuesta:", e);
            alert("Error inesperado. Por favor, intenta más tarde.");
        }
    };

    xhr.onerror = function () {
        alert("Error al conectar con el servidor.");
    };

    // Enviar la solicitud
    xhr.send(`idColaborador=${encodeURIComponent(claveColaborador)}`);
}
