document.addEventListener("DOMContentLoaded", function () {
    // Obtener la referencia a la primera tabla y al tbody de la segunda tabla
    const tabla1 = document.getElementById("tabla1");
    const tabla2 = document.getElementById("tabla2").querySelector("tbody");

    // Escuchar eventos de cambio en los checkboxes de la primera tabla
    tabla1.addEventListener("change", function (event) {
        const checkbox = event.target;

        // Verificar si el evento se disparó desde un checkbox
        if (checkbox.classList.contains("asignar-checkbox")) {
            const fila = checkbox.closest("tr"); // Obtener la fila padre del checkbox
            const clave = fila.children[1].textContent.trim();
            const nombre = fila.children[2].textContent.trim();
            const credito = fila.children[3].textContent.trim();

            if (checkbox.checked) {
                // Crear una nueva fila para la segunda tabla
                const nuevaFila = document.createElement("tr");
                nuevaFila.innerHTML = `
                    <td>${clave}</td>
                    <td>${nombre}</td>
                    <td>${credito}</td>
                    <td><input type="text" name="existencias" value="1" class="form-control" style="width: 50px;"/></td>
                `;
                nuevaFila.setAttribute("data-clave", clave); // Añadir atributo para referencia
                tabla2.appendChild(nuevaFila); // Agregar la fila a la segunda tabla
            } else {
                // Buscar y eliminar la fila correspondiente en la segunda tabla
                const filaEliminar = tabla2.querySelector(`[data-clave="${clave}"]`);
                if (filaEliminar) {
                    tabla2.removeChild(filaEliminar);
                }
            }
        }
    });
});







