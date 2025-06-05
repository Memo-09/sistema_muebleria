function togglePopupEliminarCliente(claveCliente) {
    const popup = document.getElementById("popupEliminarCliente");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupEliminarCli");
    const productoIdLabel = document.getElementById("clienteIdLabel"); // El label para mostrar el ID del producto

    // Mostrar el ID del producto en el label
    productoIdLabel.textContent = `${claveCliente}`;

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";
+
    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";
        sidebar.style.display = "block";
    });

    // Pasar el ID del producto a la función que maneja la eliminación
    const btnEliminarCliente = document.getElementById("btnEliminarCliente");
    btnEliminarCliente.onclick = function () {
        eliminarCliente(claveCliente); // Llamar a la función de eliminación
    };
}

function eliminarCliente(idCliente) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar el Cliente con ID ${idCliente}?`)) {
        return;
    }

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_cliente.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                alert(response.message); // Mostrar mensaje del servidor
                if (response.success) {
                    location.reload(); // Recargar la página solo si el cliente fue eliminado
                }
            } catch (e) {
                alert("Error al procesar la respuesta del servidor.");
            }
        } else {
            alert("Error en la solicitud al servidor.");
        }
    };

    xhr.onerror = function () {
        alert("Hubo un error en la conexión con el servidor.");
    };

    // Enviar la solicitud con el ID del cliente
    xhr.send(`idCliente=${idCliente}`);
}