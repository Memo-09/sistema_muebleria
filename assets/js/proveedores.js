function togglePopupProveedore() {
    const popup = document.getElementById("popupProveedores");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopuProveedores");

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";
+
    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";
        sidebar.style.display = "block";
    });
}


function guardarProveedor(event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    var proveedor = document.querySelector('#nuevoProveedor').value.trim(); // Obtener el valor

    if (!proveedor) {
        alert("Por favor, ingrese el nombre del proveedor.");
        return;
    }

    // Crear el objeto FormData para enviar los datos
    var formData = new FormData();
    formData.append('proveedor', proveedor);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_proveedor.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                if (response.success) location.reload();
            } catch (e) {
                console.log("Error en la respuesta del servidor: " + xhr.responseText);
            }
        } else {
            alert("Hubo un error al insertar el proveedor.");
        }
    };
    xhr.send(formData);
}


function togglePopupModificarProveedor(idproveedor, proveedor) {
    const popup = document.getElementById("popupModificarProveedor");
    const closePopup = document.getElementById("closePopupModificarProveedor");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Asignar los valores a los inputs
    document.getElementById("idmodificarProvedor1").value = idproveedor;
    document.getElementById("modificarProveedor1").value = proveedor;

    // Mostrar la ventana emergente y ocultar la barra lateral
    popup.style.display = "flex";
    sidebar.style.display = "none";

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";

        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    });
}


function actualizarProveedor(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de forma tradicional

    // Obtener los valores de los inputs
    var idProveedor = document.querySelector('#idmodificarProvedor1').value;
    var descripcionProveedor = document.querySelector('#modificarProveedor1').value;

    // Validaciones
    if (!idProveedor || !descripcionProveedor) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    // Crear objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('id_proveedor', idProveedor);
    formData.append('descripcion_proveedor', descripcionProveedor);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Enviar los datos mediante AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL +  "/funciones_base/actualizar_proveedor.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message); // Mensaje de éxito
                    location.reload(); // Recargar la página
                } else {
                    alert(response.message); // Mensaje de error
                }
            } catch (e) {
                console.log("Error en la respuesta del servidor: " + xhr.responseText);
            }
        } else {
            alert("Hubo un error al actualizar el proveedor.");
        }
    };
    xhr.send(formData);
}

function togglePopupEliminarProveedor(claveProveedor) {
    const popup = document.getElementById("popupEliminarProveedor");
    const closePopup = document.getElementById("closePopupEliminarProveedor");
    const productoIdLabel = document.getElementById("proveedorLabel"); // El label para mostrar el ID del producto

    // Mostrar el ID del producto en el label
    productoIdLabel.textContent = `${claveProveedor}`;

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // Pasar el ID del producto a la función que maneja la eliminación
    const btnEliminarProducto = document.getElementById("btnEliminarProveedor");
    btnEliminarProducto.onclick = function () {
        eliminarProveedor(claveProveedor); // Llamar a la función de eliminación
    };
}


function eliminarProveedor(claveProveedor) {
    // Confirmar antes de eliminar
    if (!confirm(`¿Estás seguro de que deseas eliminar el Proveedor con ID ${claveProveedor}?`)) {
        return;
    }

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/eliminar_proveedor.php", true);
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
    xhr.send(`claveProveedor=${claveProveedor}`);
}
