var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

document.addEventListener("DOMContentLoaded", function () {
    const tabla2 = document.getElementById("tabla2").querySelector("tbody");
    const Sucursal = document.querySelector('#claveSucursal').value;

    // Escuchar eventos en la tabla
    tabla2.addEventListener("click", function (event) {
        const btn = event.target;

        // Verificar si el clic fue en el botón "actualizar-btn"
        if (btn.classList.contains("actualizar-btn")) {
            const fila = btn.closest("tr");
            const claveProducto = fila.getAttribute("data-clave");
            const nuevasExistencias = parseInt(fila.querySelector('input[name="existencias"]').value, 10);

            if (!nuevasExistencias || isNaN(nuevasExistencias) || nuevasExistencias <= 0) {
                alert("Por favor ingresa un número válido para las existencias.");
                return;
            }

            // Enviar la solicitud al servidor
            actualizarExistencias(Sucursal, claveProducto, nuevasExistencias)
                .then((mensaje) => {
                    alert(mensaje);
                })
                .catch((error) => {
                    console.error("Error al actualizar existencias:", error);
                    alert("No se pudo actualizar las existencias. Intenta nuevamente.");
                });
        }
    });

    // Función para enviar la solicitud al servidor
    async function actualizarExistencias(sucursal, clave, existencias) {
        const formData = new FormData();
        formData.append("idSucursal", sucursal);
        formData.append("claveProducto", clave);
        formData.append("nuevasExistencias", existencias);

        try {
            const response = await fetch(baseURL+"/funciones_base/actualizar_existencias.php", {
                method: "POST",
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`Error en la solicitud al servidor: ${response.statusText}`);
            }

            const data = await response.text();
            return data || "Existencias actualizadas correctamente.";
        } catch (error) {
            throw new Error("Error en la comunicación con el servidor: " + error.message);
        }
    }
});
