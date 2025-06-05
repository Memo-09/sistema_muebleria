// Función para manejar el envío del formulario con AJAX
function guardarProducto(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var claveProducto = document.querySelector('#claveProducto1').value;
    var nombreProducto = document.querySelector('#nombreProducto1').value;
    var marca = document.querySelector('#ComboMarca').value;
    var caracteristicas = document.querySelector('#caracteristicas1').value;
    var color = document.querySelector('#ComboColor').value;
    var credito = document.querySelector('#precioCredito1').value;
    var crediContado = document.querySelector('#crediContado1').value;
    var precioContado = document.querySelector('#contado1').value;
    var enganche = document.querySelector('#enganche1').value;
    var comision = document.querySelector('#comision1').value;

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('clave_producto', claveProducto);
    formData.append('nombre_producto', nombreProducto);
    formData.append('marca', marca);
    formData.append('caracteristicas', caracteristicas);
    formData.append('color', color);
    formData.append('precio_contado', precioContado);
    formData.append('credi_contado', crediContado);
    formData.append('credito', credito);
    formData.append('enganche', enganche);
    formData.append('comision', comision);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_producto.php", true); // Ruta al archivo PHP que procesará el formulario
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor

            // Si el mensaje es de éxito, recargar la página
            if (xhr.responseText.includes("Producto insertado correctamente")) {
                location.reload(); // Recargar la página después
            }
        } else {
            alert("Hubo un error al insertar el producto.");
        }
    };
    xhr.send(formData);
}




+
// Función para manejar el envío del formulario con AJAX
function guardarMarca(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var marca = document.querySelector('#nuevaMarca').value.trim();

    if (!marca) {
        alert("El campo Marca no puede estar vacío.");
        return;
    }

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('marca', marca);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_marca.php", true); // Ajusta la ruta al archivo PHP correcto
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                alert(response.message); // Mostrar mensaje del servidor
                if (response.success) {
                    location.reload(); // Recargar la página en caso de éxito
                }
            } catch (error) {
                alert("Error al procesar la respuesta del servidor.");
            }
        } else {
            alert("Hubo un error al insertar la marca.");
        }
    };
    xhr.onerror = function () {
        alert("Hubo un error en la conexión con el servidor.");
    };
    xhr.send(formData);
}




// Función para manejar el envío del formulario con AJAX
function guardarColor(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger el valor del campo de color
    var color = document.querySelector('#nuevoColor').value.trim();

    if (!color) {
        alert("El campo Color no puede estar vacío.");
        return;
    }

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('color', color);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_color.php", true); // Ajusta la ruta al archivo PHP correcto
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                alert(response.message); // Mostrar mensaje del servidor
                if (response.success) {
                    location.reload(); // Recargar la página en caso de éxito
                }
            } catch (error) {
                alert("Error al procesar la respuesta del servidor.");
            }
        } else {
            alert("Hubo un error al insertar el color.");
        }
    };
    xhr.onerror = function () {
        alert("Hubo un error en la conexión con el servidor.");
    };
    xhr.send(formData);
}
