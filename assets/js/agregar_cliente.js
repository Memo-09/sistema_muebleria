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

