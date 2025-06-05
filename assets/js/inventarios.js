function inventyario(){
    var url = "inventario_sucursal.php"; // URL del script que genera el PDF

    // Abrir el PDF en una nueva pestaña en lugar de usar AJAX
    window.open(url, '_blank');

    console.log("Generando PDF...");
}


function inventyario2(){
    var url = "inventario_bodegas.php"; // URL del script que genera el PDF

    // Abrir el PDF en una nueva pestaña en lugar de usar AJAX
    window.open(url, '_blank');

    console.log("Generando PDF...");
}