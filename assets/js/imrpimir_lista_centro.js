function imprimirListaProductos(idSucursal, ubicacion) {
    // Crear una nueva ventana o redirigir al PHP con los parámetros de ID de la sucursal y ubicación
    window.open('lista_productos_sucursal.php?idSucursal=' + idSucursal + '&ubicacion=' + encodeURIComponent(ubicacion), '_blank');
}



function imprimirListaProductos2(idBodega, ubicacion) {
    // Crear una nueva ventana o redirigir al PHP con el ID de la sucursal como parámetro
    window.open('lista_productos_bodega.php?idSucursal=' + idBodega + '&ubicacion=' + encodeURIComponent(ubicacion), '_blank');
}