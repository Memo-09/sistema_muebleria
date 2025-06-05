function buscarClientes() {
    // Obtener el valor del cuadro de texto
    let busqueda = document.getElementById("buscarCliente").value.toLowerCase();

    // Obtener el combobox
    let comboCliente = document.getElementById("ComboCliente");

    // Si el cuadro de texto está vacío, mostrar la opción "Seleccione un cliente" y restablecer el combobox
    if (busqueda === "") {
        // Mostrar la opción por defecto
        comboCliente.selectedIndex = 0;
        
        // Hacer visibles todas las opciones
        for (let i = 1; i < comboCliente.options.length; i++) {
            comboCliente.options[i].style.display = "";
        }

        return; // Salir de la función para evitar filtrado innecesario
    }

    // Iterar sobre todas las opciones del combobox
    for (let i = 1; i < comboCliente.options.length; i++) { // Comienza en 1 para evitar el primer "Seleccione una opción"
        let option = comboCliente.options[i];
        let texto = option.textContent || option.innerText;

        // Si el texto de la opción contiene la búsqueda, mostrarla, de lo contrario ocultarla
        if (texto.toLowerCase().indexOf(busqueda) > -1) {
            option.style.display = "";
        } else {
            option.style.display = "none";
        }
    }
}