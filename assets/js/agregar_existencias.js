function toglepopupExistencias(clave, existencias) {
    const popup = document.getElementById("popupAgregarExistencias");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupJuegoExistencias"); // El botón de cerrar (Cancelar)

    // Mostrar la ventana emergente
    popup.style.display = "flex"; // Mostrar la ventana emergente

    // Ocultar el menú lateral
    sidebar.style.display = "none"; // Ocultar el menú lateral

    document.getElementById("idJuego2").value = clave;
    document.getElementById("existencias2").value = existencias;


    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

        // Limpiar todos los campos de texto dentro del popup
        const inputs = popup.querySelectorAll('input[type="text"]'); // Obtener todos los cuadros de texto dentro del popup
        inputs.forEach(function (input) {
            input.value = ""; // Limpiar el contenido de cada cuadro de texto
        });
    });
}


function actualizarExistencias(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    // Obtener los valores de los inputs
    var claveJuego = document.querySelector('#idJuego2').value.trim();
    var existencias = document.querySelector('#existencias2').value.trim();

    // Validaciones
    if (!claveJuego) {
        alert("Por favor, ingrese la clave del juego.");
        return;
    }
    if (!existencias || isNaN(existencias) || parseInt(existencias) < 0) {
        alert("Por favor, ingrese un número válido de existencias.");
        return;
    }

    // Crear objeto FormData para enviar los datos
    var formData = new FormData();
    formData.append('idJuego', claveJuego);
    formData.append('existencias', existencias);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    // Construcción correcta de la URL
    var baseURL2 = baseURL + "/funciones_base/actualizar_existencias_juego.php";

    // Petición AJAX con XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL2, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert("Error: " + response.error);
                }
            } catch (e) {
                console.error("Error en la respuesta del servidor:", xhr.responseText);
            }
        } else {
            alert("Error en la solicitud AJAX.");
        }
    };
    xhr.onerror = function () {
        alert("Error de conexión con el servidor.");
    };
    xhr.send(formData);
}
