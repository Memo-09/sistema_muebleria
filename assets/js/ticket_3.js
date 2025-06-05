function generarTicketVenta(idVenta, nombre, apellido1, apellido2, total, abonado, restante) {
    var url = "generar_ticket.php?id_venta=" + idVenta +
              "&nombre=" + encodeURIComponent(nombre) +
              "&apellido1=" + encodeURIComponent(apellido1) +
              "&apellido2=" + encodeURIComponent(apellido2) +
              "&total=" + encodeURIComponent(total) +
              "&abonado=" + encodeURIComponent(abonado) +
              "&restante=" + encodeURIComponent(restante);

    // Abrir la URL en una nueva pestaña para descargar o mostrar el archivo
    window.open(url, "_blank");
}


function generarEstadodeCuenta(idVenta, nombre, apellido1, apellido2) {
    var url = "generar_estado_cuenta.php?id_venta=" + idVenta +
              "&nombre=" + encodeURIComponent(nombre) +
              "&apellido1=" + encodeURIComponent(apellido1) +
              "&apellido2=" + encodeURIComponent(apellido2);

    // Abrir la URL en una nueva pestaña para descargar o mostrar el archivo
    window.open(url, "_blank");
}