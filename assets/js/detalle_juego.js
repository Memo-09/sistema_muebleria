function togglePopupDetalleJuego(nombre, caracteristicas) {
    const popup = document.getElementById("popupDetalleJuego");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked');

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Llamar a la función para obtener datos del producto
    recuperarDatosProducto(nombre, caracteristicas);

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupJuego");
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

function recuperarDatosProducto(nombre, caracteristicas) {
    var formData = new FormData();
    formData.append('nombre_producto', nombre);
    formData.append('caracteristicas_producto', caracteristicas);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/recuperarDatosProducto.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);  // Verificar si los datos recibidos son correctos

            if (response.success) {
                // Guardar el ID del juego globalmente
                idJuegoGlobal = response.data.ID_JUEGO;

                // Llenar los inputs con los datos obtenidos
                document.getElementById("idJuego").value = response.data.ID_JUEGO;
                document.getElementById("nombreJuego").value = response.data.NOMBRE_JUEGO + " " + response.data.CARACTERISTICAS_JUEGO;
                document.getElementById("creditoJuego").value = parseFloat(response.data.PRECIO_CREDITO).toFixed(2);
                document.getElementById("crediContadoJuego").value = parseFloat(response.data.PRECIO_CREDI_CONTADO).toFixed(2);
                document.getElementById("contadojuego").value = parseFloat(response.data.PRECIO_CONTADO).toFixed(2);
                document.getElementById("enganche").value = parseFloat(response.data.ENGANCHE).toFixed(2);
                document.getElementById("comision").value = parseFloat(response.data.COMISION).toFixed(2);

                obtenerProductosPorJuego(idJuegoGlobal);
            } else {
                alert(response.message);  // Mostrar mensaje de error
            }
        } else {
            alert("❌ Error al recuperar los datos.");
        }
    };
    xhr.send(formData);
}



function obtenerProductosPorJuego(id) {
    console.log("ID DE JUEGO: " + id);
    var formData = new FormData();
    formData.append('id_juego', id); // Enviar el ID del juego

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/productosJuego.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response); // Verificar la respuesta del servidor

            if (response.success) {
                var productos = response.data;
                mostrarProductos(productos);
            } else {
                alert(response.message);  // Mostrar mensaje de error
            }
        } else {
            alert("❌ Error al recuperar los productos.");
        }
    };

    // Si hay un error de XHR, se muestra un mensaje
    xhr.onerror = function () {
        console.error("Hubo un error en la solicitud.");
        alert("❌ Error en la solicitud de XHR.");
    };

    xhr.send(formData);
}

function mostrarProductos(productos) {
    var productosContainer = document.querySelector(".productosJuego2 tbody");
    productosContainer.innerHTML = ""; // Limpiar antes de agregar productos

    // Verificar si hay productos
    if (!productos || productos.length === 0) {
        productosContainer.innerHTML = "<tr><td colspan='4'>No se encontraron productos.</td></tr>";
        return;
    }

    productos.forEach(function (producto) {
        var productoRow = document.createElement("tr");

        productoRow.innerHTML = `
            <td>${producto.clave_producto}</td>
            <td>${producto.nombre_producto} </td>
        `;

        productosContainer.appendChild(productoRow);
    });
}
