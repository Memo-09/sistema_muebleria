document.getElementById('nombreProductoBuscador').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase(); // Convertir el texto a minúsculas
    let filas = document.querySelectorAll('#tabla2 tbody tr'); // Seleccionar todas las filas de la tabla
    let hayResultados = false; // Variable para verificar si hay coincidencias

    // Iterar sobre las filas para comprobar las coincidencias
    filas.forEach(fila => {
        let claveProducto = fila.children[0].textContent.toLowerCase(); // Clave del Producto
        let nombreProducto = fila.children[1].textContent.toLowerCase(); // Nombre del Producto

        if (claveProducto.includes(filtro) || nombreProducto.includes(filtro)) {
            fila.style.display = ''; // Mostrar la fila si hay coincidencia
            hayResultados = true;
        } else {
            fila.style.display = 'none'; // Ocultar la fila si no hay coincidencia
        }
    });

    // Si no hay coincidencias, mostrar un alert
    if (!hayResultados && filtro !== "") {
        alert("No se encontró ningún producto");
    }
});





