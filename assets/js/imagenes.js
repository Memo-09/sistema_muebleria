function togglePopupImagenes(claveProducto) {
    // Mostrar la ventana emergente
    const popup = document.getElementById("popupImagen");
    const sidebar = document.getElementById("sidebar");

    // Mostrar la ventana emergente
    popup.style.display = "flex";

    // Ocultar el menú lateral
    sidebar.style.display = "none";

    document.getElementById("claveProductoInput").value = claveProducto;

    // Cerrar la ventana emergente al hacer clic en el botón Cancelar
    const closePopup = document.getElementById("closePopupImagenes");
    closePopup.addEventListener("click", function () {
        popup.style.display = "none"; // Ocultar la ventana emergente
        sidebar.style.display = "block"; // Mostrar nuevamente el menú lateral
    });
}


document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("formSubirImagenes");

    if (formulario) {
        formulario.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevenir recarga

            const ids = ["imagenProducto1", "imagenProducto2", "imagenProducto3", "imagenProducto4"];
            const formatosValidos = ["image/jpeg", "image/png", "image/jpg"];
            let formData = new FormData();

            for (let i = 0; i < ids.length; i++) {
                const input = document.getElementById(ids[i]);
                const archivo = input.files[0];

                if (!archivo) {
                    alert("⚠️ Faltan imágenes por seleccionar.");
                    return;
                }

                if (!formatosValidos.includes(archivo.type)) {
                    alert(`⚠️ Imagen ${i + 1} no es válida. Solo se permiten archivos JPG o PNG.`);
                    return;
                }

                formData.append("imagenProducto[]", archivo);
            }

            // Agrega la clave del producto
            const claveProducto = document.getElementById("claveProductoInput").value;
            formData.append("claveProducto", claveProducto);

            // URL dinámica
            const baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
            const baseURL2 = baseURL + "/funciones_base/agregar_imagenes.php";

            fetch(baseURL2, {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Muestra mensaje del servidor

                // Si la respuesta contiene "✅", recarga la página
                if (data.includes("✅")) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error al subir imágenes:", error);
                alert("❌ Hubo un error al subir las imágenes.");
            });
        });
    }
});







