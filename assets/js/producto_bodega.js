function guardarProductoBodega() {
    // Obtener la clave de la sucursal
    var claveBodega = document.getElementById("claveBodega").value;

    // Obtener todos los productos seleccionados en la segunda tabla
    var productosSeleccionados = [];
    var filas = document.querySelectorAll("#tabla2 tbody tr");

    // Iterar sobre las filas de la tabla para obtener los productos seleccionados
    filas.forEach(function(fila) {
        var claveProducto = fila.children[0].textContent;
        var nombreProducto = fila.children[1].textContent;
        var credito = fila.children[2].textContent;
        var existencias = fila.querySelector("input[name='existencias']").value; // Obtener las existencias

        productosSeleccionados.push({
            claveProducto: claveProducto,
            nombreProducto: nombreProducto,
            credito: credito,
            existencias: existencias // Agregar las existencias al objeto
        });
    });

    // Verificar si hay productos seleccionados
    if (productosSeleccionados.length === 0) {
        alert("Por favor, seleccione al menos un producto.");
        return;
    }

    // Crear el objeto FormData para enviar los datos
    var formData = new FormData();
    formData.append("claveBodega", claveBodega);

    // Agregar los productos seleccionados al FormData
    productosSeleccionados.forEach(function(producto, index) {
        formData.append("productos[" + index + "][claveProducto]", producto.claveProducto);
        formData.append("productos[" + index + "][existencias]", producto.existencias);
    });

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_producto_bodega.php", true);
    
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Respuesta exitosa
            if (xhr.responseText.trim() === "Productos insertados correctamente en la Bodega") {
                // Redirigir al usuario al archivo sucursales.php
                alert(xhr.responseText);
                window.location.href = baseURL + "/bodegas.php";
            } else {
                // Mostrar el mensaje de error enviado por el servidor
                alert("Error: " + xhr.responseText);
            }
        } else {
            // Error
            alert("Hubo un error al procesar los datos.");
        }
    };
    
    xhr.send(formData); // Enviar los datos al servidor
}


