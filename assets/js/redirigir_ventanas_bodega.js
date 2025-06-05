function redirectToGestionBodegas() {
    // Obtener los valores de los campos de entrada
    var id = document.getElementById('claveSucursal1').value;
    var name = document.getElementById('ubicacion1').value;

    // Redirigir a la página de destino con los datos como parámetros en la URL
    window.location.href = `mod_prod_bodegas.php?id=${encodeURIComponent(id)}&name=${encodeURIComponent(name)}`;
}

function redirectToSucursalBodegas() {
    // Obtener los valores de los campos de entrada
    var id = document.getElementById('claveSucursal1').value;
    var name = document.getElementById('ubicacion1').value;

    // Redirigir a la página de destino con los datos como parámetros en la URL
    window.location.href = `bodegas_productos.php?id=${encodeURIComponent(id)}&name=${encodeURIComponent(name)}`;
}