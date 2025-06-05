// Obtener el combobox por su ID
var combo = document.getElementById("ComboSucursalProducto");

// Función para mostrar el valor seleccionado del combobox
function mostrarProductosSucursal() {
    var valorSeleccionado = combo.value;

    // Verificar si el valor seleccionado es válido
    if (valorSeleccionado !== "seleccion") {
        console.log("Sucursal seleccionada: " + valorSeleccionado);
        obtenerDatosSucursalProductos(valorSeleccionado);
    }
}

// Función para obtener los productos de la sucursal mediante una solicitud AJAX
function obtenerDatosSucursalProductos(idSucursal) {
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    fetch(baseURL + "/funciones_base/obtener_productos_sucursal.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "idSucursal=" + idSucursal,
    })
        .then((response) => response.json())
        .then((data) => {
            var tbody3 = document.querySelector(".productos tbody");

            if (data.length === 0) {
                alert("No cuenta con Productos");
                document.getElementById("buscarprod").value = ""; // Borra el texto del cuadro
                tbody3.innerHTML = "";
            } else {
                console.log("Datos de productos:", data);
                agregarFilasATabla(data);
                document.getElementById("buscarprod").value = ""; // Borra el texto del cuadro
            }
        })
        .catch((error) => {
            console.error("Error al obtener los datos de productos:", error);
        });
}

// Función para agregar filas a la tabla de productos
function agregarFilasATabla(datos) {
    var tbody = document.querySelector(".productos tbody");

    // Limpiar las filas existentes
    tbody.innerHTML = "";

    datos.forEach((fila, index) => {
        var row = document.createElement("tr");

        // Verificar si las existencias son 0
        if (fila.EXISTENCIAS == 0) {
            row.style.backgroundColor = "#FF5733"; // Rojo para las filas con existencias 0
        } else {
            // Asignar color de fondo dependiendo de si la fila es par o impar
            if (index % 2 === 0) {
                row.style.backgroundColor = "#FFCC80"; // Naranja claro para las filas pares
            } else {
                row.style.backgroundColor = "#FFFFFF"; // Blanco para las filas impares
            }
        }

        row.innerHTML = `
            <td>
                <label class="checkboxs">
                    <input type="checkbox" class="asignar-checkbox"
                        data-id="${fila.CLAVE_PRODUCTO}"
                        data-nombre="${fila.NOMBRE_PRODUCTO}"
                        data-marca="${fila.DESCRIPCION_MARCA}"
                        data-caracteristicas="${fila.CARACTERISTICAS_PRODUCTO}"
                        data-color="${fila.DESCRIPCION_COLOR}"
                        data-credito="${fila.PRECIO_CREDITO}"
                        data-existencias="${fila.EXISTENCIAS}"
                        ${fila.EXISTENCIAS == 0 ? 'disabled' : ''}> <!-- Deshabilitar el checkbox si existencias son 0 -->
                    <span class="checkmarks"></span>
                </label>
            </td>
            <td>${fila.CLAVE_PRODUCTO}</td>
            <td>${fila.NOMBRE_PRODUCTO} ${fila.CARACTERISTICAS_PRODUCTO}, MARCA: ${fila.DESCRIPCION_MARCA}, COLOR: ${fila.DESCRIPCION_COLOR}</td>
            <td>${fila.PRECIO_CREDITO}</td>
            <td>${fila.EXISTENCIAS}</td>
        `;

        tbody.appendChild(row);
    });

    // Reasignar eventos a los checkboxes después de actualizar la tabla
    asignarEventosCheckboxes();

    // Desmarcar todos los checkboxes
    const checkboxes = document.querySelectorAll(".asignar-checkbox");
    checkboxes.forEach((checkbox) => {
        checkbox.checked = false;
    });
}



// Asignar eventos a los checkboxes de productos
function asignarEventosCheckboxes() {
    const checkboxes = document.querySelectorAll(".asignar-checkbox");

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const id = this.getAttribute("data-id");
            const nombre = this.getAttribute("data-nombre");
            const marca = this.getAttribute("data-marca");
            const caracteristicas = this.getAttribute("data-caracteristicas");
            const color = this.getAttribute("data-color");
            const credito = this.getAttribute("data-credito");
            const existencias = parseInt(this.getAttribute("data-existencias")); // Obtener existencias

            if (this.checked) {
                agregarFilaVenta(id, nombre, marca, caracteristicas, color, credito, existencias);
            } else {
                eliminarFilaVenta(id);
            }
            this.checked = false;
        });
    });
}





