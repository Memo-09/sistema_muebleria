function generarListaJuegos() {
    var url = "lista_juegos.php"; // URL del script que genera el PDF

    // Abrir el PDF en una nueva pestaña en lugar de usar AJAX
    window.open(url, '_blank');

    console.log("Generando PDF...");
}

function generarListaDetalladaJuegos() {
    var url = "lista_juegos_2.php"; // URL del script que genera el PDF

    // Abrir el PDF en una nueva pestaña en lugar de usar AJAX
    window.open(url, '_blank');

    console.log("Generando PDF...");
}