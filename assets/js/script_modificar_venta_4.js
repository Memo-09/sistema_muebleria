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
        success: function (response) {
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
                    <td><input type="number" name="cantidad" value="1" min="1" class="form-control" style="width: 70px;" data-existencias="${existencias}" disabled></td>
                    <td><a href="#" class="btn btn-success btn-sm fw-bold eliminar-venta">ELIMINAR</a></td>
                `;

                // Agregar evento para actualizar cantidad
                newRow.querySelector('input[name="cantidad"]').addEventListener("input", actualizarCantidad);
                ventasTableBody.appendChild(newRow);

                alert(response.mensaje);  // Muestra el mensaje de éxito
                sumarCreditos();

                var tbody3 = document.querySelector(".productos tbody");
                tbody3.innerHTML = "";

                const combo = document.getElementById("ComboSucursalProducto");
                combo.value = "seleccion";

                actualizarPrecios();
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en AJAX:", error);
            console.log("Respuesta del servidor:", xhr.responseText); // Mostrar la respuesta para depuración
            alert('Hubo un error al enviar los datos.');
        }
    });
}


function sumarCreditos() {
    const ventasTableBody = document.querySelector(".ventas tbody");
    const creditoInput = document.getElementById("credito1"); // Input de crédito total
    const creditoContadoInput = document.getElementById("crediContado1"); // Input de crédito con 20% de descuento
    const contadoInput = document.getElementById("contado1"); // Input de contado con 30% de descuento
    const enganche = document.getElementById("Enganche"); // Input de contado con 30% de descuento

    if (!ventasTableBody || !creditoInput || !creditoContadoInput || !contadoInput) {
        console.error("No se encontró la tabla de ventas o los campos de crédito.");
        return;
    }

    let totalCredito = 0;

    // Recorrer todas las filas de la tabla
    ventasTableBody.querySelectorAll("tr").forEach((row) => {
        const creditoCell = row.querySelector("td:nth-child(3)"); // Celda de crédito (columna 3)
        const cantidadInput = row.querySelector('input[name="cantidad"]'); // Input de cantidad

        // Validar que los elementos existan antes de acceder a ellos
        if (creditoCell && cantidadInput) {
            const credito = parseFloat(creditoCell.textContent); // Obtener el valor del crédito
            const cantidad = parseFloat(cantidadInput.value); // Obtener el valor de la cantidad

            // Calcular el total solo si los valores son válidos
            if (!isNaN(credito) && !isNaN(cantidad)) {
                totalCredito += credito * cantidad; // Multiplicar crédito por cantidad y sumar al total
            }
        }
    });

    // Asignar valores a los inputs con dos decimales
    creditoInput.value = totalCredito.toFixed(2); // Total de crédito
    creditoContadoInput.value = (totalCredito * 0.80).toFixed(2); // Crédito con 20% de descuento
    contadoInput.value = (totalCredito * 0.70).toFixed(2); // Contado con 30% de descuento

    let engancheCalculado = Math.round(totalCredito * 0.10);
    enganche.value = engancheCalculado+".00"; // Contado con 30% de descuento

    console.log("Total de crédito calculado:", totalCredito.toFixed(2));
    console.log("Crédito con 20% de descuento:", creditoContadoInput.value);
    console.log("Contado con 30% de descuento:", contadoInput.value);
    console.log("Enganche Total:", enganche.value);
}

// Ejecutar la suma cuando la página se carga
window.addEventListener('DOMContentLoaded', function () {
    sumarCreditos();
});

// Ejecutar la suma cada vez que se actualice la cantidad
document.querySelectorAll('input[name="cantidad"]').forEach(input => {
    input.addEventListener('input', function () {
        sumarCreditos(); // Recalcular los valores cuando cambie la cantidad
    });
});


// Ejecutar la suma cuando la página se carga
window.addEventListener('DOMContentLoaded', function () {
    sumarCreditos(); // Ejecutar la suma al cargar la página
    calcularPagoMaximo();
});

// Ejecutar la suma cada vez que se actualice la cantidad
document.querySelectorAll('input[name="cantidad"]').forEach(input => {
    input.addEventListener('input', function () {
        sumarCreditos(); // Actualizar el total de crédito cada vez que cambie la cantidad
    });
});










// Eliminar una fila de ventas al hacer clic en un botón de eliminar
document.querySelector(".ventas tbody").addEventListener("click", function (event) {
    if (event.target && event.target.matches(".eliminar-venta")) {
        // Obtener la fila del producto
        const row = event.target.closest("tr");

        // Obtener el valor de la cantidad del input dentro de la fila
        const cantidadInput = row.querySelector('input[name="cantidad"]');
        const cantidad = cantidadInput ? parseFloat(cantidadInput.value) : 0;

        // Validar si la cantidad es válida
        if (isNaN(cantidad) || cantidad <= 0) {
            alert("Cantidad inválida.");
            return;
        }

        // Obtener los datos necesarios para la eliminación
        const idVenta = document.getElementById('clave').value.trim(); // ID de la venta
        const claveProducto = row.cells[0].textContent.trim(); // CLAVE_PRODUCTO de la primera celda
        const almacen = row.cells[3].textContent.trim(); // ALMACÉN de la cuarta celda

        console.log('ID Venta:', idVenta);
        console.log('Clave Producto:', claveProducto);
        console.log('Almacén:', almacen);
        console.log('Cantidad:', cantidad);

        // Validar que los datos sean correctos antes de enviar la solicitud
        if (!idVenta || !claveProducto || !almacen || isNaN(cantidad) || cantidad <= 0) {
            alert("Datos inválidos para eliminar el producto.");
            return;
        }

        // Construir la URL base para AJAX
        var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

        $.ajax({
            url: baseURL + "/funciones_base/eliminar_producto_venta.php", // Archivo PHP para eliminar el producto
            type: 'POST',
            data: {
                idVenta: idVenta, // ID de la venta
                claveProducto: claveProducto, // CLAVE_PRODUCTO del producto a eliminar
                almacen: almacen, // ID del almacén
                cantidad: cantidad // Cantidad del producto a devolver al inventario
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Si la eliminación fue exitosa en la base de datos, eliminamos la fila de la tabla
                    row.remove(); // Eliminar la fila de la tabla
                    sumarCreditos(); // Recalcular el total de crédito
                    alert("Producto eliminado correctamente.");


                    var tbody3 = document.querySelector(".productos tbody");
                    tbody3.innerHTML = "";

                    const combo = document.getElementById("ComboSucursalProducto");
                    combo.value = "seleccion";

                    actualizarPrecios();
                } else {
                    alert("Error al eliminar el producto de la base de datos: " + response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error al eliminar el producto de la base de datos:", error);
                alert("Hubo un error al intentar eliminar el producto.");
            }
        });
    }
});





// Función para actualizar la cantidad y validar las existencias
function actualizarCantidad(event) {
    const cantidadInput = event.target;
    const cantidad = parseInt(cantidadInput.value); // Obtener la cantidad ingresada
    const existencias = parseInt(cantidadInput.getAttribute("data-existencias")); // Obtener existencias disponibles
    sumarCreditos();

    if (cantidad > existencias) {
        // Si la cantidad es mayor que las existencias, mostrar mensaje de alerta
        alert("Existencias insuficientes");
        // Restaurar el valor al valor mínimo (1)
        cantidadInput.value = 1;
        sumarCreditos();
    }

}

// Asignar eventos al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    // Llamar a la función para asignar eventos a los checkboxes (si corresponde)
    asignarEventosCheckboxes();

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



function actualizarPrecios() {
    // Obtener los elementos de los inputs
    var ventaElement = document.getElementById('clave');
    var creditoElement = document.getElementById('credito1');
    var credicontadoElement = document.getElementById('crediContado1');
    var contadoElement = document.getElementById('contado1');
    var engancheElement = document.getElementById('enganche');
    var pagominimoElement = document.getElementById('cantidad1');
    var pagomaximoElement = document.getElementById('cantidad2');

    // Validar que los elementos existan antes de obtener sus valores
    if (!ventaElement || !creditoElement || !credicontadoElement || !contadoElement || !engancheElement || !pagominimoElement || !pagomaximoElement) {
        console.error("No se encontraron todos los campos necesarios para la actualización.");
        return;
    }

    // Obtener los valores de los inputs
    var venta = ventaElement.value.trim();
    var credito = parseFloat(creditoElement.value) || 0;
    var credicontado = parseFloat(credicontadoElement.value) || 0;
    var contado = parseFloat(contadoElement.value) || 0;
    var enganche = parseFloat(engancheElement.value) || 0;
    var pagominimo = parseFloat(pagominimoElement.value) || 0;
    var pagomaximo = parseFloat(pagomaximoElement.value) || 0;

    // Validar que la venta sea válida antes de hacer la petición
    if (!venta) {
        alert("ID de venta inválido.");
        return;
    }

    // Construir la URL base para AJAX
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    $.ajax({
        url: baseURL + "/funciones_base/actualizar_precios.php", // Archivo PHP para actualizar los precios
        type: 'POST',
        data: {
            venta: venta,           // ID de la venta
            credito: credito,       // Total de crédito
            credicontado: credicontado, // Total con 20% de descuento
            contado: contado,       // Total con 30% de descuento
            enganche: enganche,     // Enganche
            pagominimo: pagominimo, // Pago mínimo
            pagomaximo: pagomaximo  // Pago máximo
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                console.log("Se actualizaron los precios correctamente.");
            } else {
                console.log("Error al actualizar los precios: " + response.error);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición AJAX:", error);
            // Revisar si la respuesta no es JSON y mostrarla
            try {
                var response = JSON.parse(xhr.responseText);
                console.log("Respuesta JSON:", response);
            } catch (e) {
                console.error("La respuesta no es un JSON válido:", xhr.responseText);
            }
        }
    });
}



document.addEventListener("DOMContentLoaded", function () {
    const comboDia = document.getElementById("Combodia");
    const inputDia = document.getElementById("diaMod");

    comboDia.addEventListener("change", function () {
        // Obtener el texto de la opción seleccionada
        const selectedText = comboDia.options[comboDia.selectedIndex].text;
        inputDia.value = selectedText; // Asignar el texto al input
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const comboTipoPago = document.getElementById("ComboTipoPago");
    const inputPago = document.getElementById("pagoMod");

    comboTipoPago.addEventListener("change", function () {
        // Obtener el texto de la opción seleccionada
        const selectedText = comboTipoPago.options[comboTipoPago.selectedIndex].text;
        inputPago.value = selectedText; // Asignar el texto al input
    });
});




function actualizarVentaDatosA() {
    var venta = document.getElementById('clave').value.trim();
    var pagominimo = document.getElementById('cantidad1').value.trim();
    var pagomaximo = document.getElementById('cantidad2').value.trim();
    var dia = document.getElementById('diaMod').value.trim();
    var tipopago = document.getElementById('pagoMod').value.trim();

    // Validar que los campos no estén vacíos
    if (pagominimo === "") {
        alert("No puede estar vacío el campo de pago mínimo.");
        return;
    }

    if (venta === "" || dia === "" || tipopago === "") {
        alert("Faltan datos para actualizar la venta.");
        return;
    }

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    $.ajax({
        url: baseURL + "/funciones_base/actualizar_venta_base.php", // Archivo PHP para actualizar la venta
        type: 'POST',
        data: {
            id_venta: venta,
            pago_minomo: pagominimo,
            pago_max: pagomaximo,
            descripcion_dia: dia,
            descripcion_tipopago: tipopago
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                alert("Se actualizaron los datos de la venta correctamente.");
                console.log("Venta actualizada correctamente:", response);
                location.reload();
            } else {
                alert("Error al actualizar la venta: " + response.error);
                console.error("Error en la actualización:", response.error);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición AJAX:", error);
            alert("Hubo un error al actualizar la venta.");
        }
    });
}
