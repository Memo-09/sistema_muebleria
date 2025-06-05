$(document).ready(function () {
    if (typeof idVenta !== 'undefined') {
        cargarProductosVenta(idVenta);
        cargarAbonosVenta(idVenta);
    }
});

function cargarProductosVenta(idVenta) {
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    $.ajax({
        type: 'POST',
        url: baseURL + '/funciones_base/detalle_venta_productos_clientes.php',
        data: { id_venta: idVenta },
        success: function (response) {
            $('.productosVenta tbody').html(response);
        },
        error: function () {
            console.log('Error al cargar los productos de la venta.');
        }
    });
}


function cargarAbonosVenta(idVenta) {
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    $.ajax({
        url: baseURL +'/funciones_base/cargar_abonos.php',
        method: 'POST',
        data: { idVenta: idVenta },
        dataType: 'json',
        success: function (data) {
            let tbody = '';
            let totalAbonado = 0;

            data.forEach(row => {
                const fecha = row.fecha;
                const abono = parseFloat(row.abono);
                totalAbonado += abono;
                const restante = total - totalAbonado;

                tbody += `
                    <tr>
                        <td>${fecha}</td>
                        <td>$${abono.toFixed(2)}</td>
                        <td>$${restante.toFixed(2)}</td>
                    </tr>
                `;
            });

            $('.detalleAbonos tbody').html(tbody);
        }
    });
}
