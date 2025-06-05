function formatearTelefono() {
    var telefono = document.getElementById('telefono').value;
    
    // Eliminar todo lo que no sea un número
    telefono = telefono.replace(/\D/g, '');
    
    // Formatear el número de teléfono
    if (telefono.length <= 10) {
        telefono = telefono.replace(/(\d{2})(\d{4})(\d{4})/, '$1-$2-$3');
    }
    
    // Asignar el valor formateado al campo de entrada
    document.getElementById('telefono').value = telefono;
}


function formatearTelefono2() {
    var telefono = document.getElementById('telefonoMod1').value;
    
    // Eliminar todo lo que no sea un número
    telefono = telefono.replace(/\D/g, '');
    
    // Formatear el número de teléfono
    if (telefono.length <= 10) {
        telefono = telefono.replace(/(\d{2})(\d{4})(\d{4})/, '$1-$2-$3');
    }
    
    // Asignar el valor formateado al campo de entrada
    document.getElementById('telefonoMod1').value = telefono;
}
