function toggleEnganche(id_venta) {
    let respuesta = prompt("Por favor, ingresa un número:");

    if (respuesta !== null) {
        // Validamos que la respuesta solo contenga números
        if (/^\d+$/.test(respuesta)) {
            // Obtener la URL base
            var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

            // Configurar la solicitud AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", baseURL + "/funciones_base/añadir_enanche.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Manejar la respuesta del servidor
            xhr.onload = function () {
                try {
                    // Si la respuesta del servidor es un mensaje, lo mostramos
                    alert(xhr.responseText); // Mostrar mensaje de éxito o error
                } catch (e) {
                    alert("Error al procesar la respuesta del servidor.");
                }
            };

            xhr.onerror = function () {
                alert("Hubo un error en la conexión con el servidor.");
            };

            // Enviar la solicitud con los parámetros necesarios
            xhr.send(`claveventa=${id_venta}&cantidad=${respuesta}`);
        } else {
            alert("¡Solo se permiten números! Intenta de nuevo.");
        }
    }
}


