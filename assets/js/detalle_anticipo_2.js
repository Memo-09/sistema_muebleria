async function togglePopupDetalleVenta(claveVenta, nombre, apellido1, apellido2, total, fecha1, fecha2, fecha3, abonado, restante) {
    const popup = document.getElementById("popupDetalleVenta");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Colocar los valores en el formulario
    document.getElementById("claveVenta").value = claveVenta;
    document.getElementById("nombreCliente").value = `${nombre} ${apellido1} ${apellido2}`;
    document.getElementById("total").value = total;
    document.getElementById("fecha1").value = fecha1;
    document.getElementById("fecha2").value = fecha2;
    document.getElementById("fecha3").value = fecha3;
    document.getElementById("abonado").value = abonado;
    document.getElementById("restante").value = restante;

    const formData = new FormData();
    formData.append("claveVenta", claveVenta);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    try {
        const response = await fetch(baseURL + "/funciones_base/productos_venta.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud al servidor: ${response.statusText}`);
        }

        const data = await response.json(); // Esperamos una respuesta en JSON
        console.log(data); // Aquí puedes manejar lo que te devuelve el servidor

        // Llenar la tabla con los productos
        const tableBody = document.querySelector(".productosVenta tbody");
        tableBody.innerHTML = ""; // Limpiar la tabla antes de llenarla

        // Si hay productos, insertarlos en la tabla
        if (data.length > 0) {
            data.forEach(producto => {
                const row = document.createElement("tr");

                // Crear las celdas
                row.innerHTML = `
                    <td>${producto.CLAVE_PRODUCTO}</td>
                    <td>${producto.NOMBRE_PRODUCTO} ${producto.CARACTERISTICAS_PRODUCTO} MARCA: ${producto.DESCRIPCION_MARCA}</td>
                    <td>${producto.NUMERO_PRODUCTOS}</td>
                `;

                // Agregar la fila a la tabla
                tableBody.appendChild(row);
            });
        } else {
            // Si no hay productos
            const noProductsRow = document.createElement("tr");
            noProductsRow.innerHTML = '<td colspan="4">No se encontraron productos para esta venta.</td>';
            tableBody.appendChild(noProductsRow);
        }
    } catch (error) {
        console.error("Error en la comunicación con el servidor: " + error.message);
    }

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupDetalleVenta");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none"; // Ocultar la ventana emergente
            if (sidebar) sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

            // Desmarcar el checkbox seleccionado al cancelar
            if (checkbox) {
                checkbox.checked = false;
            }

            // Limpiar el valor de 'abono' y establecer la fecha de hoy en el input de fecha
            document.getElementById("abono1").value = ""; // Deja en blanco el input de abono

            // Establecer la fecha de hoy en el input de fecha
            document.getElementById("fecha").value = new Date().toISOString().split("T")[0]; // Establecer la fecha actual

            // Eliminar el listener para evitar múltiples asignaciones
            closePopup.removeEventListener("click", cerrarPopup);
        });
    }


}



