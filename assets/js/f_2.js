// Función para manejar el envío del formulario con AJAX
function guardarSucursal(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger el valor del campo de sucursal
    var sucursal = document.querySelector('#ubicacionSucursal').value.trim();

    if (!sucursal) {
        alert("El campo Sucursal no puede estar vacío.");
        return;
    }

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('sucursal', sucursal);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_sucursal.php", true); // Ajusta la ruta al archivo PHP correcto
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                alert(response.message); // Mostrar mensaje del servidor
                if (response.success) {
                    location.reload(); // Recargar la página en caso de éxito
                }
            } catch (error) {
                console.error("Error al procesar la respuesta del servidor:", error);
                alert("Error al procesar la respuesta del servidor.");
            }
        } else {
            alert("Hubo un error al insertar la Sucursal.");
        }
    };
    xhr.onerror = function () {
        alert("Hubo un error en la conexión con el servidor.");
    };
    xhr.send(formData);
}
