function actualizarBodega(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var claveBodega = document.querySelector('#claveSucursal1').value;
    var ubicacionBodega = document.querySelector('#ubicacion1').value;

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('claveBodega', claveBodega);
    formData.append('ubicacionBodega', ubicacionBodega);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/modificar_bodega.php", true); // Ruta al archivo PHP que procesará la actualización
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor

            // Si el mensaje es de éxito, recargar la página
            if (xhr.responseText.includes("Bodega actualizada correctamente")) {
                location.reload(); // Recargar la página después
            }
        } else {
            alert("Hubo un error al actualizar la Bodega.");
        }
    };
    xhr.send(formData);
}
