document.addEventListener("DOMContentLoaded", function () {
    const switchRebaja = document.getElementById('toggleRebajaActualizar');
    const inputCredito = document.getElementById('creditoEscritoActualizar');
    const credito1 = document.getElementById('credito1');

    if (switchRebaja && inputCredito && credito1) {
        // Al cargar la página
        inputCredito.value = "0.00";
        inputCredito.disabled = true;

        // Activar/desactivar el input con el switch
        switchRebaja.addEventListener('change', function () {
            const valorCredito1 = credito1.value.trim();

            if (this.checked) {
                if (valorCredito1 !== "0.00" && valorCredito1 !== "") {
                    inputCredito.disabled = false;
                    inputCredito.value = ""; // Limpiar para que escriba desde cero
                    inputCredito.focus();
                } else {
                    alert("No hay productos");
                    this.checked = false;
                }
            } else {
                inputCredito.value = "0.00";
                inputCredito.disabled = true;
            }
        });

        // Validar solo números y decimales
        inputCredito.addEventListener('input', function () {
            let valor = this.value.replace(/[^0-9.]/g, '');

            // Evitar múltiples puntos
            const partes = valor.split('.');
            if (partes.length > 2) {
                valor = partes[0] + '.' + partes[1];
            }

            // Limitar a 2 decimales si existe punto
            if (valor.includes('.')) {

                let [entero, decimal] = valor.split('.');
                decimal = decimal.slice(0, 2);
                valor = entero + '.' + decimal;
            }

            this.value = valor;
        });

        // Cuando sale del input, formatea como 0.00 si está vacío
        inputCredito.addEventListener('blur', function () {
            if (this.value === '' || isNaN(this.value)) {
                this.value = "0.00";
            } else {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const inputRebaja = document.getElementById("creditoEscritoActualizar");
    const inputCredito = document.getElementById("credito1");
    const creditoContadoInput = document.getElementById("crediContado1");
    const contadoInput = document.getElementById("contado1");
    const engancheInput = document.getElementById("enganche_total"); // Cambiado a enganche_total

    inputRebaja.addEventListener("input", function () {
        let valor = parseFloat(this.value);

        if (!isNaN(valor)) {
            // Asignar valor con formato
            inputCredito.value = valor.toFixed(2);

            // Calcular descuentos
            creditoContadoInput.value = (valor * 0.80).toFixed(2); // 20%
            contadoInput.value = (valor * 0.70).toFixed(2);        // 30%

            // Calcular y asignar enganche (redondeado)
            let enganche = Math.round(valor * 0.10);
            engancheInput.value = enganche.toFixed(2);
        } else {
            // Reiniciar todos en 0.00 si el valor no es válido
            inputCredito.value = "0.00";
            creditoContadoInput.value = "0.00";
            contadoInput.value = "0.00";
            engancheInput.value = "0.00";
        }
    });
});



document.getElementById('toggleCargoAdicionalActualizar').addEventListener('change', function () {
    const campoCargo = document.getElementById('cargoAdicionalActualizar');
    const campoCredito = document.getElementById('credito1');
    let creditoActual = parseFloat(campoCredito.value) || 0;

    if (this.checked) {
        if (creditoActual === 0) {
            alert("No hay productos agregados.");
            this.checked = false;          // Desactiva el switch
            campoCargo.disabled = true;    // Asegura que el campo siga deshabilitado
            return;
        }
        campoCargo.disabled = false;
    } else {
        campoCargo.disabled = true;
        campoCargo.value = '';
    }
});


document.getElementById('agregarCargoActualizar').addEventListener('click', function () {
    const campoCredito = document.getElementById('credito1');
    const campoCreditoContado = document.getElementById('crediContado1');
    const campoContado = document.getElementById('contado1');
    const campoCargo = document.getElementById('cargoAdicionalActualizar');

    // Obtener valores
    let creditoActual = parseFloat(campoCredito.value) || 0;
    let cargoExtra = parseFloat(campoCargo.value) || 0;

    // Validar entrada
    if (cargoExtra <= 0) {
        alert("Ingrese un cargo adicional válido.");
        return;
    }

    // Calcular nuevos valores
    let nuevoCredito = creditoActual + cargoExtra;
    let nuevoCreditoContado = nuevoCredito * 0.85;
    let nuevoContado = nuevoCredito * 0.75;

    // Mostrar resultados
    campoCredito.value = nuevoCredito.toFixed(2);
    campoCreditoContado.value = nuevoCreditoContado.toFixed(2);
    campoContado.value = nuevoContado.toFixed(2);

    // Limpiar input del cargo si quieres
    campoCargo.value = '';
    campoCargo.disabled = true;
    document.getElementById('toggleCargoAdicionalActualizar').checked = false;
});