document.addEventListener("DOMContentLoaded", function() {
    // Verificar si el rol es 1 o 3
    if (usuarioRol !== 1 && usuarioRol !== 3) {
        // Si el rol no es 1 ni 3, ocultamos los elementos
        var elementos = document.querySelectorAll('.wordset ul li');
        
        // Ocultar cada <li>
        elementos.forEach(function(item) {
            item.style.display = "none";  // Establecer display a "none" para ocultarlos
        });
    }

    // Inicializamos DataTables después de ocultar los elementos
    $('#myTable').DataTable();  // Asegúrate de usar el ID correcto de la tabla
});


document.addEventListener("DOMContentLoaded", function() {
    // Verificar si el usuario NO tiene rol 1 ni 3
    if (usuarioRol !== 1 && usuarioRol !== 3) {
        // Seleccionar los elementos del menú a ocultar por su ID
        var elementosOcultar = [
            document.getElementById("clientes4"),
            document.getElementById("sucursales4"),
            document.getElementById("bodegas4")
        ];

        // Recorrer la lista y ocultar los elementos si existen
        elementosOcultar.forEach(function(elemento) {
            if (elemento) {
                elemento.style.display = "none";
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Verificar si el usuario NO tiene rol 1 ni 3
    if (usuarioRol !== 1 && usuarioRol !== 3) {
        // Ocultar solo la opción "Colaboradores" dentro del menú "Usuarios"
        var opcionColaboradores = document.querySelector("#colaboradores4 ul li:first-child");

        if (opcionColaboradores) {
            opcionColaboradores.style.display = "none";
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el usuario NO tiene rol 1 ni 3
    if (usuarioRol !== 1 && usuarioRol !== 3) {
        // Seleccionar todos los elementos que contienen el botón de eliminar
        var btnEliminar = document.querySelectorAll("#badgeEliminar");

        btnEliminar.forEach(function (element) {
            // Crear un nuevo elemento <span> con el mensaje "NO DISPONIBLE"
            var mensaje = document.createElement("span");
            mensaje.textContent = "NO DISPONIBLE";
            mensaje.style.color = "red";
            mensaje.style.fontWeight = "bold";

            // Reemplazar el botón de eliminar con el mensaje
            element.parentNode.replaceChild(mensaje, element);
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el usuario NO tiene rol 1 ni 3
    if (usuarioRol !== 1 && usuarioRol !== 3) {
        // Seleccionar todos los elementos que contienen el botón de eliminar
        var btnEliminar = document.querySelectorAll("#badgeDetalle");

        btnEliminar.forEach(function (element) {
            // Crear un nuevo elemento <span> con el mensaje "NO DISPONIBLE"
            var mensaje = document.createElement("span");
            mensaje.textContent = "NO DISPONIBLE";
            mensaje.style.color = "red";
            mensaje.style.fontWeight = "bold";

            // Reemplazar el botón de eliminar con el mensaje
            element.parentNode.replaceChild(mensaje, element);
        });
    }
});

