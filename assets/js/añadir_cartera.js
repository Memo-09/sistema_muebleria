document.addEventListener("DOMContentLoaded", function () {
    // Cuando se haga clic en el botón de filtrar
    document.getElementById("filtar").addEventListener("click", function () {
        // Obtener los valores seleccionados de los combos
        var diaSeleccionado = document.getElementById("ComboDia2").value;
        var colaboradorSeleccionado = document.getElementById("ComboColaborador2").value;

        // Verificar que ambos valores sean válidos antes de hacer la solicitud
        if (diaSeleccionado !== "seleccion" && colaboradorSeleccionado !== "seleccion") {
            // Llamar a la función para obtener las ventas
            obtenerVentasDia(colaboradorSeleccionado, diaSeleccionado);
        } else {
            alert("Por favor, seleccione un día y un colaborador.");
        }
    });

    // Función para obtener las ventas de un colaborador en un día específico
    function obtenerVentasDia(idColaborador, idDia) {
        var baseURL = window.location.pathname.split("/").slice(0, -1).join("/"); // Obtener la ruta base
        fetch(baseURL + "/funciones_base/obtener_ventas.php", { // Asegúrate de que la ruta sea correcta
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `idColaborador=${idColaborador}&idDia=${idDia}`,  // Enviar los parámetros
        })
            .then(response => response.json())  // Esperar una respuesta en formato JSON
            .then(data => {
                if (data && Array.isArray(data) && data.length > 0) {
                    // Si hay datos, agregar las filas a la tabla
                    agregarFilasATabla(data);
                } else {
                    alert("No se encontraron ventas para este colaborador y día.");
                    // Limpiar la tabla si no hay resultados
                    var tbody = document.querySelector(".cartera tbody");
                    tbody.innerHTML = '';
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            });
    }

    // Función para agregar las filas a la tabla
    function agregarFilasATabla(datos) {
        var tbody = document.querySelector(".carteraAgregarS tbody");
        tbody.innerHTML = '';  // Limpiar la tabla antes de agregar nuevas filas

        datos.forEach(function (fila) {
            var row = document.createElement('tr');

            // Formatear el valor de 'RESTANTE' a dos decimales
            var restante = parseFloat(fila.RESTANTE).toFixed(2);

            // Crear las celdas para cada registro
            row.innerHTML = `
                <td>${fila.ID_VENTA}</td>
                <td>${fila.NOMBRE} ${fila.AP_P} ${fila.AP_M}</td>
                <td><input type="number" class="anticipo-input form-control" style="height: 40px;" placeholder="Restante" value="${restante}" disabled/></td>  <!-- Aquí se muestra el valor con dos decimales -->
                <td><input type="number" class="anticipo-input form-control" style="height: 40px;" data-idventa="${fila.ID_VENTA}" placeholder="Anticipo" /></td>
                <td><button class="btn btn-success btn-add-anticipo" data-idventa="${fila.ID_VENTA}" style="font-weight: bold; text-transform: uppercase; font-size: 0.8rem;">Añadir</button></td>
            `;

            // Añadir la fila a la tabla
            tbody.appendChild(row);

            // Event listener para el botón de "Añadir Anticipo"
            row.querySelector(".btn-add-anticipo").addEventListener("click", function (event) {
                event.preventDefault();  // Prevenir que se recargue la página

                var idVenta = this.getAttribute("data-idventa");
                var anticipo = parseFloat(row.querySelector("input[placeholder='Anticipo']").value);
                var restanteActual = parseFloat(row.querySelector("input[placeholder='Restante']").value);

                // Llamar a la función para manejar la resta y actualización del restante
                manejarAnticipo(anticipo, restanteActual, row, idVenta);
            });
        });
    }

    // Función adicional para manejar el cálculo y actualización del restante
    function manejarAnticipo(anticipo, restanteActual, row, idVenta) {
        // Verificar si el anticipo no está vacío y es un número válido
        if (isNaN(anticipo) || anticipo <= 0) {
            alert("Por favor, ingresa un anticipo válido.");
            return;
        }

        // Verificar que el anticipo no sea mayor que el restante
        if (anticipo > restanteActual) {
            alert("El anticipo no puede ser mayor al restante.");
            return;
        }

        // Resta el anticipo del restante
        var nuevoRestante = (restanteActual - anticipo).toFixed(2);

        // Actualizar el campo restante con el nuevo valor
        row.querySelector("input[placeholder='Restante']").value = nuevoRestante;

        // Limpiar el campo de anticipo
        row.querySelector("input[placeholder='Anticipo']").value = '';

        // Aquí puedes llamar a una función para guardar el anticipo, por ejemplo, `guardarAnticipo`
        guardarAnticipo(idVenta, anticipo, nuevoRestante);  // Pasar también el nuevo restante
    }
});