// Agregar una fila a la tabla de ventas
function agregarFilaVenta(id, nombre, marca, caracteristicas, color, credito, existencias) {
    const ventasTableBody = document.querySelector(".ventas tbody");

    // Validar si la tabla existe
    if (!ventasTableBody) {
        console.error("No se encontró el tbody de la tabla de ventas.");
        return;
    }

    // Obtener el valor del combo (ya está definido fuera de la función)
    var valorSeleccionado2 = combo.value;

    // Obtener el ID de la venta correctamente
    var ventaElement = document.getElementById('clave');
    if (!ventaElement) {
        console.error("No se encontró el campo 'clave' de la venta.");
        return;
    }
    var venta = ventaElement.value; // Obtener el valor correcto

    var datos = {
        venta: venta, // Corregido: Enviar el valor, no el elemento HTML
        id: id,
        valorSeleccionado2: valorSeleccionado2
    };

    // Construir URL base para AJAX
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    $.ajax({
        url: baseURL + "/funciones_base/agregar_producto_venta.php",
        type: 'POST',
        data: { datos: JSON.stringify(datos) }, // Convertimos el objeto a JSON
        dataType: 'json', // Esperamos una respuesta en JSON
        success: function(response) {
            console.log("Respuesta del servidor:", response);
            
            // Si hay un error indicando que el producto ya está en la venta, no hacer nada
            if (response.error && response.error.includes("El producto ya está asociado a esta venta")) {
                alert(response.error);  // Mostrar mensaje de error
                return; // No agrega la fila ni actualiza el total
            }

            // Si no hay error, agregar la fila a la tabla de ventas
            if (response.mensaje) {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${id}</td>
                    <td>${nombre} ${caracteristicas}, MARCA ${marca}, COLOR: ${color}</td>
                    <td>${credito}</td>
                    <td>${valorSeleccionado2}</td>
                    <td><input type="number" name="cantidad" value="1" min="1" class="form-control" style="width: 70px;" data-existencias="${existencias}"></td>
                    <td><a href="#" class="btn btn-success btn-sm fw-bold eliminar-venta">ELIMINAR</a></td>
                `;

                // Agregar evento para actualizar cantidad
                newRow.querySelector('input[name="cantidad"]').addEventListener("input", actualizarCantidad);
                ventasTableBody.appendChild(newRow);
                
                alert(response.mensaje);  // Muestra el mensaje de éxito
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            console.log("Respuesta del servidor:", xhr.responseText); // Mostrar la respuesta para depuración
            alert('Hubo un error al enviar los datos.');
        }
    });
}












// Eliminar una fila de ventas al hacer clic en un botón de eliminar
document.querySelector(".ventas tbody").addEventListener("click", function (event) {
    if (event.target && event.target.matches(".eliminar-venta")) {
        event.target.closest("tr").remove();
        actualizarTotalCredito();
    }
});



// Función para actualizar la cantidad y validar las existencias
function actualizarCantidad(event) {
    const cantidadInput = event.target;
    const cantidad = parseInt(cantidadInput.value); // Obtener la cantidad ingresada
    const existencias = parseInt(cantidadInput.getAttribute("data-existencias")); // Obtener existencias disponibles

    if (cantidad > existencias) {
        // Si la cantidad es mayor que las existencias, mostrar mensaje de alerta
        alert("Existencias insuficientes");
        // Restaurar el valor al valor mínimo (1)
        cantidadInput.value = 1;
    }

    // Actualizar el total después de la validación
    actualizarTotalCredito();
}

// Asignar eventos al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    // Llamar a la función para asignar eventos a los checkboxes (si corresponde)
    asignarEventosCheckboxes();

    // Actualizar el total al cargar la página
    actualizarTotalCredito();
});

// Filtrar productos según la búsqueda
document.getElementById('buscarprod').addEventListener('input', function () {
    const filter = this.value.toLowerCase(); // Convertir a minúsculas para búsqueda no sensible a mayúsculas
    const rows = document.querySelectorAll('.productos tbody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td'); // Obtener todas las celdas de la fila
        const match = Array.from(cells).some(cell => 
            cell.textContent.toLowerCase().includes(filter)
        );

        // Mostrar u ocultar filas según si coinciden con la búsqueda
        row.style.display = match ? '' : 'none';
    });
});

// Función para calcular el pago máximo
function calcularPagoMaximo() {
    // Obtener el valor del campo 'cantidad1' (Pago Mínimo)
    const pagoMinimo = parseFloat(document.getElementById("cantidad1").value);

    // Verificar si el valor es un número y mayor que 0
    if (!isNaN(pagoMinimo) && pagoMinimo > 0) {
        // Calcular el pago máximo (el doble del pago mínimo)
        const pagoMaximo = pagoMinimo * 2;

        // Asignar el valor calculado al campo 'cantidad2' (Pago Máximo)
        document.getElementById("cantidad2").value = pagoMaximo.toFixed(2); // Muestra con dos decimales
    } else {
        // Si el valor es inválido, dejar el campo de pago máximo vacío
        document.getElementById("cantidad2").value = "";
    }
}


document.getElementById("cantidad1").addEventListener("input", calcularPagoMaximo);