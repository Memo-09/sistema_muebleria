var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

document.addEventListener("DOMContentLoaded", function () {
    // Obtener la referencia a la primera tabla y al tbody de la segunda tabla
    const tabla1 = document.getElementById("tabla1").getElementsByTagName("tbody")[0];
    const tabla2 = document.getElementById("tabla2").querySelector("tbody");

    var Sucursal = document.querySelector('#claveSucursal').value;

    // Escuchar eventos de clic en los botones "AGREGAR" de la primera tabla
    tabla1.addEventListener("click", function (event) {
        const btnAgregar = event.target;

        // Verificar si el evento se disparó desde un botón "AGREGAR"
        if (btnAgregar.classList.contains("agregar-btn")) {
            const fila = btnAgregar.closest("tr"); // Obtener la fila del botón "AGREGAR"
            const clave = fila.children[0].textContent.trim();
            const nombre = fila.children[1].textContent.trim();  // Mantener el nombre solo para la tabla

            // Crear una nueva fila para la segunda tabla
            const nuevaFila = document.createElement("tr");
            nuevaFila.setAttribute("data-clave", clave);
            nuevaFila.innerHTML = `
                    <td>${clave}</td>
                    <td>${nombre}</td> <!-- Se mantiene el nombre solo para la tabla -->
                    <td><input type="text" name="existencias" value="1" class="form-control" style="width: 50px;"/></td>
                    <td><a href="#" class="btn btn-danger btn-sm fw-bold eliminar-btn">ELIMINAR</a></td>
                    <td><a href="#" class="btn btn-danger btn-sm fw-bold actualizar-btn">ACTUALIZAR EXISTENCIAS</a></td>
                `;

            // Enviar el producto al servidor usando AJAX
            enviarProducto(clave, nuevaFila); // Pasamos la fila para agregarla si es válido
        }
    });

    // Función para enviar el producto al PHP
    function enviarProducto(clave, nuevaFila) {
        // Crear un objeto FormData para enviar los datos
        const formData = new FormData();
        formData.append("Sucursal", Sucursal);
        formData.append("clave", clave);

        // Enviar los datos al PHP usando AJAX (fetch)
        fetch(baseURL + "/funciones_base/archivo_php_agregar.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                // Verificar el mensaje de la respuesta
                if (data.trim() === "Producto ya registrado en esta sucursal") {
                    // Si el producto ya está registrado, no agregar la fila
                    alert(data); // Imprime lo que devuelve el PHP
                } else {
                    // Si no está registrado, agregar la fila a la tabla2
                    alert(data); // Imprime lo que devuelve el PHP
                    tabla2.appendChild(nuevaFila);
                }
            })
            .catch(error => {
                alert("Error al enviar datos:", error);
            });
    }

    // Escuchar eventos de clic en los botones "ELIMINAR" de la segunda tabla
    tabla2.addEventListener("click", function (event) {
        if (event.target.classList.contains("eliminar-btn")) {
            const fila = event.target.closest("tr"); // Obtener la fila del botón "ELIMINAR"
            const clave = fila.getAttribute("data-clave"); // Obtener la clave de la fila
            const sucursal = document.querySelector('#claveSucursal').value; // Obtener la sucursal

            // Llamar a la función para eliminar el producto desde la base de datos
            eliminarProducto(sucursal, clave, fila);
        }
    });

    // Función para eliminar el producto desde la base de datos
    function eliminarProducto(sucursal, clave, fila) {
        // Crear un objeto FormData para enviar los datos
        const formData = new FormData();
        formData.append("ID_SUCURSAL", sucursal);
        formData.append("CLAVE_PRODUCTO", clave);

        // Enviar los datos al servidor usando AJAX (fetch)
        fetch(baseURL + "/funciones_base/archivo_php_eliminar.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                alert(data);
                fila.remove();
            })
            .catch(error => {
                alert("Error al enviar la solicitud:", error);
            });
    }
});





