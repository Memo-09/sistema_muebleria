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
                tbody3.innerHTML = "";
            } else {
                console.log("Datos de productos:", data);
                agregarFilasATabla(data);
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

    datos.forEach((fila) => {
        var row = document.createElement("tr");
        row.innerHTML = `
            <td>
                <label class="checkboxs">
                    <input type="checkbox" class="asignar-checkbox"
                        data-id="${fila.CLAVE_PRODUCTO}"
                        data-nombre="${fila.NOMBRE_PRODUCTO}"
                        data-marca="${fila.DESCRIPCION_MARCA}"
                        data-caracteristicas="${fila.CARACTERISTICAS_PRODUCTO}"
                        data-color="${fila.DESCRIPCION_COLOR}"
                        data-credito="${fila.PRECIO_CREDITO}">
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

            if (this.checked) {
                agregarFilaVenta(id, nombre, marca, caracteristicas, color, credito);
            } else {
                eliminarFilaVenta(id);
            }

            actualizarTotalCredito();
        });
    });
}

// Agregar una fila a la tabla de ventas
function agregarFilaVenta(id, nombre, marca, caracteristicas, color, credito) {
    const ventasTableBody = document.querySelector(".ventas tbody");

    // Verificar si el producto ya está en la tabla de ventas
    const productoExistente = Array.from(ventasTableBody.querySelectorAll("tr")).some((row) => {
        return row.cells[0].textContent === id;
    });

    if (productoExistente) {
        // Mostrar mensaje de advertencia si el producto ya está agregado
        alert("Producto ya agregado a la lista de la venta");
        return; // Detener la ejecución de la función si el producto ya existe
    }

    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>${id}</td>
        <td>${nombre} ${caracteristicas}, MARCA ${marca}, COLOR: ${color}</td>
        <td>${credito}</td>
        <td><input type="number" name="cantidad" value="1" min="1" class="form-control" style="width: 50px;"></td>
        <td><a href="#" class="btn btn-success btn-sm fw-bold eliminar-venta">EL.</a></td>
    `;

    newRow.querySelector('input[name="cantidad"]').addEventListener("input", actualizarTotalCredito);
    ventasTableBody.appendChild(newRow);

    // Actualizar el total después de agregar la fila
    actualizarTotalCredito();
}

// Eliminar una fila de la tabla de ventas por su ID
function eliminarFilaVenta(id) {
    const ventasTableBody = document.querySelector(".ventas tbody");
    const rows = ventasTableBody.querySelectorAll("tr");

    rows.forEach((row) => {
        const rowId = row.cells[0].textContent;
        if (rowId === id) {
            row.remove();
        }
    });

    actualizarTotalCredito();
}

// Actualizar el total de crédito y calcular descuentos
function actualizarTotalCredito() {
    const ventasTableBody = document.querySelector(".ventas tbody");
    const creditoInput = document.getElementById("credito1");
    const creditoContadoInput = document.getElementById("crediContado1");
    const contadoInput = document.getElementById("contado1");

    let totalCredito = 0;

    ventasTableBody.querySelectorAll("tr").forEach((row) => {
        const credito = parseFloat(row.cells[2].textContent);
        const cantidad = parseFloat(row.querySelector('input[name="cantidad"]').value);

        totalCredito += isNaN(credito) || isNaN(cantidad) ? 0 : credito * cantidad;
    });

    creditoInput.value = totalCredito.toFixed(2);
    creditoContadoInput.value = (totalCredito * 0.80).toFixed(2); // Descuento del 20%
    contadoInput.value = (totalCredito * 0.70).toFixed(2); // Descuento del 30%
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

            if (this.checked) {
                // Si el checkbox está marcado, agregar la fila a la tabla de ventas
                agregarFilaVenta(id, nombre, marca, caracteristicas, color, credito);
            } else {
                // Si el checkbox está desmarcado, eliminar la fila de la tabla de ventas
                eliminarFilaVenta(id);
            }

            // Desmarcar el checkbox después de agregar el producto
            this.checked = false;
        });
    });
}

// Eliminar una fila de ventas al hacer clic en un botón de eliminar
document.querySelector(".ventas tbody").addEventListener("click", function (event) {
    if (event.target && event.target.matches(".eliminar-venta")) {
        event.target.closest("tr").remove();
        actualizarTotalCredito();
    }
});

// Asignar eventos al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    // Llamar a la función para asignar eventos a los checkboxes
    asignarEventosCheckboxes();

    // Actualizar el total al cargar la página
    actualizarTotalCredito();
});


