function togglePopupRendimientos() {
    const popup = document.getElementById("RendimientoSemanal");
    const sidebar = document.getElementById("sidebar");

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupRendimiento");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none"; // Ocultar la ventana emergente
            if (sidebar) sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

            // Restablecer los valores de los combobox
            const comboColaborador = document.getElementById("ComboColaborador2");
            const comboDia = document.getElementById("ComboDia2");
            
            // Restablecer a la opción por defecto
            if (comboColaborador) comboColaborador.selectedIndex = 0; // Primer valor (selección)
            if (comboDia) comboDia.selectedIndex = 0; // Primer valor (selección)

            // Vaciar la tabla
            const tabla = document.querySelector(".table.carteraAgregarS tbody");
            if (tabla) {
                // Eliminar todas las filas dentro del tbody
                tabla.innerHTML = "";
            }

            // Eliminar el listener para evitar múltiples asignaciones
            closePopup.removeEventListener("click", cerrarPopup);
        });
    }
}

function togglePopupImprimirRendimiento() {
    const popup = document.getElementById("HojadeRendimientos");
    const sidebar = document.getElementById("sidebar");

    // Mostrar la ventana emergente
    if (popup) popup.style.display = "flex";

    // Ocultar el menú lateral
    if (sidebar) sidebar.style.display = "none";

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupImprimir");
    if (closePopup) {
        closePopup.addEventListener("click", function cerrarPopup() {
            if (popup) popup.style.display = "none"; // Ocultar la ventana emergente
            if (sidebar) sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral
            // Eliminar el listener para evitar múltiples asignaciones
            closePopup.removeEventListener("click", cerrarPopup);
        });
    }
}