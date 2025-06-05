function togglePopupModificarCliente(clave, nombre, apellido1, apellido2, calle, numero1, numero2, telefono, correo, colonia, municipio) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupModificarCliente");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    popup.style.display = "flex"; // Mostrar la ventana emergente
    sidebar.style.display = "none"; // Ocultar el menú lateral

    // Función para validar valores nulos o vacíos y asignar un valor predeterminado
    const validateValue = (value, defaultValue) => value || defaultValue;

    // Colocar los valores en el formulario con validación y valores específicos
    document.getElementById("calveMod1").value = validateValue(clave, '');
    document.getElementById("nombreMod1").value = validateValue(nombre, '');
    document.getElementById("ApellidoMod1").value = validateValue(apellido1, '');
    document.getElementById("ApellidoMod2").value = validateValue(apellido2, '');
    document.getElementById("CalleMod1").value = validateValue(calle, 'SIN DESCRIPCION');
    document.getElementById("numeroMod1").value = validateValue(numero1, 'S/N');
    document.getElementById("numeroMod2").value = validateValue(numero2, 'S/N');
    document.getElementById("telefonoMod1").value = validateValue(telefono, 'NO REGISTRADO');
    document.getElementById("correoMod1").value = validateValue(correo, 'NO REGISTRADO');
    document.getElementById("coloniaMod1").value = validateValue(colonia, '');
    document.getElementById("municipioMod1").value = validateValue(municipio, '');

    var formData = new FormData();
    formData.append('clave', clave);

    // Establecer la URL al archivo PHP
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var baseURL2 = baseURL + "/funciones_base/obtener_colaborador.php";

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL2, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor
        } else {
            alert("Hubo un error al actualizar el colaborador.");
        }
    };

    xhr.onerror = function () {
        alert("Error en la conexión al servidor.");
    };

    xhr.send(formData);


    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupModificarCliente");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

        // Resetear los combobox de Marca y Color a su primera opción
        const comboMarca = document.getElementById("ComboCartera");

        if (comboMarca) comboMarca.selectedIndex = 0; // Seleccionar la primera opción

        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    });
}


