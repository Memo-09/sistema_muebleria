document.addEventListener("DOMContentLoaded", function() {
    // Verificar si el rol es 1 o 3
    if (usuarioRol !== 1 && usuarioRol !== 2 &&  usuarioRol !== 3) {
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
    if (usuarioRol !== 1 && usuarioRol !== 3 && usuarioRol !== 2) {
        // Seleccionar los elementos del menú a ocultar por su ID
        var elementosOcultar = [
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
    if (usuarioRol !== 1 && usuarioRol !== 2 &&  usuarioRol !== 3) {
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
    if (usuarioRol !== 1 && usuarioRol !== 2 && usuarioRol !== 3) {
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

document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el usuario NO tiene rol 1 ni 3
    if (usuarioRol !== 1 && usuarioRol !== 3) {
        // Seleccionar todos los spans que contienen el botón de eliminar
        var botonesEliminar = document.querySelectorAll(".eliminar-boton");

        botonesEliminar.forEach(function (element) {
            // Crear el mensaje "NO DISPONIBLE" en rojo y negrita
            var mensaje = document.createElement("span");
            mensaje.textContent = "NO DISPONIBLE";
            mensaje.style.color = "red";
            mensaje.style.fontWeight = "bold";

            // Limpiar el contenido del span y poner el mensaje
            element.innerHTML = "";
            element.appendChild(mensaje);

            // Opcional: cambiar el color de fondo
            element.classList.remove("bg-lightgreen");
            element.classList.add("bg-lightgray"); // Si tienes definida esa clase
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    // Ocultar elementos de inventario si el usuario no es rol 1, 2 o 3
    var inventarioItems = document.querySelectorAll(".acceso-inventario");

    inventarioItems.forEach(function (item) {
        if (usuarioRol !== 1 && usuarioRol !== 2 && usuarioRol !== 3) {
            item.style.display = "none";
        } else {
            item.style.display = ""; // Se muestra si tiene rol permitido
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Mostrar botón "AÑADIR" solo si el rol es 1, 2 o 3
    var botonesEnganche = document.querySelectorAll(".boton-enganche");

    botonesEnganche.forEach(function (element) {
        if (usuarioRol === 1 || usuarioRol === 2 || usuarioRol === 3) {
            // Mostrar normalmente
            element.style.display = "";
        } else {
            // Reemplazar con mensaje "NO DISPONIBLE"
            element.innerHTML = ""; // Borra el botón
            var mensaje = document.createElement("span");
            mensaje.textContent = "NO DISPONIBLE";
            mensaje.style.color = "red";
            mensaje.style.fontWeight = "bold";
            element.appendChild(mensaje);
            element.classList.remove("bg-lightgreen"); // Quita fondo verde
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    // Mostrar botón ELIMINAR solo para roles 1, 2 y 3
    var botonesEliminarCliente = document.querySelectorAll(".boton-eliminar-cliente");

    botonesEliminarCliente.forEach(function (element) {
        if (usuarioRol === 1 || usuarioRol === 2 || usuarioRol === 3) {
            element.style.display = "";
        } else {
            // Reemplazar con mensaje "NO DISPONIBLE"
            element.innerHTML = "";
            var mensaje = document.createElement("span");
            mensaje.textContent = "NO DISPONIBLE";
            mensaje.style.color = "red";
            mensaje.style.fontWeight = "bold";
            element.appendChild(mensaje);
            element.classList.remove("bg-lightgreen");
        }
    });
});

