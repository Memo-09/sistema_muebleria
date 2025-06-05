function togglePopupActualizarColaborador(clave, nombre, apellido1, apellido2) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupActualizarColaborador");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    popup.style.display = "flex";

    // Ocultar el menú lateral
    sidebar.style.display = "none";

    // Colocar los valores en el formulario
    document.getElementById("claveContador").value = clave;
    document.getElementById("nombreContador").value = nombre;
    document.getElementById("apellido1Contador").value = apellido1;
    document.getElementById("apellido2Contador").value = apellido2;

    // Establecer la URL al archivo PHP
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var baseURL2 = baseURL + "/funciones_base/buscar_rol.php";

    var formData = new FormData();
    formData.append('idColaborador', clave);

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL2, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText); // Obtener los datos en formato JSON
            if (response.success) {
                // Asignar el valor del rol al input correspondiente
                document.getElementById("descripcionRolEmpleado").value = response.rolDescripcion;
            } else {
                alert(response.error || "No se pudo obtener el rol del colaborador.");
            }
        } else {
            alert("Hubo un error al obtener el rol del colaborador.");
        }
    };

    xhr.onerror = function () {
        alert("Error en la conexión al servidor.");
    };

    xhr.send(formData);

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupColaborador");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral
        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    });
}






function actualizarColaborador(event) {
    // Prevenir el envío tradicional del formulario
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var idColaborador = document.querySelector('#claveContador').value.trim();
    var nombre = document.querySelector('#nombreContador').value.trim();
    var apP = document.querySelector('#apellido1Contador').value.trim();
    var apM = document.querySelector('#apellido2Contador').value.trim();

    // Validar que los datos no estén vacíos
    if (!idColaborador || !nombre || !apP || !apM) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('idColaborador', idColaborador);
    formData.append('nombre', nombre);
    formData.append('apP', apP);
    formData.append('apM', apM);

    // Establecer la URL al archivo PHP
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var baseURL2 = baseURL + "/funciones_base/modificar_colaborador.php";

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL2, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor

            // Si el mensaje es de éxito, recargar la página
            if (xhr.responseText.includes("actualizado correctamente")) {
                location.reload();
            }
        } else {
            alert("Hubo un error al actualizar el colaborador.");
        }
    };

    xhr.onerror = function () {
        alert("Error en la conexión al servidor.");
    };

    xhr.send(formData);
}


