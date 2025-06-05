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
        <td><input type="number" class="form-control form-control-sm cantidad-producto w-10" data-id="${id}" min="1" value="1" /></td>
        <td class="credito">${parseFloat(credito).toFixed(2)}</td> <!-- No se actualizará aquí -->
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

    // Agregar el evento para actualizar el total cuando cambie la cantidad
    const cantidadInput = newRow.querySelector(".cantidad-producto");
    cantidadInput.addEventListener("input", function () {
        actualizarTotalCredito(); // Actualiza el total al cambiar la cantidad
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

    actualizarTotalCredito(); // Recalcular total al eliminar una fila
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

    let totalCredito = 0;

    // Recorrer las filas de la tabla y sumar los créditos multiplicados por la cantidad
    juegoTableBody.querySelectorAll("tr").forEach((row) => {
        const precioCredito = parseFloat(row.cells[3].textContent) || 0; // Obtener el crédito (columna 4) - este no se modificará
        const cantidadProducto = parseInt(row.querySelector(".cantidad-producto").value) || 1; // Obtener la cantidad del input

        // Multiplicamos el crédito por la cantidad para obtener el total por producto
        const totalPorProducto = precioCredito * cantidadProducto;

        // Sumar al total acumulado
        totalCredito += totalPorProducto;
    });

    // Asignar el valor total al input de crédito
    creditoInput.value = totalCredito.toFixed(2); // Crédito total acumulado
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


function guardarJuego(event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    // Obtener valores del formulario
    var nombre = document.querySelector('#juegoNombre').value.trim();
    var caracteristicas = document.querySelector('#juego').value.trim();
    var clave = document.querySelector('#claveProducto1').value.trim();
    var precioCredito = parseFloat(document.querySelector('#creditoClasificacion').value.trim()) || 0;  // Cambié 'credito' a 'precioCredito'
    var precioCrediContado = parseFloat(document.querySelector('#crediContadoClasificacion').value.trim()) || 0;
    var precioContado = parseFloat(document.querySelector('#contadoClasificacion').value.trim()) || 0;
    var enganche = parseFloat(document.querySelector('#engancheClasificacion').value.trim()) || 0;
    var comision = parseFloat(document.querySelector('#comisionClasificacion').value.trim()) || 0

    // Validar que los campos obligatorios no estén vacíos
    if (!nombre || !caracteristicas || !clave) {
        alert("⚠️ Por favor, complete los siguientes campos obligatorios:\n\n- Nombre del juego\n- Características\n- Clave del producto");
        return;
    }

    // Obtener los IDs de los productos de la tabla
    var filas = document.querySelectorAll('.table.juegos tbody tr');
    var idsProductos = [];

    filas.forEach(function(fila) {
        var idProducto = fila.cells[0].textContent.trim(); // Suponiendo que la clave del producto es el ID
        if (idProducto) {
            idsProductos.push(idProducto);
        }
    });

    // Verificar si la tabla está vacía
    if (idsProductos.length === 0) {
        alert("⚠️ Debe agregar al menos un producto a la tabla antes de guardar.");
        return;
    }

    // Crear el objeto FormData para enviar los datos del formulario
    var formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('caracteristicas', caracteristicas);
    formData.append('clave', clave);
    formData.append('precioCredito', precioCredito);  // Cambié 'credito' a 'precioCredito'
    formData.append('precioCrediContado', precioCrediContado);  // Cambié 'credicontado' a 'precioCrediContado'
    formData.append('precioContado', precioContado);  // Cambié 'contado' a 'precioContado'
    formData.append('enganche', enganche);
    formData.append('comision', comision);
    formData.append('idsProductos', JSON.stringify(idsProductos));

    // Obtener la URL base correctamente
    var baseURL = window.location.origin + window.location.pathname.split("/").slice(0, -1).join("/");

    // Enviar datos al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_juegos.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                window.location.href = "juegos.php";
            } catch (e) {
                console.log("Error en la respuesta del servidor: " + xhr.responseText);
            }
        } else {
            alert("❌ Hubo un error al insertar el juego.");
        }
    };
    xhr.send(formData);
}