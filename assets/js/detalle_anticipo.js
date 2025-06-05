async function togglePopupDetalleVenta(claveVenta, nombre, apellido1, apellido2, total, fecha1, fecha2, fecha3, abonado, restante) {
    const popup = document.getElementById("popupDetalleVenta");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Colocar los valores en el formulario
    document.getElementById("claveVenta").value = claveVenta;
    document.getElementById("nombreCliente").value = `${nombre} ${apellido1} ${apellido2}`;
    document.getElementById("total").value = total;
    document.getElementById("fecha1").value = fecha1;
    document.getElementById("fecha2").value = fecha2;
    document.getElementById("fecha3").value = fecha3;
    document.getElementById("abonado").value = abonado;
    document.getElementById("restante").value = restante;

    const formData = new FormData();
    formData.append("claveVenta", claveVenta);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    try {
        const response = await fetch(baseURL + "/funciones_base/productos_venta.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud al servidor: ${response.statusText}`);
        }

        const data = await response.json(); // Esperamos una respuesta en JSON
        console.log(data); // Aquí puedes manejar lo que te devuelve el servidor

        // Llenar la tabla con los productos
        const tableBody = document.querySelector(".productosVenta tbody");
        tableBody.innerHTML = ""; // Limpiar la tabla antes de llenarla

        // Si hay productos, insertarlos en la tabla
        if (data.length > 0) {
            data.forEach(producto => {
                const row = document.createElement("tr");

                // Crear las celdas
                row.innerHTML = `
                    <td>${producto.CLAVE_PRODUCTO}</td>
                    <td>${producto.NOMBRE_PRODUCTO} ${producto.CARACTERISTICAS_PRODUCTO} MARCA: ${producto.DESCRIPCION_MARCA}</td>
                    <td>${producto.NUMERO_PRODUCTOS}</td>
                `;

                // Agregar la fila a la tabla
                tableBody.appendChild(row);
            });
        } else {
            // Si no hay productos
            const noProductsRow = document.createElement("tr");
            noProductsRow.innerHTML = '<td colspan="4">No se encontraron productos para esta venta.</td>';
            tableBody.appendChild(noProductsRow);
        }
    } catch (error) {
        console.error("Error en la comunicación con el servidor: " + error.message);
    }

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupDetalleVenta");
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