function generarListaProductos() {
    var url = "lista_productos.php"; // URL del script que genera el PDF

    // Abrir el PDF en una nueva pestaña en lugar de usar AJAX
    window.open(url, '_blank');

    console.log("Generando PDF...");
}
