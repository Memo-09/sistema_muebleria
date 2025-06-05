// Función para mostrar el valor seleccionado del combo
var combo = document.getElementById("ComboColaborador");  // Obtener el combobox por ID
var combobox2 = document.getElementById("ComboDia");


function mostrarSeleccion() {
    var valorSeleccionado = combo.value;  // Obtener el valor seleccionado

    // Verificamos si el valor seleccionado no es el valor "seleccion"
    if (valorSeleccionado !== "seleccion") {
        console.log("Colaborador seleccionado: " + valorSeleccionado);
        combobox2.disabled = false;
        combobox2.value = "seleccion";

        // Llamar a la función AJAX para obtener los datos del colaborador
        obtenerDatosColaborador(valorSeleccionado);
        combo.setAttribute('data-id', valorSeleccionado);

        var tablaDia = document.querySelector(".dia tbody");
        if (tablaDia) {
            tablaDia.innerHTML = '';  // Limpiar todas las filas
        }
    }
}

// Función AJAX para obtener los datos del colaborador
function obtenerDatosColaborador(idColaborador) {
    // Usar fetch para hacer la solicitud AJAX al servidor
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    fetch(baseURL + "/funciones_base/obtener_clientes.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'idColaborador=' + idColaborador,  // Enviar el ID del colaborador
    })
    .then(response => response.json())  // La respuesta será en formato JSON
    .then(data => {
        // Verificar si los datos contienen clientes
        if (data.length === 0) {
            alert("El colaborador no cuenta con clientes registrados.");
            var tbody3 = document.querySelector(".cartera tbody");
            tbody3.innerHTML = '';
            combobox2.disabled = true;
        } else {
            // Si los datos se reciben correctamente, agregarlos a la tabla
            console.log("Datos del colaborador:", data);
            agregarFilasATabla(data);
        }
    })
    .catch(error => {
        console.error("Error al obtener los datos del colaborador:", error);
    });
}


// Función para agregar los datos a la tabla
function agregarFilasATabla(datos) {
    // Obtener la referencia al cuerpo de la tabla (tbody)
    var tbody = document.querySelector(".cartera tbody");

    // Limpiar las filas existentes antes de agregar nuevas
    tbody.innerHTML = '';

    // Recorrer los datos y crear una fila para cada uno
    datos.forEach(function (fila, index) {
        var row = document.createElement('tr');
        row.style.backgroundColor = '#FFA07A'; // Color blanco para filas impares
        // Crear las celdas con los datos
        row.innerHTML = `
            <td>
                <label class="checkboxs">
                    <input type="checkbox" class="checkbox-item">
                    <span class="checkmarks"></span>
                </label>
            </td>
            <td>${fila.ID_CLIENTE}</td>
            <td>${fila.ClienteNombre} ${fila.ClienteApellidoPaterno} ${fila.ClienteApellidoMaterno}</td>
        `;

        // Añadir la fila al tbody
        tbody.appendChild(row);
    });
}






// Función para mostrar la selección del día
function mostrarSeleccionDia() {
    // Obtener el valor del día seleccionado y el valor del colaborador almacenado en el atributo 'data-id'
    const idColaborador = document.getElementById("ComboColaborador").getAttribute('data-id');
    const idDia = document.getElementById("ComboDia").value;

    // Verificar que ambos valores son válidos (no seleccionados)
    if (idColaborador !== "seleccion" && idDia !== "seleccion") {
        console.log("Colaborador seleccionado: " + idColaborador);
        console.log("Día seleccionado: " + idDia);

        // Llamar a la función AJAX para obtener los clientes según el colaborador y el día seleccionado
        obtenerClientesDia(idColaborador, idDia);
    }
}

// Función AJAX para obtener los clientes que corresponden al colaborador y al día seleccionado
function obtenerClientesDia(idColaborador, idDia) {
    // Usar fetch para hacer la solicitud AJAX al servidor
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/"); // Obtener la ruta base
    fetch(baseURL + "/funciones_base/obtener_clientes_dia.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `idColaborador=${idColaborador}&idDia=${idDia}`,  // Enviar el ID del colaborador y del día
    })
        .then(response => response.json())  // Cambié `.text()` por `.json()` porque esperamos un JSON con los datos
        .then(data => {
            console.log(data);  // Aquí puedes ver lo que está devolviendo el servidor

            // Verificar si los datos recibidos son válidos
            if (data && Array.isArray(data) && data.length > 0) {
                // Si hay datos, agregarlos a la tabla
                agregarFilasATabla2(data);
            } else {
                alert("No se encontraron clientes en su Cartera para este Dia");
                var tbody2 = document.querySelector(".dia tbody");
                tbody2.innerHTML = '';
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
}

function agregarFilasATabla2(datos) {
    // Obtener la referencia al cuerpo de la tabla (tbody)
    var tbody = document.querySelector(".dia tbody");

    // Si no hay datos (array vacío), limpiar la tabla

    tbody.innerHTML = '';

    // Recorrer los datos y crear una fila para cada uno
    datos.forEach(function (fila) {
        var row = document.createElement('tr');
        row.style.backgroundColor = '#98FB98'; // Color blanco para filas impares

        // Crear las celdas con los datos
        row.innerHTML = `
                <td>
                    <label class="checkboxs">
                        <input type="checkbox" class="checkbox-item">
                        <span class="checkmarks"></span>
                    </label>
                </td>
                <td>${fila.ID_CLIENTE}</td>
                <td>${fila.NOMBRE} ${fila.AP_P} ${fila.AP_M}</td>
            `;

        // Añadir la fila al tbody
        tbody.appendChild(row);
    });

}