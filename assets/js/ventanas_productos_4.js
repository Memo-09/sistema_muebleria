function togglePopup() {
    const popup = document.getElementById("popup");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopup"); // El botón de cerrar (Cancelar)
    const selectElement1 = document.getElementById("ComboMarca"); // ID del combobox de Marca
    const selectElement2 = document.getElementById("ComboColor"); // ID del combobox de Color
    const selectElement3 = document.getElementById("ComboCategoria"); // ID del combobox de Color

    // Mostrar la ventana emergente
    popup.style.display = "flex"; // Mostrar la ventana emergente

    // Ocultar el menú lateral
    sidebar.style.display = "none"; // Ocultar el menú lateral

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

        // Limpiar todos los campos de texto dentro del popup
        const inputs = popup.querySelectorAll('input[type="text"]'); // Obtener todos los cuadros de texto dentro del popup
        inputs.forEach(function (input) {
            input.value = ""; // Limpiar el contenido de cada cuadro de texto
        });

        // Restablecer el valor del combobox a "seleccion"
        if (selectElement1) {
            selectElement1.value = "seleccion"; // Restablecer el valor del combobox de Marca
        }
        if (selectElement2) {
            selectElement2.value = "seleccion"; // Restablecer el valor del combobox de Color
        }
        if (selectElement3) {
            selectElement3.value = "seleccion"; // Restablecer el valor del combobox de Marca
        }
    });
}




// Función para manejar la ventana emergente
function togglePopupMarcas() {
    const popup = document.getElementById("popupmarcas");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopupmarcas");  // El botón de cerrar (X)

    // Mostrar la ventana emergente
    popup.style.display = "flex";  // Cambiar display de 'none' a 'flex' para mostrarla

    // Ocultar el menú lateral
    sidebar.style.display = "none";  // Cambiar display a 'none' para ocultar el menú lateral

    // Cerrar la ventana emergente al hacer clic en el botón de cancelar
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";  // Ocultar la ventana emergente
        sidebar.style.display = "block";  // Mostrar nuevamente el menú lateral
    });
}

// Función para mostrar la ventana emergente de colores
function togglePopupColores() {
    const popup = document.getElementById("popupcolores");
    const closePopup = document.getElementById("closePopupColores");

    // Mostrar la ventana emergente
    popup.style.display = "flex";  // Cambiar display de 'none' a 'flex' para mostrarla

    // Ocultar el menú lateral
    sidebar.style.display = "none";  // Cambiar display a 'none' para ocultar el menú lateral

    // Cerrar la ventana emergente al hacer clic en el botón de cierre
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";  // Ocultar la ventana emergente
        sidebar.style.display = "block";  // Mostrar nuevamente el menú lateral
    });
}

// Llamar a la función para abrir la ventana emergente
// Puedes asignar esto a un evento como un clic en un botón de abrir
// togglePopupColores();

function togglePopupModificarMarca(claveMarca, descripcionMarca) {
    const popup = document.getElementById("popupnuevamarca");
    const closePopup = document.getElementById("closePopupProducto");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    popup.style.display = "flex";  // Cambiar display de 'none' a 'flex' para mostrarla

    // Si se pasa un valor de color, asignarlo al campo del formulario
    if (claveMarca !== '') {
        document.getElementById("idmodificarMarca1").value = claveMarca;
        document.getElementById("modificarMarca1").value = descripcionMarca;
    }

    // Cerrar la ventana emergente al hacer clic en el botón de cierre
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";  // Ocultar la ventana emergente

        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false;
        }
    });
}


function togglePopupModificarProducto(claveProducto, nombreProducto, marca, caracteristicas, color, precioContado, crediContado, credito, enganche, comision, categoria) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupModificarProducto");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    popup.style.display = "flex";

    // Ocultar el menú lateral
    sidebar.style.display = "none";

    // Colocar los valores en el formulario
    document.getElementById("claveProducto").value = claveProducto;
    document.getElementById("nombreProducto").value = nombreProducto;
    document.getElementById("caracteristicas").value = caracteristicas;
    document.getElementById("precioContado").value = parseFloat(precioContado).toFixed(2);
    document.getElementById("crediContado").value = parseFloat(crediContado).toFixed(2);
    document.getElementById("credito").value = parseFloat(credito).toFixed(2);
    document.getElementById("enganche").value = parseFloat(enganche).toFixed(2);
    document.getElementById("comision").value = parseFloat(comision).toFixed(2);
    document.getElementById("marca").value = marca;
    document.getElementById("color").value = color;
    document.getElementById("categoria").value = categoria;

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupModifiP");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

        // Resetear los combobox de Marca y Color a su primera opción
        const comboMarca = document.getElementById("ComboMarcaMod");
        const comboColor = document.getElementById("ComboColorMod");
        const comboCategoria = document.getElementById("ComboCategoriaMod");

        if (comboMarca) comboMarca.selectedIndex = 0; // Seleccionar la primera opción
        if (comboColor) comboColor.selectedIndex = 0; // Seleccionar la primera opción
        if (comboCategoria) comboCategoria.selectedIndex = 0; // Seleccionar la primera opción

        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    });
}

function togglePopupModificarColor(claveColor, descripcion) {
    const popup = document.getElementById("popupnuevacolor");
    const closePopup = document.getElementById("closePopupColor");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    popup.style.display = "flex";

    // Asignar valores a los campos si se proporcionan
    document.getElementById("idmodificarColor").value = claveColor;
    document.getElementById("modificarColor").value = descripcion;

    // Cerrar la ventana emergente al hacer clic en el botón de cierre
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";  // Ocultar la ventana emergente

        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false;
        }
    });
}


document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("credito").addEventListener("input", function () {
        let precio = parseFloat(this.value);

        if (isNaN(precio) || precio <= 0) {
            document.getElementById("crediContado").value = "";
            document.getElementById("precioContado").value = "";
            document.getElementById("enganche").value = "";
            document.getElementById("comision").value = "";
            return;
        }

        let precioCredito = precio;
        let creditoContado = precio - (precio * 0.20);
        let contado = precio - (precio * 0.30);
        let enganche = precioCredito * 0.10;
        let comision = 0.00;

        if (precioCredito < 1000) {
            comision = 50.00;
        } else if (precioCredito >= 1000 && precioCredito < 5000) {
            comision = 100.00;
        } else if (precioCredito >= 5000 && precioCredito < 7000) {
            comision = 150.00;
        } else if (precioCredito >= 7000 && precioCredito < 9000) {
            comision = 200.00;
        } else if (precioCredito >= 9000 && precioCredito < 12000) {
            comision = 250.00;
        } else if (precioCredito >= 12000 && precioCredito < 14000) {
            comision = 300.00;
        } else if (precioCredito >= 14000 && precioCredito < 16000) {
            comision = 350.00;
        } else if (precioCredito >= 16000 && precioCredito < 19000) {
            comision = 400.00;
        } else if (precioCredito >= 19000 && precioCredito < 21000) {
            comision = 500.00;
        } else if (precioCredito >= 21000 && precioCredito < 24000) {
            comision = 550.00;
        } else if (precioCredito >= 24000 && precioCredito < 29000) {
            comision = 600.00;
        } else {
            comision = precioCredito / 50;
        }

        document.getElementById("crediContado").value = creditoContado.toFixed(2);
        document.getElementById("precioContado").value = contado.toFixed(2);
        document.getElementById("enganche").value = enganche.toFixed(2);
        document.getElementById("comision").value = comision.toFixed(2);
    });
});
