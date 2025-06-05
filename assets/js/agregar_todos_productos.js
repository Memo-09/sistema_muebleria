function AgregarTodosLosProductos() {
    var idCentroOperaciones = $("#claveSucursal").val(); // Obtiene el valor del input
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    $.ajax({
        url: baseURL + "/funciones_base/insertar_todo.php",
        type: "POST",
        data: { id_centro_operaciones: idCentroOperaciones },
        success: function(response) {
            alert(response); // Muestra el mensaje de respuesta del PHP
            
            // Si la respuesta contiene "correctamente", redirigir a sucursales.php
            if (response.includes("correctamente")) {
                window.location.href = baseURL + "/sucursales.php";
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
            alert("Hubo un error al agregar los productos.");
        }
    });
}

function AgregarTodosLosProductos2() {
    var idCentroOperaciones = $("#claveBodega").val(); // Obtiene el valor del input
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    $.ajax({
        url: baseURL + "/funciones_base/insertar_todo.php",
        type: "POST",
        data: { id_centro_operaciones: idCentroOperaciones },
        success: function(response) {
            alert(response); // Muestra el mensaje de respuesta del PHP
            
            // Si la respuesta contiene "correctamente", redirigir a sucursales.php
            if (response.includes("correctamente")) {
                window.location.href = baseURL + "/bodegas.php";
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
            alert("Hubo un error al agregar los productos.");
        }
    });
}

