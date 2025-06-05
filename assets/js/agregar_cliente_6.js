function guardarCliente(event) {
    // Prevenir que el formulario se envíe de forma tradicional
    event.preventDefault();

    // Recoger los valores de los campos del formulario
    var nombre = document.querySelector('#nombre').value;
    var apellidop = document.querySelector('#apellido1').value;
    var apellidom = document.querySelector('#apellido2').value;
    var calle = document.querySelector('#calle').value;
    var numeroexterior = document.querySelector('#numexterior').value;
    var numerointerior = document.querySelector('#numerointerior').value;
    var telefono = document.querySelector('#telefono').value;
    var correo = document.querySelector('#correo').value;
    var colonia = document.querySelector('#colonia').value;
    var municipio = document.querySelector('#municipio').value;
    var id_colaborador = document.querySelector('#ComboCartera').value; // ID del colaborador

    // Validaciones básicas
    if (!nombre || !apellidop || !apellidom || !colonia || !municipio || !id_colaborador) {
        alert("Por favor, complete todos los campos obligatorios.");
        return; // Detener la ejecución si algún campo obligatorio está vacío
    }

    // Validar si los valores de ID son numéricos y válidos
    if (isNaN(id_colaborador) || id_colaborador <= 0) {
        alert("Por favor, seleccione un colaborador válido.");
        return;
    }

    // Crear el objeto FormData para enviar los datos por AJAX
    var formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('ap_p', apellidop);
    formData.append('ap_m', apellidom);
    formData.append('calle', calle);
    formData.append('numero_exterior', numeroexterior);
    formData.append('numero_interior', numerointerior);
    formData.append('telefono', telefono);
    formData.append('correo', correo);
    formData.append('colonia', colonia);
    formData.append('municipio', municipio);
    formData.append('id_colaborador', id_colaborador);

    // Imprimir en consola los datos que se están enviando
    console.log("Datos enviados:", {
        nombre: nombre,
        apellidop: apellidop,
        apellidom: apellidom,
        calle: calle,
        numeroexterior: numeroexterior,
        numerointerior: numerointerior,
        telefono: telefono,
        correo: correo,
        colonia: colonia,
        municipio: municipio,
        id_colaborador: id_colaborador,
    });

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/insertar_cliente.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                // Intentar parsear la respuesta como JSON
                var response = JSON.parse(xhr.responseText);

                if (response.success) {
                    alert(response.message); // Mostrar mensaje de éxito
                    location.reload(); // Recargar la página
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            } catch (e) {
                console.log("Error en la respuesta del servidor: " + xhr.responseText);
            }
        } else {
            alert("Hubo un error al insertar el cliente.");
        }
    };
    xhr.send(formData);
}



function togglePopupModificarCliente(clave, nombre, apellido1, apellido2, calle, numeroexterior, numerointerior, telefono, correo, colonia, municipio) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupModificarCliente");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    popup.style.display = "flex";
    sidebar.style.display = "none";

    const validateValue = (value, defaultValue) => value || defaultValue;
    
    // Llenar los inputs con los valores recibidos
    document.getElementById("claveMod1").value = validateValue(clave, '');
    document.getElementById("nombreMod1").value = validateValue(nombre, '');
    document.getElementById("ApellidoMod1").value = validateValue(apellido1, '');
    document.getElementById("ApellidoMod2").value = validateValue(apellido2, '');
    document.getElementById("CalleMod1").value = validateValue(calle, 'SIN DESCRIPCION');
    document.getElementById("numeroMod1").value = validateValue(numeroexterior, 'S/N');
    document.getElementById("numeroMod2").value = validateValue(numerointerior, 'S/N');
    document.getElementById("telefonoMod1").value = validateValue(telefono, 'N.AGREGADO');
    document.getElementById("correoMod1").value = validateValue(correo, 'N.AGREGADO');
    document.getElementById("coloniaMod1").value = validateValue(colonia, '');
    document.getElementById("municipioMod1").value = validateValue(municipio, '');

    // Enviar solicitud AJAX para obtener los colaboradores y tipo de pago del cliente
    var formData = new FormData();
    formData.append('clave', clave);

    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var url = baseURL + "/funciones_base/obtener_colaborador.php"; // Asegúrate de que este archivo sea el correcto

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.colaboradores.length > 0) {
                // Tomar el primer colaborador de la lista
                const colaborador = data.colaboradores[0];

                // Asignar los valores al input
                document.getElementById("claveCartera3").value = colaborador.ID_COLABORADOR;
                document.getElementById("nombreCartera3").value = `${colaborador.NOMBRE} ${colaborador.AP_P} ${colaborador.AP_M}`;
                
            } else {
                console.error("No se encontraron colaboradores:", data.error);
                document.getElementById("claveCartera3").value = "";
                document.getElementById("nombreCartera3").value = "SIN COLABORADOR";
            }
        } else {
            console.error("Error en la solicitud:", data.error);
        }
    })
    .catch(error => {
        console.error("Error en la solicitud AJAX:", error);
    });

    // Cerrar popup al hacer clic en el botón cancelar
    const closePopup = document.getElementById("closePopupModificarCliente");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar el menú lateral
    
        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    
        // Restablecer el ComboBox a la opción seleccionada
        const comboCarteraMod = document.getElementById("ComboCarteraMod");
        comboCarteraMod.selectedIndex = 0; // Volver a la opción "Seleccione una opción"
    });
}






