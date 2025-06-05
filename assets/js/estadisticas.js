function togglePopupImprimirEstadisticas() {
    const popup = document.getElementById("HojadeEstadisticas");
    const sidebar = document.getElementById("sidebar");

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupEstadisticas");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none"; // Ocultar la ventana emergente
            if (sidebar) sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral
            // Eliminar el listener para evitar múltiples asignaciones
            closePopup.removeEventListener("click", cerrarPopup);
        });
    }
}



document.addEventListener("DOMContentLoaded", function() {
    // Verificamos si el botón existe antes de agregar el listener
    const imprimirButton = document.getElementById("Imprimir2");

    if (imprimirButton) {
        imprimirButton.addEventListener("click", function() {
            // Obtener los valores seleccionados de los combo boxes
            const colaborador = document.getElementById("ComboColaborador4").value;
            const colaboradorTexto = document.getElementById("ComboColaborador4").options[document.getElementById("ComboColaborador4").selectedIndex].text;

            // Verificar si ambos valores son diferentes a "seleccion"
            if (colaborador !== "seleccion") {
                // Crear la URL con los parámetros y abrirla en una nueva ventana
                const url = `generar_estadisticas.php?colaborador_value=${encodeURIComponent(colaborador)}&colaborador_texto=${encodeURIComponent(colaboradorTexto)}`;
                window.open(url, '_blank');
            } else {
                alert("Por favor, seleccione un colaborador");
            }
        });
    } else {
        console.error("El botón de imprimir no se encuentra en el DOM.");
    }
});