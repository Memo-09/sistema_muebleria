function buscarClientes() {
    // Obtener el valor del cuadro de texto
    let busqueda = document.getElementById("buscarCliente").value.toLowerCase();

    // Obtener el combobox
    let comboCliente = document.getElementById("ComboCliente");

    // Si el cuadro de texto está vacío, mostrar la opción "Seleccione un cliente" y restablecer el combobox
    if (busqueda === "") {
        // Mostrar la opción por defecto
        comboCliente.selectedIndex = 0;
        
        // Hacer visibles todas las opciones
        for (let i = 1; i < comboCliente.options.length; i++) {
            comboCliente.options[i].style.display = "";
        }

        return; // Salir de la función para evitar filtrado innecesario
    }

    // Iterar sobre todas las opciones del combobox
    for (let i = 1; i < comboCliente.options.length; i++) { // Comienza en 1 para evitar el primer "Seleccione una opción"
        let option = comboCliente.options[i];
        let texto = option.textContent || option.innerText;

        // Si el texto de la opción contiene la búsqueda, mostrarla, de lo contrario ocultarla
        if (texto.toLowerCase().indexOf(busqueda) > -1) {
            option.style.display = "";
        } else {
            option.style.display = "none";
        }
    }
}


document.addEventListener('DOMContentLoaded', function () {
    // Manejar la selección de un checkbox de la tabla de productos
    const checkboxes = document.querySelectorAll('.asignar-checkbox');
    const ventasTableBody = document.querySelector('.ventas tbody');
    const creditoInput = document.getElementById('credito1'); // Cuadro de texto para el total de créditos

    // Función para calcular el total de los créditos
    function actualizarTotalCredito() {
        let totalCredito = 0;
        const rows = ventasTableBody.querySelectorAll('tr');
        rows.forEach(function (row) {
            const credito = parseFloat(row.cells[3].textContent); // Columna del crédito
            totalCredito += isNaN(credito) ? 0 : credito;
        });
        creditoInput.value = totalCredito.toFixed(2); // Mostrar con 2 decimales
    }

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            // Obtener los datos necesarios de los atributos del checkbox
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const marca = this.getAttribute('data-marca');
            const caracteristicas = this.getAttribute('data-caracteristicas');
            const color = this.getAttribute('data-color');
            const credito = this.getAttribute('data-credito');

            // Si el checkbox está marcado, agregar la fila a la tabla de ventas
            if (this.checked) {
                const newRow = document.createElement('tr');

                // Crear celdas de la nueva fila
                newRow.innerHTML = `
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox" class="checkbox-venta" data-id="${id}">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td>${id}</td>
                    <td>${nombre} ${caracteristicas}, ${marca}, ${color}</td>
                    <td>${credito}</td>
                    <td><input type="text" name="existencias" value="1" class="form-control" style="width: 50px;"/></td>
                `;

                // Agregar la fila a la tabla de ventas
                ventasTableBody.appendChild(newRow);
            } else {
                // Si el checkbox se deselecciona, eliminar la fila correspondiente de la tabla de ventas
                const rows = ventasTableBody.querySelectorAll('tr');
                rows.forEach(function (row) {
                    const rowId = row.cells[1].textContent;
                    if (rowId === id) {
                        row.remove();
                    }
                });
            }

            // Actualizar el total de créditos después de agregar o eliminar una fila
            actualizarTotalCredito();
        });
    });

    // Funcionalidad para seleccionar/deseleccionar todos los checkboxes de la tabla de ventas
    const selectAllCheckbox = document.getElementById('select-all-ventas');
    selectAllCheckbox.addEventListener('change', function () {
        const checkboxesVenta = ventasTableBody.querySelectorAll('.checkbox-venta');
        checkboxesVenta.forEach(function (checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });

        // Actualizar el total de créditos después de seleccionar/deseleccionar todos
        actualizarTotalCredito();
    });

    // Eliminar una fila de ventas al hacer clic en el enlace "Eliminar"
    ventasTableBody.addEventListener('click', function (event) {
        if (event.target && event.target.matches('.eliminar-venta')) {
            const row = event.target.closest('tr');
            row.remove();

            // Actualizar el total de créditos después de eliminar una fila
            actualizarTotalCredito();
        }
    });
});


