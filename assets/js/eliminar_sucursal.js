//ELIMINAR SUCURSAL -------------------------------------------------------------------
function togglePopupEliminarSucursal(claveSucursal) {
    const popup = document.getElementById("popupEliminarSucursal");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupEliminarSuc");
    const productoIdLabel = document.getElementById("sucursalIdLabel");

    // Mostrar el ID del producto en el label
    productoIdLabel.textContent = `${claveSucursal}`;

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";

    // Pasar el ID del producto a la función que maneja la eliminación
    const btnEliminarMarca = document.getElementById("btnEliminarSucursal");
    btnEliminarMarca.onclick = function () {
        eliminarSucursal(claveSucursal); // Llamar a la función de eliminación
    };

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.onclick = function () {
        popup.style.display = "none";
        sidebar.style.display = "flex";
    };
}

function eliminarSucursal(claveSucursal) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar la Sucursal con ID ${claveSucursal}?`)) {
        return;
    }

    // Obtener la URL base
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_sucursal.php", true);
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

    // Enviar la solicitud con el ID del color
    xhr.send(`claveSucursal=${claveSucursal}`);
}
