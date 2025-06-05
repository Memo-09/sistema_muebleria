function togglePopupGestionBodegas(claveSucursal, Ubicacion) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupGestionBodegas");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    popup.style.display = "flex";

    // Ocultar el menú lateral
    sidebar.style.display = "none";

    // Colocar los valores en el formulario
    document.getElementById("claveSucursal1").value = claveSucursal;
    document.getElementById("ubicacion1").value = Ubicacion;

    // Obtener la URL base
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Configurar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/consultarProductos2.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onload = function () {
        console.log(xhr.responseText);  // Esto es para depuración: muestra lo que el servidor está respondiendo.

        try {
            const response = JSON.parse(xhr.responseText);
            if (response.error) {
                console.log(response.error); // Si hay un error, mostramos el mensaje en la consola
            } else {
                const cantidadProductos = response.cantidadProductos;
                // Imprimir la cantidad de productos en la consola
                console.log('Cantidad de productos asociados a la Bodega:', cantidadProductos);

                // Validar si la cantidad de productos es mayor que 0
                if (cantidadProductos > 0) {
                    // Deshabilitar el botón "Insertar Productos"
                    document.getElementById("insertarProductoBtn").disabled = true;

                    // Habilitar el botón "Gestionar Productos"
                    document.getElementById("gestionProd").disabled = false;
                } else {
                    // Habilitar el botón "Insertar Productos"
                    document.getElementById("insertarProductoBtn").disabled = false;

                    // Deshabilitar el botón "Gestionar Productos"
                    document.getElementById("gestionProd").disabled = true;
                }
            }
        } catch (e) {
            console.error("Error al procesar la respuesta del servidor. La respuesta no es JSON.");
        }
    };

    xhr.onerror = function () {
        console.error("Hubo un error en la conexión con el servidor.");
    };

    // Enviar la solicitud con la claveSucursal directamente desde el JavaScript
    xhr.send(`claveSucursal=${claveSucursal}`);

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupGestionSucursal");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral
        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    });
}



