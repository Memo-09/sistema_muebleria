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
    var id_dia = document.querySelector('#ComboPago').value; // ID del día

    // Validaciones básicas
    if (!nombre || !apellidop || !apellidom || !colonia || !municipio || !id_colaborador || !id_dia) {
        alert("Por favor, complete todos los campos obligatorios.");
        return; // Detener la ejecución si algún campo obligatorio está vacío
    }

    // Validar si los valores de ID son numéricos y válidos
    if (isNaN(id_colaborador) || id_colaborador <= 0) {
        alert("Por favor, seleccione un colaborador válido.");
        return;
    }

    if (isNaN(id_dia) || id_dia <= 0) {
        alert("Por favor, seleccione un día válido.");
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
    formData.append('id_dia', id_dia);

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
        id_dia: id_dia
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

function togglePopupModificarCliente(clave, nombre, apellido1, apellido2, calle, numeroexterior, numerointerior, telefono, correo, colonia, municipio, cartera, dia) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupModificarCliente");
    const sidebar = document.getElementById("sidebar");
    const checkbox = document.querySelector('input[type="checkbox"]:checked'); // Encuentra el checkbox seleccionado

    // Mostrar la ventana emergente
    popup.style.display = "flex";

    // Ocultar el menú lateral
    sidebar.style.display = "none";

    // Colocar los valores en el formulario
    document.getElementById("claveMod1").value = clave;
    document.getElementById("nombreMod1").value = nombre;
    document.getElementById("ApellidoMod1").value = apellido1;
    document.getElementById("ApellidoMod2").value = apellido2;
    document.getElementById("CalleMod1").value = calle;
    document.getElementById("numeroMod1").value = numeroexterior;
    document.getElementById("numeroMod2").value = numerointerior;
    document.getElementById("telefonoMod1").value = telefono;
    document.getElementById("correoMod1").value = correo;
    document.getElementById("coloniaMod1").value = colonia;
    document.getElementById("municipioMod1").value = municipio;
    document.getElementById("ComboCartera").value = cartera;
    document.getElementById("combodia").value = dia;

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupModificarCliente");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral

        // Resetear los combobox de Marca y Color a su primera opción
        const comboMarca = document.getElementById("ComboCartera");
        const comboColor = document.getElementById("combodia");

        if (comboMarca) comboMarca.selectedIndex = 0; // Seleccionar la primera opción
        if (comboColor) comboColor.selectedIndex = 0; // Seleccionar la primera opción

        // Desmarcar el checkbox seleccionado al cancelar
        if (checkbox) {
            checkbox.checked = false; // Desmarcar el checkbox
        }
    });
}


