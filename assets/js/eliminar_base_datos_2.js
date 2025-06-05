function togglePopupEliminarProducto(claveProducto) {
    const popup = document.getElementById("popupEliminarProducto");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupEliminarCa");
    const productoIdLabel = document.getElementById("productoIdLabel"); // El label para mostrar el ID del producto

    // Mostrar el ID del producto en el label
    productoIdLabel.textContent = `${claveProducto}`;

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
    const btnEliminarProducto = document.getElementById("btnEliminarProducto");
    btnEliminarProducto.onclick = function () {
        eliminarProducto(claveProducto); // Llamar a la función de eliminación
    };
}






// ELIMINAR MARCA ------------------------------------------------------------------------------

function togglePopupEliminarMarca(claveMarca) {
    const popup = document.getElementById("popupEliminarMarca");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupEliminarMa");
    const productoIdLabel = document.getElementById("marcaIdLabel");

    // Mostrar el ID del producto en el label
    productoIdLabel.textContent = `${claveMarca}`;

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";

    // Pasar el ID del producto a la función que maneja la eliminación
    const btnEliminarMarca = document.getElementById("btnEliminarMarca");
    btnEliminarMarca.onclick = function () {
        eliminarMarca(claveMarca); // Llamar a la función de eliminación
    };

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.onclick = function () {
        popup.style.display = "none";
    };
}

function eliminarMarca(claveMarca) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar el producto con ID ${claveMarca}?`)) {
        return;
    }

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_marca.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message); // Mostrar mensaje de éxito
                location.reload(); // Recargar la página para reflejar cambios
            } else {
                alert(response.message); // Mostrar mensaje de error
            }
        } else {
            alert("Error en la solicitud al servidor.");
        }
    };

    xhr.onerror = function () {
        alert("Hubo un error en la conexión con el servidor.");
    };

    // Enviar la solicitud con el ID del producto
    xhr.send(`claveMarca=${claveMarca}`);
}






//ELIMINAR COLOR -----------------------------------------------------------
function togglePopupEliminarColor(claveColor) {
    const popup = document.getElementById("popupEliminarColor");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupEliminarCo");
    const productoIdLabel = document.getElementById("colorIdLabel");

    // Mostrar el ID del producto en el label
    productoIdLabel.textContent = `${claveColor}`;

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";

    // Pasar el ID del producto a la función que maneja la eliminación
    const btnEliminarMarca = document.getElementById("btnEliminarColor");
    btnEliminarMarca.onclick = function () {
        eliminarColor(claveColor); // Llamar a la función de eliminación
    };

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.onclick = function () {
        popup.style.display = "none";
    };
}

function eliminarColor(claveColor) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar el color con ID ${claveColor}?`)) {
        return;
    }

    // Obtener la URL base
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_color.php", true);
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
    xhr.send(`claveColor=${claveColor}`);
}



