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

            actualizarTotalCredito();
            this.checked = false;
        });
    });
}

// Agregar una fila a la tabla de ventas
function agregarFilaVenta(id, nombre, marca, caracteristicas, color, credito, existencias) {
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

    var valorSeleccionado2 = combo.value;
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>${id}</td>
        <td>${nombre} ${caracteristicas}, MARCA ${marca}, COLOR: ${color}</td>
        <td>${credito}</td>
        <td>${valorSeleccionado2}</td>
        <td><input type="number" name="cantidad" value="1" min="1" class="form-control" style="width: 70px;" data-existencias="${existencias}"></td>
        <td><a href="#" class="btn btn-success btn-sm fw-bold eliminar-venta">ELIMINAR</a></td>
    `;

    newRow.querySelector('input[name="cantidad"]').addEventListener("input", actualizarCantidad);
    ventasTableBody.appendChild(newRow);

    // Actualizar el total después de agregar la fila
    actualizarTotalCredito();
    // Asignar la fecha de 50 semanas si el crédito es válido
    const fechaResultado = calcularFecha50Semanas();
    inputFecha.value = fechaResultado;

    // Asignar la fecha de 2 meses si el crédito es válido
    const fechaResultado2 = calcularFechaDosMeses();
    inputFechaLimite.value = fechaResultado2;

    // Calcular la fecha y asignarla al input
    const fechaResultado3 = calcularFechaUnMes();
    inputFechaLimiteMes.value = fechaResultado3; // Mostrar la fecha en formato YYYY-MM-DD


    document.getElementById("fechaactual").value = obtenerFechaActual();
}

// Eliminar una fila de ventas al hacer clic en un botón de eliminar
document.querySelector(".ventas tbody").addEventListener("click", function (event) {
    if (event.target && event.target.matches(".eliminar-venta")) {
        event.target.closest("tr").remove();
        actualizarTotalCredito();
    }
});

// Actualizar el total de crédito y calcular descuentos
function actualizarTotalCredito() {
    const ventasTableBody = document.querySelector(".ventas tbody");
    const creditoInput = document.getElementById("credito1");
    const creditoContadoInput = document.getElementById("crediContado1");
    const contadoInput = document.getElementById("contado1");
    const engancheInput = document.getElementById("enganche_total");

    let totalCredito = 0;

    // Calcular el total del crédito sumando los productos
    ventasTableBody.querySelectorAll("tr").forEach((row) => {
        const credito = parseFloat(row.cells[2].textContent);
        const cantidad = parseFloat(row.querySelector('input[name="cantidad"]').value);

        totalCredito += isNaN(credito) || isNaN(cantidad) ? 0 : credito * cantidad;
    });

    // Asignar los valores calculados a los inputs correspondientes
    creditoInput.value = totalCredito.toFixed(2);
    creditoContadoInput.value = (totalCredito * 0.80).toFixed(2); // 20% de descuento
    contadoInput.value = (totalCredito * 0.70).toFixed(2); // 30% de descuento

    // Calcular y asignar el enganche (10% del precio de crédito)
    let enganche = Math.round(totalCredito * 0.10);
    engancheInput.value = enganche+".00";
}


// Función para actualizar la cantidad y validar las existencias
function actualizarCantidad(event) {
    const cantidadInput = event.target;
    const cantidad = parseInt(cantidadInput.value);
    const existencias = parseInt(cantidadInput.getAttribute("data-existencias")); // Obtener existencias

    if (cantidad > existencias) {
        // Si la cantidad es mayor que las existencias, mostrar mensaje de alerta
        alert("Existencias insuficientes");
        // Restaurar el valor al valor mínimo (1)
        cantidadInput.value = 1;
    }

    // Actualizar total después de la validación
    actualizarTotalCredito();
}

// Asignar eventos al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    // Llamar a la función para asignar eventos a los checkboxes
    asignarEventosCheckboxes();

    // Actualizar el total al cargar la página
    actualizarTotalCredito();
});


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




function calcularFechaUnMes() {
    const fechaActual = new Date(); // Fecha actual

    // Sumar 1 mes a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setMonth(fechaActual.getMonth() + 1);

    // Formatear la fecha a YYYY-MM-DD
    const año = fechaFutura.getFullYear();
    const mes = String(fechaFutura.getMonth() + 1).padStart(2, '0'); // Mes en formato 2 dígitos
    const día = String(fechaFutura.getDate()).padStart(2, '0'); // Día en formato 2 dígitos

    return `${año}-${mes}-${día}`; // Devuelve la fecha formateada
}

function calcularFecha50Semanas() {
    const fechaActual = new Date(); // Fecha actual
    const semanas = 50; // Cantidad de semanas
    const dias = semanas * 7; // Convertir semanas a días

    // Sumar los días a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setDate(fechaActual.getDate() + dias);

    return formatearFechaYYYYMMDD(fechaFutura); // Devuelve la fecha formateada
}

// Función para calcular la fecha dentro de 2 meses
function calcularFechaDosMeses() {
    const fechaActual = new Date(); // Fecha actual

    // Sumar 2 meses a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setMonth(fechaActual.getMonth() + 2);

    return formatearFechaYYYYMMDD(fechaFutura); // Devuelve la fecha formateada
}

// Función para formatear una fecha en el formato YYYY-MM-DD
function formatearFechaYYYYMMDD(fecha) {
    const año = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // Mes en 2 dígitos
    const día = String(fecha.getDate()).padStart(2, '0'); // Día en 2 dígitos
    return `${año}-${mes}-${día}`; // Formato YYYY-MM-DD
}

// Verificar si el crédito está vacío o en cero antes de asignar las fechas
const inputFecha = document.getElementById("fecha1");
const inputFechaLimite = document.getElementById("fecha2");
const inputFechaLimiteMes = document.getElementById("fecha3");

function obtenerFechaActual() {
    const fechaActual = new Date();
    return formatearFechaYYYYMMDD(fechaActual);
}




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