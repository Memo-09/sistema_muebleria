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

function updateTextCategoria() {
    const comboBox = document.getElementById("ComboCategoriaMod");
    const textBox = document.getElementById("categoria");
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
        let comision = 0.00;

        if (precioCredito < 1000) {
            comision = 50.00;
        } else if (precioCredito >= 1000 && precioCredito < 5000) {
            comision = 100.00;
        } else if (precioCredito >= 5000 && precioCredito < 7000) {
            comision = 150.00;
        } else if (precioCredito >= 7000 && precioCredito < 9000) {
            comision = 200.00;
        } else if (precioCredito >= 9000 && precioCredito < 12000) {
            comision = 250.00;
        } else if (precioCredito >= 12000 && precioCredito < 14000) {
            comision = 300.00;
        } else if (precioCredito >= 14000 && precioCredito < 16000) {
            comision = 350.00;
        } else if (precioCredito >= 16000 && precioCredito < 19000) {
            comision = 400.00;
        } else if (precioCredito >= 19000 && precioCredito < 21000) {
            comision = 500.00;
        } else if (precioCredito >= 21000 && precioCredito < 24000) {
            comision = 550.00;
        } else if (precioCredito >= 24000 && precioCredito < 29000) {
            comision = 600.00;
        }

        document.getElementById('crediContado1').value = creditoContado.toFixed(2);
        document.getElementById('contado1').value = contado.toFixed(2);
        document.getElementById('enganche1').value = enganche.toFixed(2);
        document.getElementById('comision1').value = comision.toFixed(2);
    });
});
