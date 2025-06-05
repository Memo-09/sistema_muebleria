var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
// Escuchar los clics en los botones eliminar de la tabla
document.addEventListener("DOMContentLoaded", function () {
    const tabla2 = document.getElementById("tabla2").querySelector("tbody");
    const bodegas = document.getElementById("claveBodega").value;

    tabla2.addEventListener("click", function (event) {
        if (event.target.classList.contains("eliminar-btn2")) {
            // Obtener el botón que disparó el evento
            const btn = event.target;

            // Obtener los datos de la fila
            const fila = btn.closest("tr");
            const clave = fila.getAttribute("data-clave");


            const formData = new FormData();
            formData.append("ID_BODEGA", bodegas);
            formData.append("CLAVE_PRODUCTO", clave);

            // Enviar los datos al servidor usando AJAX (fetch)
            fetch(baseURL + "/funciones_base/archivo_php_elimi_bod.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    fila.remove();
                })
                .catch(error => {
                    alert("Error al enviar la solicitud:", error);
                });
        }
    });
});