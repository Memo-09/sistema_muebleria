function actualizarSucursal(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var claveSucursal = document.querySelector('#claveSucursal1').value;
    var ubicacionSucursal = document.querySelector('#ubicacion1').value;

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('claveSucursal', claveSucursal);
    formData.append('ubicacionSucursal', ubicacionSucursal);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/modificar_sucursal.php", true); // Ruta al archivo PHP que procesará la actualización
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor

            // Si el mensaje es de éxito, recargar la página
            if (xhr.responseText.includes("Sucursal actualizada correctamente")) {
                location.reload(); // Recargar la página después
            }
        } else {
            alert("Hubo un error al actualizar la sucursal.");
        }
    };
    xhr.send(formData);
}
