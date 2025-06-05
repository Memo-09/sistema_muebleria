function generarTicketVenta(idVenta, nombre, apellido1, apellido2, total, abonado, restante) {
    var xhr = new XMLHttpRequest();

    // Construir la URL con los parámetros
    var url = "generar_ticket.php?id_venta=" + idVenta +
              "&nombre=" + encodeURIComponent(nombre) +
              "&apellido1=" + encodeURIComponent(apellido1) +
              "&apellido2=" + encodeURIComponent(apellido2) +
              "&total=" + encodeURIComponent(total) +
              "&abonado=" + encodeURIComponent(abonado) +
              "&restante=" + encodeURIComponent(restante);

    xhr.open("GET", url, true);
    
    xhr.onload = function() {
        if (xhr.status == 200) {
            if (xhr.responseText.startsWith("tickets/")) {
                var ticketURL = xhr.responseText;
                window.open(ticketURL, "_blank");
            } else {
                console.log("Error: " + xhr.responseText);
            }
        } else {
            console.log("Error al generar el ticket");
        }
    };

    xhr.send();
}





