function actualizarStatusVenta() {
    let idVenta = document.getElementById("claveVenta").value;

    if (!idVenta) {
        alert("No hay un ID de venta seleccionado.");
        return;
    }

    // Obtener la URL base dinámicamente
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/actualizar_status_deudores.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.includes("Estatus actualizado correctamente")) {
                alert("Estatus actualizado correctamente, esta en los Deudores");
                location.reload(); // Recarga la página si fue exitoso
            } else {
                alert("Error: " + xhr.responseText);
            }
        }
    };

    xhr.send("id_venta=" + encodeURIComponent(idVenta));
}



function quitardeDeudores() {
    let idVenta = document.getElementById("claveVenta").value;

    if (!idVenta) {
        alert("No hay un ID de venta seleccionado.");
        return;
    }

    // Obtener la URL base dinámicamente
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "/funciones_base/quitar_deudores.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.includes("Estatus actualizado correctamente")) {
                alert("Estatus actualizado correctamente, Se quito de los Deudores");
                location.reload(); // Recarga la página si fue exitoso
            } else {
                alert("Error: " + xhr.responseText);
            }
        }
    };

    xhr.send("id_venta=" + encodeURIComponent(idVenta));
}

