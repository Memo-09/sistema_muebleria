function calcularFechaUnMes() {
    const fechaActual = new Date(); // Fecha actual

    // Sumar 1 mes a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setMonth(fechaActual.getMonth() + 1);

    // Formatear la fecha a YYYY-MM-DD
    const año = fechaFutura.getFullYear();
    const mes = String(fechaFutura.getMonth() + 1).padStart(2, '0'); // Mes en formato 2 dígitos
    const día = String(fechaFutura.getDate()).padStart(2, '0'); // Día en formato 2 dígitos

    return `${año}-${mes}-${día}`; // Devuelve la fecha formateada
}

function calcularFecha50Semanas() {
    const fechaActual = new Date(); // Fecha actual
    const semanas = 50; // Cantidad de semanas
    const dias = semanas * 7; // Convertir semanas a días

    // Sumar los días a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setDate(fechaActual.getDate() + dias);

    return formatearFechaYYYYMMDD(fechaFutura); // Devuelve la fecha formateada
}

// Función para calcular la fecha dentro de 2 meses
function calcularFechaDosMeses() {
    const fechaActual = new Date(); // Fecha actual

    // Sumar 2 meses a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setMonth(fechaActual.getMonth() + 2);

    return formatearFechaYYYYMMDD(fechaFutura); // Devuelve la fecha formateada
}

// Función para formatear una fecha en el formato YYYY-MM-DD
function formatearFechaYYYYMMDD(fecha) {
    const año = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // Mes en 2 dígitos
    const día = String(fecha.getDate()).padStart(2, '0'); // Día en 2 dígitos
    return `${año}-${mes}-${día}`; // Formato YYYY-MM-DD
}

// Verificar si el crédito está vacío o en cero antes de asignar las fechas
const inputCredito = document.getElementById("credito1");
const inputFecha = document.getElementById("fecha1");
const inputFechaLimite = document.getElementById("fecha2");
const inputFechaLimiteMes = document.getElementById("fecha3");

if (inputCredito.value.trim() !== "" && inputCredito.value !== "0") {
    // Asignar la fecha de 50 semanas si el crédito es válido
    const fechaResultado = calcularFecha50Semanas();
    inputFecha.value = fechaResultado;

    // Asignar la fecha de 2 meses si el crédito es válido
    const fechaResultado2 = calcularFechaDosMeses();
    inputFechaLimite.value = fechaResultado2;

    // Calcular la fecha y asignarla al input
    const fechaResultado3 = calcularFechaUnMes();
    inputFechaLimiteMes.value = fechaResultado3; // Mostrar la fecha en formato YYYY-MM-DD
}