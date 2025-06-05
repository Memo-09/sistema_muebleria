function enviarDatos() {
    // Recoger los valores de los inputs
    var cliente = document.getElementById('ComboCliente').value;
    var credito = document.getElementById('credito1').value;
    var creditoContado = document.getElementById('crediContado1').value;
    var contado = document.getElementById('contado1').value;
    var fechaRegistro = document.getElementById('fechaactual').value;
    var fechaLimiteContado = document.getElementById('fecha3').value;
    var fechaLimiteCrediContado = document.getElementById('fecha2').value;
    var fechaLimiteCredito = document.getElementById('fecha1').value;
    var pagoMinimo = document.getElementById('cantidad1').value;
    var pagoMaximo = document.getElementById('cantidad2').value;
    var enganche = document.getElementById('enganche').value;

    // Validar que los campos no estén vacíos
    if (cliente === "seleccion" || cliente === "") {
        alert("Por favor, selecciona un cliente.");
        return; // Detener la ejecución si el cliente no está seleccionado
    }

    if (credito === "" || creditoContado === "" || contado === "" || 
        fechaRegistro === "" || fechaLimiteContado === "" || 
        fechaLimiteCrediContado === "" || fechaLimiteCredito === "" || 
        pagoMinimo === "" || pagoMaximo === "" || enganche === "") {
        alert("Por favor, completa todos los campos obligatorios.");
        return; // Detener la ejecución si algún campo está vacío
    }

    // Obtener los productos de la tabla ventas
    var productosVentas = [];
    var filas = document.querySelectorAll(".ventas tbody tr");

    filas.forEach((fila) => {
        var claveProducto = fila.cells[0].innerText;  // Clave Producto
        var nombreCompleto = fila.cells[1].innerText;  // Nombre Completo
        var creditoProducto = fila.cells[2].innerText; // Crédito
        var idAlmacen = fila.cells[3].innerText;       // Id del Almacen
        var cantidad = fila.cells[4].innerText;        // Cantidad

        productosVentas.push({
            claveProducto: claveProducto,
            nombreCompleto: nombreCompleto,
            creditoProducto: creditoProducto,
            idAlmacen: idAlmacen,
            cantidad: cantidad
        });
    });

    // Crear un objeto con los datos a enviar
    var datos = {
        cliente: cliente,
        credito: credito,
        creditoContado: creditoContado,
        contado: contado,
        fechaRegistro: fechaRegistro,
        fechaLimiteContado: fechaLimiteContado,
        fechaLimiteCrediContado: fechaLimiteCrediContado,
        fechaLimiteCredito: fechaLimiteCredito,
        pagoMinimo: pagoMinimo,
        pagoMaximo: pagoMaximo,
        enganche: enganche,
        productosVentas: productosVentas  // Agregar productos de la tabla ventas
    };

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Enviar los datos mediante AJAX
    $.ajax({
        url: baseURL + "/funciones_base/realizar_venta_2.php", // Cambia esta URL por el archivo PHP que recibirá los datos
        type: 'POST',
        data: { datos: JSON.stringify(datos) }, // Convertimos el objeto a JSON
        success: function(response) {
            // Aquí puedes manejar la respuesta del servidor
            console.log(response);
            alert('Datos enviados correctamente');
        },
        error: function(xhr, status, error) {
            // Manejar errores
            console.log(error);
            alert('Hubo un error al enviar los datos');
        }
    });
}