function actualizarCliente(event) {
    event.preventDefault();

    var clave = document.querySelector('#claveMod1').value; // Clave como identificador principal
    var nombre = document.querySelector('#nombreMod1').value;
    var apellidop = document.querySelector('#ApellidoMod1').value;
    var apellidom = document.querySelector('#ApellidoMod2').value;
    var calle = document.querySelector('#CalleMod1').value;
    var numeroexterior = document.querySelector('#numeroMod1').value;
    var numerointerior = document.querySelector('#numeroMod2').value;
    var telefono = document.querySelector('#telefonoMod1').value;
    var correo = document.querySelector('#correoMod1').value;
    var colonia = document.querySelector('#coloniaMod1').value;
    var municipio = document.querySelector('#municipioMod1').value;
    var id_colaborador = document.querySelector('#claveCartera3').value;

    if (!clave || !nombre || !apellidop || !apellidom || !colonia || !municipio) {
        alert("Por favor, complete todos los campos obligatorios.");
        return;
    }

    var formData = new FormData();
    formData.append('clave', clave);
    formData.append('nombre', nombre);
    formData.append('ap_p', apellidop);
    formData.append('ap_m', apellidom);
    formData.append('calle', calle);
    formData.append('numero_exterior', numeroexterior);
    formData.append('numero_interior', numerointerior);
    formData.append('telefono', telefono);
    formData.append('correo', correo);
    formData.append('colonia', colonia);
    formData.append('municipio', municipio);
    formData.append('id_colaborador', id_colaborador);

    fetch("funciones_base/modificar_cliente.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            alert(data.messages.join("\n")); // Mostrar todos los mensajes recibidos
            location.reload();
        } else {
            alert("Error: " + (data.error || "Ocurrió un problema al actualizar el cliente."));
        }
    })
    .catch(error => {
        console.error("Error en la solicitud AJAX:", error);
        alert("Error en la comunicación con el servidor. Por favor, revise su conexión.");
    });
}



document.addEventListener("DOMContentLoaded", function () {
    const comboCarteraMod = document.getElementById("ComboCarteraMod");
    const claveCartera = document.getElementById("claveCartera3");
    const nombreCartera = document.getElementById("nombreCartera3");

    comboCarteraMod.addEventListener("change", function () {
        // Borrar el contenido de los inputs
        claveCartera.value = "";
        nombreCartera.value = "";

        // Obtener la opción seleccionada
        const selectedOption = comboCarteraMod.options[comboCarteraMod.selectedIndex];

        // Extraer la clave y el nombre completo
        if (selectedOption.value !== "seleccion") {
            const datos = selectedOption.text.split("."); // Divide en clave y nombre
            if (datos.length >= 2) {
                claveCartera.value = datos[0].trim(); // Clave
                nombreCartera.value = datos[1].trim(); // Nombre completo
            }
        }
    });
});



function togglePopup() {
    const popup = document.getElementById("popup");
    const sidebar = document.getElementById("sidebar");
    const closePopup = document.getElementById("closePopup"); // El botón de cerrar (Cancelar)
    const selectElement1 = document.getElementById("ComboCartera"); // ID del combobox de Marca

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
        inputs.forEach(function(input) {
            input.value = ""; // Limpiar el contenido de cada cuadro de texto
        });

        // Restablecer el valor del combobox a "seleccion"
        if (selectElement1) {
            selectElement1.value = "seleccion"; // Restablecer el valor del combobox de Marca
        }
    });
}