// Función para mostrar el valor seleccionado del combobox
var combo = document.getElementById("ComboClasificacion");
function mostrarProductosClasificacion() {
    var valorSeleccionado = combo.value;

    // Verificar si el valor seleccionado es válido
    if (valorSeleccionado !== "seleccion") {
        console.log("Clasificaion seleccionada: " + valorSeleccionado);
        obtenerDatosSucursalProductos(valorSeleccionado);
    }
}



function obtenerDatosSucursalProductos(idSucursal) {
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    fetch(baseURL + "/funciones_base/obtener_productos_clasificacion.php", {
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


function agregarFilasATabla(datos) {
    var tbody = document.querySelector(".productos tbody");

    // Limpiar las filas existentes
    tbody.innerHTML = "";

    datos.forEach((fila, index) => {
        var row = document.createElement("tr");

        // Asignar color de fondo dependiendo de si la fila es par o impar
        if (index % 2 === 0) {
            row.style.backgroundColor = "#FFCC80"; // Naranja claro para las filas pares
        } else {
            row.style.backgroundColor = "#FFFFFF"; // Blanco para las filas impares
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
                        data-credito="${fila.PRECIO_CREDITO}">
                    <span class="checkmarks"></span>
                </label>
            </td>
            <td>${fila.CLAVE_PRODUCTO}</td>
            <td>${fila.NOMBRE_PRODUCTO} ${fila.CARACTERISTICAS_PRODUCTO}, MARCA: ${fila.DESCRIPCION_MARCA}, COLOR: ${fila.DESCRIPCION_COLOR}</td>
            <td>${parseFloat(fila.PRECIO_CREDITO).toFixed(2)}</td>
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


document.getElementById("buscarprod").addEventListener("keyup", function () {
    var filtro = this.value.toLowerCase();
    var filas = document.querySelectorAll(".productos tbody tr");

    filas.forEach(function (fila) {
        var textoFila = fila.innerText.toLowerCase();
        if (textoFila.includes(filtro)) {
            fila.style.display = "";
        } else {
            fila.style.display = "none";
        }
    });
});



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
                agregarFilaJuego(id, nombre, marca, caracteristicas, color, credito);
                this.checked = false;  // Desmarcar el checkbox automáticamente
            } else {
                eliminarFilaVenta(id);
            }

            actualizarTotalCredito();
        });
    });
}

function agregarFilaJuego(id, nombre, marca, caracteristicas, color, credito) {
    const juegoTableBody = document.querySelector(".juegos tbody");

    // Verificar si el producto ya está en la tabla de juegos
    const productoExistente = Array.from(juegoTableBody.querySelectorAll("tr")).some((row) => {
        return row.cells[0].textContent === id;
    });

    if (productoExistente) {
        alert("Producto ya agregado a la lista");
        return;
    }

    // Crear una nueva fila y agregarla a la tabla
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>${id}</td>
        <td>${nombre} ${caracteristicas}, MARCA ${marca}, COLOR: ${color}</td>
        <td>${parseFloat(credito).toFixed(2)}</td>
        <td><a href="#" class="btn btn-success btn-sm fw-bold eliminar-producto-juego">ELIMINAR</a></td>
    `;
    juegoTableBody.appendChild(newRow);

    // Agregar el evento de eliminación
    const btnEliminar = newRow.querySelector(".eliminar-producto-juego");
    btnEliminar.addEventListener("click", function (event) {
        event.preventDefault();
        eliminarFilaVenta(id); // Eliminar de la tabla de juegos
        deseleccionarCheckbox(id); // Deseleccionar el checkbox en el combo
    });

    actualizarTotalCredito(); // Asegurarse de que se llame después de agregar la fila
}

function eliminarFilaVenta(id) {
    const juegoTableBody = document.querySelector(".juegos tbody");

    // Buscar la fila con la clave del producto y eliminarla
    const filas = juegoTableBody.querySelectorAll("tr");
    filas.forEach((fila) => {
        if (fila.cells[0].textContent === id) {
            juegoTableBody.removeChild(fila);
        }
    });

    actualizarTotalCredito();
}


function deseleccionarCheckbox(id) {
    const checkboxes = document.querySelectorAll(".asignar-checkbox");

    // Buscar el checkbox correspondiente al producto y deseleccionarlo
    checkboxes.forEach((checkbox) => {
        if (checkbox.getAttribute("data-id") === id) {
            checkbox.checked = false;
        }
    });
}

function actualizarTotalCredito() {
    const juegoTableBody = document.querySelector(".juegos tbody");
    const creditoInput = document.getElementById("creditoClasificacion");
    const creditoContadoInput = document.getElementById("crediContadoClasificacion");
    const contadoInput = document.getElementById("contadoClasificacion");
    const engancheInput = document.getElementById("engancheClasificacion");
    const comisionInput = document.getElementById("comisionClasificacion");

    let totalCredito = 0;

    // Verificar si la tabla tiene filas
    if (juegoTableBody.querySelectorAll("tr").length === 0) {
        creditoInput.value = "0.00"; // Si no hay productos, poner 0.00
        creditoContadoInput.value = "0.00";
        contadoInput.value = "0.00";
        engancheInput.value = "0.00";
        comisionInput.value = "0.00";
        return; // Salir si la tabla está vacía
    }

    // Recorrer las filas de la tabla y sumar los créditos
    juegoTableBody.querySelectorAll("tr").forEach((row) => {
        const credito = parseFloat(row.cells[2].textContent) || 0; // Obtener el crédito (columna 3)

        totalCredito += credito; // Sumar el crédito
    });

    // Asignar los valores a los inputs de crédito
    creditoInput.value = totalCredito.toFixed(2); // Crédito total
    creditoContadoInput.value = (totalCredito * 0.80).toFixed(2); // Crédito con 20% de descuento
    contadoInput.value = (totalCredito * 0.70).toFixed(2); // Crédito con 30% de descuento

    // Calcular enganche y comisión
    let enganche = totalCredito * 0.10; // 10% del crédito
    let comision = totalCredito / 50; // Comisión dividida entre 50

    // Asignar los valores de enganche y comisión
    engancheInput.value = enganche.toFixed(2);
    comisionInput.value = comision.toFixed(2);
}


function generarClave() {
    // Hacer la consulta AJAX para obtener el último número registrado
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", baseURL + "/funciones_base/generar_clave.php", true); // La ruta donde tienes el PHP que obtiene el último número
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Obtener el último número desde la respuesta
            var ultimoNumero = parseInt(xhr.responseText);
            // Incrementar el número para la nueva clave
            var nuevaClave = ultimoNumero + 1;
            // Colocar la nueva clave en el campo de texto
            document.getElementById("claveProducto1").value = nuevaClave;
        } else {
            alert("Hubo un error al generar la clave.");
        }
    };
    xhr.send();
}









