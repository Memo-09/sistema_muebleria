// Función para manejar el envío del formulario con AJAX
function actualizarProducto(event) {
    event.preventDefault();

    var claveProducto = document.querySelector('#claveProducto').value;
    var nombreProducto = document.querySelector('#nombreProducto').value;
    var marca = document.querySelector('#marca').value;
    var color = document.querySelector('#color').value;
    var caracteristicas = document.querySelector('#caracteristicas').value;
    var precioContado = document.querySelector('#precioContado').value;
    var crediContado = document.querySelector('#crediContado').value;
    var credito = document.querySelector('#credito').value;
    var enganche = document.querySelector('#enganche').value;
    var comision = document.querySelector('#comision').value;
    var categoria = document.querySelector('#categoria').value; // Nuevo campo

    var formData = new FormData();
    formData.append('claveProducto', claveProducto);
    formData.append('nombreProducto', nombreProducto);
    formData.append('marca', marca);
    formData.append('color', color);
    formData.append('caracteristicas', caracteristicas);
    formData.append('precioContado', precioContado);
    formData.append('crediContado', crediContado);
    formData.append('credito', credito);
    formData.append('enganche', enganche);
    formData.append('comision', comision);
    formData.append('categoria', categoria); // Nuevo dato

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/modificar_producto.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            if (xhr.responseText.includes("Producto actualizado correctamente")) {
                location.reload();
            }
        } else {
            alert("Hubo un error al actualizar el producto.");
        }
    };
    xhr.send(formData);
}



function actualizarMarca(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var idMarca = document.querySelector('#idmodificarMarca1').value; // Asegúrate de que el ID sea correcto
    var descripcionMarca = document.querySelector('#modificarMarca1').value; // Asegúrate de que el ID sea correcto

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('idMarca', idMarca); // Asegúrate de que el nombre coincida con el de PHP
    formData.append('descripcionMarca', descripcionMarca); // Asegúrate de que el nombre coincida con el de PHP

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/modificar_marca.php", true); // Ruta al archivo PHP que procesará la actualización
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor

            // Si el mensaje es de éxito, recargar la página
            if (xhr.responseText.includes("Marca actualizada correctamente")) {
                location.reload(); // Recargar la página después
            }
        } else {
            alert("Hubo un error al actualizar la marca.");
        }
    };
    xhr.send(formData);
}


function actualizarColor(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var idColor = document.querySelector('#idmodificarColor').value; // Cambiar ID según el HTML
    var descripcionColor = document.querySelector('#modificarColor').value; // Cambiar ID según el HTML

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('idColor', idColor);
    formData.append('descripcionColor', descripcionColor);

    // Ajustar baseURL a tu estructura de carpetas
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/modificar_color.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor

            // Recargar la página si la respuesta es exitosa
            if (xhr.responseText.includes("Color actualizado correctamente")) {
                location.reload();
            }
        } else {
            alert("Hubo un error al actualizar el color.");
        }
    };
    xhr.send(formData);
}
