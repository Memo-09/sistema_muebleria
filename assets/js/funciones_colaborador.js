function togglePopupRegistrarColaborador() {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupAgregarColaborador");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    popup.style.display = "flex";

    // Ocultar el menú lateral
    sidebar.style.display = "none";

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupColaboradorIn");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral
        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    });
}


function agregarColaborador(event) {
    // Prevenir el envío tradicional del formulario
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var nombre = document.querySelector('#nombreContador1').value.trim();
    var apP = document.querySelector('#apellido1Contador1').value.trim();
    var apM = document.querySelector('#apellido2Contador1').value.trim();
    var rol = document.querySelector('#ComboRolColaborador').value.trim();
    var usuario = document.querySelector('#usuario').value.trim();
    var contrasena = document.querySelector('#contrasenia').value.trim();

    // Validar que los campos no estén vacíos
    if (!nombre || !apP || !apM || !usuario || !contrasena) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    if (rol === "seleccion") {
        alert("Por favor, selecciona un rol válida.");
        // Aquí puedes agregar más acciones si el valor es "seleccion"
        return;
    }

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('apP', apP);
    formData.append('apM', apM);
    formData.append('rol', rol);
    formData.append('usuario', usuario);
    formData.append('contrasena', contrasena);

    // Establecer la URL del archivo PHP donde se procesarán los datos
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var baseURL2 = baseURL + "/funciones_base/agregar_colaborador.php";

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL2, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText); // Mostrar respuesta del servidor
            location.reload(); // Recargar la página (o cerrar el popup si lo prefieres)
        } else {
            alert("Hubo un error al agregar el colaborador.");
        }
    };

    xhr.onerror = function () {
        alert("Error en la conexión al servidor.");
    };

    xhr.send(formData);
}




document.addEventListener("DOMContentLoaded", function () {
    const inputOriginal = document.getElementById("usuario");
    const inputDestino = document.getElementById("contrasenia");

    inputOriginal.addEventListener("input", function () {
        inputDestino.value = inputOriginal.value;
    });
});



function togglePassword() {
    const passwordInput = document.getElementById("contrasenia");
    const toggleIcon = document.querySelector(".toggle-password");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.textContent = "🔓"; // Cambia al icono de candado abierto
    } else {
        passwordInput.type = "password";
        toggleIcon.textContent = "🔒"; // Cambia al icono de candado cerrado
    }
}


