function togglePopupCompra() {
    const popup = document.getElementById("popupCompra");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupCompra");

    // Mostrar la ventana emergente
    popup.style.display = "flex";
    sidebar.style.display = "none";

    // Función para cerrar y limpiar
    function cerrarPopupCompra() {
        popup.style.display = "none";
        sidebar.style.display = "block";

        // Limpiar los inputs manualmente
        document.getElementById("preciobase").value = "";
        document.getElementById("cantidad").value = "";
        document.getElementById("total").value = "";
        document.getElementById("credito").value = "";
        document.getElementById("buscadorProducto").value = "";

        // Restablecer los selects a su primera opción
        document.getElementById("ComboMarca").selectedIndex = 0;
        document.getElementById("ComboProductos").selectedIndex = 0;
    }

    // Asegurar que el evento no se duplique
    closePopup.removeEventListener("click", cerrarPopupCompra);
    closePopup.addEventListener("click", cerrarPopupCompra);
}


function filtrarProductos() {
    // Obtener el valor del buscador
    var input = document.getElementById("buscadorProducto");
    var filter = input.value.toUpperCase(); // Convertir a mayúsculas para que la búsqueda no sea sensible a mayúsculas/minúsculas
    var select = document.getElementById("ComboProductos");
    var options = select.getElementsByTagName("option");

    // Recorrer todas las opciones y ocultar las que no coincidan con la búsqueda
    for (var i = 1; i < options.length; i++) { // Empezamos en 1 para omitir la opción "Seleccione una opción"
        var option = options[i];
        if (option.text.toUpperCase().indexOf(filter) > -1) {
            option.style.display = ""; // Mostrar opción
        } else {
            option.style.display = "none"; // Ocultar opción
        }
    }
}


// Esperar a que el DOM cargue completamente
document.addEventListener("DOMContentLoaded", function () {
    // Seleccionar los inputs
    const precioBaseInput = document.getElementById("preciobase");
    const cantidadInput = document.getElementById("cantidad");
    const totalInput = document.getElementById("total");
    const creditoInput = document.getElementById("credito");

    // Evento cuando cambia el valor en los inputs
    precioBaseInput.addEventListener("input", actualizarCalculo);
    cantidadInput.addEventListener("input", actualizarCalculo);

    function actualizarCalculo() {
        // Obtener los valores ingresados
        let precioBase = parseFloat(precioBaseInput.value) || 0;
        let cantidad = parseFloat(cantidadInput.value) || 0;

        // Calcular total y crédito
        let precioTotal = precioBase * cantidad; 
        let credito = precioBase * 2.5; 

        // Asignar valores a los inputs (si están vacíos, mostrar 0.00)
        totalInput.value = precioTotal.toFixed(2);
        creditoInput.value = credito.toFixed(2);
    }

    // Inicializar los valores en 0 al cargar la página
    actualizarCalculo();
});


function guardarCompra(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    // Obtener valores de los selects y inputs
    let idProveedor = document.getElementById("ComboProveedor").value;
    let idProducto = document.getElementById("ComboProductos").value;
    let precioBase = document.getElementById("preciobase").value.trim();
    let cantidad = document.getElementById("cantidad").value.trim();
    let precioTotal = document.getElementById("total").value.trim();
    let precioCredito = document.getElementById("credito").value.trim();

    // Validar que los selects no estén en la opción predeterminada
    if (idProveedor === "seleccion" || idProducto === "seleccion") {
        alert("Por favor, seleccione un proveedor y un producto.");
        return;
    }

    // Validar que los campos numéricos no estén vacíos
    if (precioBase === "" || cantidad === "" || precioTotal === "" || precioCredito === "") {
        alert("Por favor, complete todos los campos numéricos.");
        return;
    }

    // Convertir valores a números
    precioBase = parseFloat(precioBase);
    cantidad = parseInt(cantidad);
    precioTotal = parseFloat(precioTotal);
    precioCredito = parseFloat(precioCredito);

    // Validar que los valores numéricos sean correctos
    if (isNaN(precioBase) || isNaN(cantidad) || isNaN(precioTotal) || isNaN(precioCredito)) {
        alert("Asegúrese de ingresar valores numéricos válidos.");
        return;
    }

    // Crear objeto con los datos
    let datos = new FormData();
    datos.append("idProveedor", idProveedor);
    datos.append("idProducto", idProducto);
    datos.append("precioBase", precioBase);
    datos.append("cantidad", cantidad);
    datos.append("precioTotal", precioTotal);
    datos.append("precioCredito", precioCredito);

    // Enviar datos a PHP mediante AJAX
    fetch("insertar_compra.php", {
        method: "POST",
        body: datos
    })
    .then(response => response.json()) // Convertir respuesta a JSON
    .then(data => {
        if (data.success) {
            alert("Compra registrada correctamente.");
            location.reload(); // Recargar la página tras el éxito
        } else {
            alert("Error al registrar la compra: " + data.error);
        }
    })
    .catch(error => {
        console.error("Error en la petición AJAX: ", error);
        alert("Hubo un problema al enviar los datos.");
    });
}




