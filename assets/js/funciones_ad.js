// Función para actualizar el texto del cuadro de texto
function updateTextColor() {
    const comboBox = document.getElementById("ComboColorMod");
    const textBox = document.getElementById("color");
    const selectedValue = comboBox.value; // Obtener el valor seleccionado
    if (selectedValue !== "seleccion") {
        textBox.value = selectedValue; // Asignar el valor al cuadro de texto
    } else {
        textBox.value = ""; // Limpiar el cuadro de texto si selecciona la opción inicial
    }
}

function updateTextMarca() {
    const comboBox = document.getElementById("ComboMarcaMod");
    const textBox = document.getElementById("marca");
    const selectedValue = comboBox.value; // Obtener el valor seleccionado
    if (selectedValue !== "seleccion") {
        textBox.value = selectedValue; // Asignar el valor al cuadro de texto
    } else {
        textBox.value = ""; // Limpiar el cuadro de texto si selecciona la opción inicial
    }
}



function generarClave() {
    // Hacer la consulta AJAX para obtener el último número registrado
    var baseURL = window.location.pathname.split("/").slice(0, -1).join("/");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", baseURL + "/funciones_base/generar_clave.php", true); // La ruta donde tienes el PHP que obtiene el último número
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Obtener el último número desde la respuesta
            var ultimoNumero = parseInt(xhr.responseText);
            // Incrementar el número para la nueva clave
            var nuevaClave = ultimoNumero + 1;
            // Colocar la nueva clave en el campo de texto
            document.getElementById("claveProducto1").value = nuevaClave;
        } else {
            alert("Hubo un error al generar la clave.");
        }
    };
    xhr.send();
}

document.addEventListener("DOMContentLoaded", function() {
    // Escuchar el evento 'input' en el campo precioCredito1
    document.getElementById('precioCredito1').addEventListener('input', function() {
        let precio = parseFloat(document.getElementById('precioCredito1').value);

        if (isNaN(precio) || precio <= 0) {
            document.getElementById('crediContado1').value = '';
            document.getElementById('contado1').value = '';
            document.getElementById('enganche1').value = '';
            document.getElementById('comision1').value = '';
            return;
        }

        let precioCredito = precio;
        let creditoContado = precio - (precio * 0.20); 
        let contado = precio - (precio * 0.30);
        let enganche = precioCredito * 0.10;
        let comision = precioCredito / 50;

        document.getElementById('crediContado1').value = creditoContado.toFixed(2);
        document.getElementById('contado1').value = contado.toFixed(2);
        document.getElementById('enganche1').value = enganche.toFixed(2);
        document.getElementById('comision1').value = comision.toFixed(2);
    });
});
