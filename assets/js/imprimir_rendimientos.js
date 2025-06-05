document.addEventListener("DOMContentLoaded", function() {
    // Verificamos si el botón existe antes de agregar el listener
    const imprimirButton = document.getElementById("Imprimir");

    if (imprimirButton) {
        imprimirButton.addEventListener("click", function() {
            // Obtener los valores seleccionados de los combo boxes
            const colaborador = document.getElementById("ComboColaborador3").value;
            const colaboradorTexto = document.getElementById("ComboColaborador3").options[document.getElementById("ComboColaborador3").selectedIndex].text;
            const dia = document.getElementById("ComboDia3").value;
            const diaTexto = document.getElementById("ComboDia3").options[document.getElementById("ComboDia3").selectedIndex].text; // Obtener el texto del día

            // Verificar si ambos valores son diferentes a "seleccion"
            if (colaborador !== "seleccion" && dia !== "seleccion") {
                // Crear la URL con los parámetros y abrirla en una nueva ventana
                const url = `generar_rendimiento.php?colaborador_value=${encodeURIComponent(colaborador)}&colaborador_texto=${encodeURIComponent(colaboradorTexto)}&dia_texto=${encodeURIComponent(diaTexto)}`;
                window.open(url, '_blank');
            } else {
                alert("Por favor, seleccione un colaborador y un día.");
            }
        });
    } else {
        console.error("El botón de imprimir no se encuentra en el DOM.");
    }
});