function imprimirValores() {
    // Obtener los valores de los inputs
    const venta = document.getElementById('claveVenta').value.trim();
    const abonobase = parseFloat(document.getElementById('abonado').value) || 0;
    const restantebase = parseFloat(document.getElementById('restante').value) || 0;
    const abono = parseFloat(document.getElementById('abono1').value) || 0;
    const fecha = document.getElementById('fecha').value;

    // Validar si el campo de abono está vacío
    if (!abono || abono <= 0) {
        alert("El campo de abono no puede estar vacío o ser menor a 0.");
        return; // Detener la ejecución de la función si abono está vacío
    }

    // Calcular la suma de abonado y la resta de lo restante
    let sumaabonado = abonobase + abono;
    let restaRestante = restantebase - abono;

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Crear un objeto FormData para enviar los datos
    const formData = new FormData();
    formData.append('venta', venta);
    formData.append('abonobase', abonobase);
    formData.append('restantebase', restantebase);
    formData.append('abono', abono);
    formData.append('fecha', fecha);
    formData.append('restaRestante', restaRestante);
    formData.append('sumaabonado', sumaabonado);

    // Configurar la solicitud AJAX
    fetch(baseURL + "/funciones_base/agregar_anticipo.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())  // Recibir como texto en lugar de JSON
    .then(text => {
        console.log("Respuesta del servidor (RAW):", text); // Imprime la respuesta completa del servidor

        try {
            const data = JSON.parse(text); // Intentar convertir la respuesta en JSON

            console.log("Respuesta JSON:", data); // Imprime el JSON en consola

            if (data.success) {
                alert(data.message);
                setTimeout(() => location.reload(), 1000);
            } else {
                alert("Error: " + data.error);
            }
        } catch (error) {
            console.error("Error al parsear JSON:", error);
            alert("El servidor respondió con un formato inesperado.");
        }
    })
    .catch(error => {
        console.error("Error en la solicitud AJAX:", error);
        alert("Hubo un error en la conexión con el servidor.");
    });
}








function actualizarValoresAbonos(totalAbonos, total, fecha, claveVenta) {
    // Convertir valores a formato decimal con 2 decimales
    totalAbonos = parseFloat(totalAbonos).toFixed(2);
    const restante = (parseFloat(total) - parseFloat(totalAbonos)).toFixed(2);

    // Asignar valores a los inputs correspondientes
    document.getElementById("abonado2").value = totalAbonos;
    document.getElementById("restante2").value = restante;

    // Verificar que los valores sean válidos antes de enviarlos
    if (!fecha || !claveVenta) {
        console.error("Error: Fecha o clave de venta no válidos.");
        alert("Falta la fecha o la clave de venta.");
        return;
    }

    console.log("Fecha:", fecha);
    console.log("Clave Venta:", claveVenta);
    console.log("Total Abonado:", totalAbonos);
    console.log("Restante:", restante);

    // Crear un objeto FormData para enviar los datos
    var formData = new FormData();
    formData.append('fecha', fecha);
    formData.append('claveVenta', claveVenta);
    formData.append('totalAbonado', totalAbonos);
    formData.append('restante', restante);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX con Fetch API
    fetch(baseURL + "/funciones_base/actualizar_anticipos.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())  // Convertir la respuesta a JSON
    .then(data => {
        if (data.success) {
            alert(data.message || "Anticipo actualizado correctamente.");
            location.reload(); // Recargar la página si es exitoso
        } else {
            alert(data.error || "Hubo un problema al actualizar el anticipo.");
        }
    })
    .catch(error => {
        console.error("Error en la solicitud al servidor:", error);
        alert("Hubo un error en la conexión con el servidor.");
    });
}





// Función para actualizar los valores de totalAbonos y restante2
function actualizarValoresAbonos1(totalAbonos, total) {
    // Asignar el total de abonos al input 'abonado2'
    document.getElementById("abonado2").value = totalAbonos.toFixed(2);

    // Calcular el restante y asignarlo al input 'restante2'
    const restante = total - totalAbonos;
    document.getElementById("restante2").value = restante.toFixed(2);
}



async function togglePopupHistoriaAbonos(claveVenta, nombre, apellido1, apellido2, total) {
    const popup = document.getElementById("HistorialAbonos");
    const sidebar = document.getElementById("sidebar");

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Colocar los valores en el formulario
    document.getElementById("claveVenta2").value = claveVenta;
    document.getElementById("nombreCliente2").value = `${nombre} ${apellido1} ${apellido2}`;
    document.getElementById("total2").value = total;

    const formData = new FormData();
    formData.append("claveVenta", claveVenta);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    try {
        const response = await fetch(baseURL + "/funciones_base/historial_abonos.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud al servidor: ${response.statusText}`);
        }

        const data = await response.json(); // Esperamos una respuesta en JSON
        console.log(data); // Aquí puedes manejar lo que te devuelve el servidor

        // Llenar la tabla con los productos
        const tableBody = document.querySelector(".detalleAbonos tbody");
        tableBody.innerHTML = ""; // Limpiar la tabla antes de llenarla

        // Inicializar una variable para la suma de los abonos
        let totalAbonos = 0;

        // Si hay productos, insertarlos en la tabla
        if (data.length > 0) {
            let total1 = total; // Iniciar total1 con el valor original del total
        
            data.forEach(producto => {
                const row = document.createElement("tr");
        
                // Calcular el total restante después de cada abono
                total1 = total1 - producto.ABONO_DINERO;
        
                // Crear las celdas con el valor actualizado de total1
                row.innerHTML = `
                    <td>${producto.FECHA_BONO}</td>
                    <td>${producto.ABONO_DINERO}</td>
                    <td>${total1}</td>  <!-- Muestra el total restante después del abono -->
                    <td><a href="#" class="btn btn-success btn-sm fw-bold eliminar-venta">ELIMINAR</a></td>
                `;
        
                // Agregar la fila a la tabla
                tableBody.appendChild(row);
        
                // Sumar los abonos
                totalAbonos += parseFloat(producto.ABONO_DINERO) || 0;
        
                // Agregar el eventListener para eliminar la fila
                row.querySelector(".eliminar-venta").addEventListener("click", function() {
                    // Eliminar la fila de la tabla
                    row.remove();
        
                    // Recalcular el total de abonos
                    totalAbonos -= parseFloat(producto.ABONO_DINERO) || 0;
                    fecha = producto.FECHA_BONO;

        
                    // Actualizar el valor de totalAbonos y restante
                    actualizarValoresAbonos(totalAbonos, total, fecha, claveVenta);
        
                    alert("Abono eliminado.");
        
                    // Aquí puedes agregar el código para eliminar el abono de la base de datos si es necesario
                });
            });
        } else {
            // Si no hay productos
            const noProductsRow = document.createElement("tr");
            noProductsRow.innerHTML = '<td colspan="4">No se encontraron productos para esta venta.</td>';
            tableBody.appendChild(noProductsRow);
        }
        

        // Mostrar el total de los abonos en el input correspondiente
        actualizarValoresAbonos1(totalAbonos, total); // Actualizar los valores al principio

    } catch (error) {
        console.error("Error en la comunicación con el servidor: " + error.message);
    }

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupHistorialAbonos");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none"; // Ocultar la ventana emergente
            if (sidebar) sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

            // Limpiar el valor de 'abono' y establecer la fecha de hoy en el input de fecha
            document.getElementById("abono1").value = ""; // Deja en blanco el input de abono

            // Establecer la fecha de hoy en el input de fecha
            document.getElementById("fecha").value = new Date().toISOString().split("T")[0]; // Establecer la fecha actual

            // Eliminar el listener para evitar múltiples asignaciones
            closePopup.removeEventListener("click", cerrarPopup);
        });
    }
}


