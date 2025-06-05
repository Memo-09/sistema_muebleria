async function togglePopupDetalleVenta(claveVenta, nombre, apellido1, apellido2, total, fecha1, fecha2, fecha3, abonado, restante) {
    const popup = document.getElementById("popupDetalleVenta");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked');

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Formatear abonado y restante con 2 decimales
    const formatDecimal = (value) => {
        return new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(value);
    };

    // Colocar los valores en el formulario
    document.getElementById("claveVenta").value = claveVenta;
    document.getElementById("nombreCliente").value = `${nombre} ${apellido1} ${apellido2}`;
    document.getElementById("total").value = formatDecimal(total);
    document.getElementById("fecha1").value = fecha1;
    document.getElementById("fecha2").value = fecha2;
    document.getElementById("fecha3").value = fecha3;
    document.getElementById("abonado").value = formatDecimal(abonado);
    document.getElementById("restante").value = formatDecimal(restante);

    const formData = new FormData();
    formData.append("venta", claveVenta);

    const baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    try {
        const response = await fetch(baseURL + "/funciones_base/obtener_enganche.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud al servidor: ${response.statusText}`);
        }

        const data = await response.json();
        console.log(data);

        // Si se obtienen datos, los colocamos en los inputs
        if (data.success && data.enganche !== undefined && data.parciales !== undefined) {
            document.getElementById("enganche").value = formatDecimal(data.enganche);
            document.getElementById("parciales").value = data.parciales;
        } else {
            console.error("Los datos no tienen el formato esperado.");
        }
        await obneterProductos(claveVenta);

    } catch (error) {
        console.error("Error en la comunicación con el servidor: " + error.message);
    }

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupDetalleVenta");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none";
            if (sidebar) sidebar.style.display = "block";

            if (checkbox) checkbox.checked = false;

            closePopup.removeEventListener("click", cerrarPopup);
        });
    }
}

async function obneterProductos(claveVenta) {
    const formData = new FormData();
    formData.append("claveVenta", claveVenta);

    const baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    try {
        const response = await fetch(baseURL + "/funciones_base/productos_venta.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud al servidor: ${response.statusText}`);
        }

        const data = await response.json();
        console.log(data);

        const tableBody = document.querySelector(".productosVenta tbody");
        tableBody.innerHTML = "";

        if (Array.isArray(data) && data.length > 0) {
            data.forEach(producto => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td><label class="checkboxs"><input type="checkbox" class="product-checkbox"><span class="checkmarks"></span></label></td>
                    <td>${producto.CLAVE_PRODUCTO}</td>
                    <td>${producto.NOMBRE_PRODUCTO} ${producto.CARACTERISTICAS_PRODUCTO} MARCA: ${producto.DESCRIPCION_MARCA}</td>
                    <td>${producto.NUMERO_PRODUCTOS}</td>
                `;
                tableBody.appendChild(row);
            });
        } else {
            const noProductsRow = document.createElement("tr");
            noProductsRow.innerHTML = '<td colspan="4">No se encontraron productos para esta venta.</td>';
            tableBody.appendChild(noProductsRow);
        }
    } catch (error) {
        console.error("Error en la comunicación con el servidor: " + error.message);
    }
}