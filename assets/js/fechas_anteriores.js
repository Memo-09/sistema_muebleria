document.getElementById('fecha').addEventListener('change', function() {
    let fechaSeleccionada = new Date(this.value + 'T00:00:00'); // Forzar a medianoche para evitar desajustes

    if (!isNaN(fechaSeleccionada.getTime())) {
        document.getElementById('fechaactual').value = formatearFecha(fechaSeleccionada);

        let fechaContado = new Date(fechaSeleccionada);
        fechaContado.setMonth(fechaContado.getMonth() + 1);
        document.getElementById('fecha3').value = formatearFecha(fechaContado);

        let fechaCrediContado = new Date(fechaSeleccionada);
        fechaCrediContado.setMonth(fechaCrediContado.getMonth() + 2);
        document.getElementById('fecha2').value = formatearFecha(fechaCrediContado);

        let fechaCredito = new Date(fechaSeleccionada);
        fechaCredito.setDate(fechaCredito.getDate() + (50 * 7)); // 50 semanas = 50 * 7 días
        document.getElementById('fecha1').value = formatearFecha(fechaCredito);
    }
});

function formatearFecha(fecha) {
    let año = fecha.getFullYear();
    let mes = ('0' + (fecha.getMonth() + 1)).slice(-2);
    let dia = ('0' + fecha.getDate()).slice(-2);
    return `${año}-${mes}-${dia}`;
}
