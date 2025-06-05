function togglePopupModificarCliente(clave, nombre, apellido1, apellido2, calle, numero1, numero2, telefono, correo, colonia, municipio) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupModificarCliente");
    const sidebar = document.getElementById("sidebar");

    popup.style.display = "flex"; // Mostrar la ventana emergente
    sidebar.style.display = "none"; // Ocultar el menú lateral

    // Asignar valores a los inputs del formulario
    document.getElementById("calveMod1").value = clave || '';
    document.getElementById("nombreMod1").value = nombre || '';
    document.getElementById("ApellidoMod1").value = apellido1 || '';
    document.getElementById("ApellidoMod2").value = apellido2 || '';
    document.getElementById("CalleMod1").value = calle || 'SIN DESCRIPCIÓN';
    document.getElementById("numeroMod1").value = numero1 || 'S/N';
    document.getElementById("numeroMod2").value = numero2 || 'S/N';
    document.getElementById("telefonoMod1").value = telefono || 'NO REGISTRADO';
    document.getElementById("correoMod1").value = correo || 'NO REGISTRADO';
    document.getElementById("coloniaMod1").value = colonia || '';
    document.getElementById("municipioMod1").value = municipio || '';

    // Establecer la URL del archivo PHP
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var url = baseURL + "/funciones_base/obtener_colaborador.php";

    // Crear un objeto FormData para enviar la clave
    var formData = new FormData();
    formData.append('clave', clave);

    // Realizar la solicitud AJAX con Fetch API
    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Convertir la respuesta en JSON
    .then(data => {
        if (data.success) {
            // Verificar si se encontraron colaboradores
            if (data.colaboradores.length > 0) {
                const colaborador = data.colaboradores[0]; // Obtener el primer colaborador

                // Asignar los valores a los inputs
                document.getElementById("claveCartera3").value = colaborador.ID_COLABORADOR;
                document.getElementById("nombreCartera3").value = colaborador.NOMBRE + ' ' + colaborador.AP_P + ' ' + colaborador.AP_M;
            } else {
                alert("No se encontraron colaboradores para este cliente.");
            }
        } else {
            alert(data.error); // Mostrar error del servidor
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un error en la conexión con el servidor.");
    });

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    document.getElementById("closePopupModificarCliente").addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

        // Limpiar los inputs de clave y nombre
        document.getElementById("claveCartera3").value = '';
        document.getElementById("nombreCartera3").value = '';
    });
}
