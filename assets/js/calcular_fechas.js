function calcularFecha50Semanas() {
    const fechaActual = new Date(); // Fecha actual
    const semanas = 50; // Cantidad de semanas
    const dias = semanas * 7; // Convertir semanas a días

    // Sumar los días a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setDate(fechaActual.getDate() + dias);

    return fechaFutura; // Devuelve la nueva fecha
}

// Obtener el campo input
const inputFecha = document.getElementById("fecha1");

// Calcular la fecha y asignarla al input
const fechaResultado = calcularFecha50Semanas();
inputFecha.value = fechaResultado.toLocaleDateString(); // Mostrar la fecha en formato local

function calcularFechaDosMeses() {
    const fechaActual = new Date(); // Fecha actual

    // Sumar 2 meses a la fecha actual
    const fechaFutura = new Date(fechaActual);
    fechaFutura.setMonth(fechaActual.getMonth() + 2);

    return fechaFutura; // Devuelve la nueva fecha
}

// Obtener el campo input
const inputFechaLimite = document.getElementById("fecha2");

// Calcular la fecha y asignarla al input
const fechaResultado2 = calcularFechaDosMeses();
inputFechaLimite.value = fechaResultado2.toLocaleDateString(); // Mostrar la fecha en formato local




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

// Obtener el campo input
const inputFechaLimiteMes = document.getElementById("fecha3");

// Calcular la fecha y asignarla al input
const fechaResultado3 = calcularFechaUnMes();
inputFechaLimiteMes.value = fechaResultado3; // Mostrar la fecha en formato YYYY-MM-DD