function redirectToGestionVenta() {
    // Obtener los valores de los campos de entrada
    var id = document.getElementById('claveVenta').value;

    // Redirigir a la página de destino con los datos como parámetros en la URL
    window.location.href = `modificar_venta.php?id=${encodeURIComponent(id)}`;
}