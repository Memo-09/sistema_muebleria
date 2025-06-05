document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".categoria-btn").forEach(boton => {
        boton.addEventListener("click", function () {
            const idCategoria = this.getAttribute("data-id");
            cargarProductosPorCategoria(idCategoria);
        });
    });

    inicializarEventosCarrito();
});

function cargarProductosPorCategoria(idCategoria) {
    const baseURL = window.location.pathname.split("/").slice(0, -1).join("/");

    fetch(`${baseURL}/funciones_base/productos_por_categoria.php`, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id_categoria=${encodeURIComponent(idCategoria)}`
    })
    .then(response => response.text())
    .then(data => {
        document.querySelector(".contenedor-items").innerHTML = data;
        inicializarEventosCarrito();
    })
    .catch(error => console.error("Error al cargar productos:", error));
}

let carritoVisible = false;

const carritoItems = document.querySelectorAll('.carrito-item');

function inicializarEventosCarrito() {
    document.querySelectorAll('.btn-eliminar').forEach(btn =>
        btn.addEventListener('click', eliminarItemCarrito)
    );

    document.querySelectorAll('.sumar-cantidad').forEach(btn =>
        btn.addEventListener('click', sumarCantidad)
    );

    document.querySelectorAll('.restar-cantidad').forEach(btn =>
        btn.addEventListener('click', restarCantidad)
    );

    document.querySelectorAll('.boton-item').forEach(btn =>
        btn.addEventListener('click', agregarAlCarritoClicked)
    );

    // ✅ Asignar evento a todos los botones de pagar
    document.querySelectorAll('.btn-pagar').forEach(btn =>
        btn.addEventListener('click', pagarClicked)
    );
}


function agregarAlCarritoClicked(event) {
    const button = event.target;
    const item = button.closest('.item');

    const titulo = item.querySelector('.titulo-item').textContent;
    const precio = item.querySelector('.precio-item').textContent;
    const imagenSrc = item.querySelector('.img-item').src;

    // ✅ Obtener las existencias desde el span oculto
    const existencias = parseInt(item.querySelector('.existencias-item').textContent);

    console.log("Existencias:", existencias); // Solo para verificar, puedes eliminarlo luego

    if (existencias > 0) {
        agregarItemAlCarrito(titulo, precio, imagenSrc, existencias);
        mostrarCarrito();
        actualizarTotalCarrito();
    } else {
        alert('Producto sin existencias');
    }
}




function mostrarCarrito() {
    carritoVisible = true;
    document.querySelector('.carrito').style.marginRight = '0';
    document.querySelector('.carrito').style.opacity = '1';
    document.querySelector('.contenedor-items').style.width = '60%';
}

function ocultarCarrito() {
    const carritoItems = document.querySelector('.carrito-items');
    if (carritoItems.children.length === 0) {
        document.querySelector('.carrito').style.marginRight = '-100%';
        document.querySelector('.carrito').style.opacity = '0';
        carritoVisible = false;
        document.querySelector('.contenedor-items').style.width = '100%';
    }
}

function agregarItemAlCarrito(titulo, precio, imagenSrc, existencias) {
    const itemsCarrito = document.querySelector('.carrito-items');
    const nombresItemsCarrito = itemsCarrito.querySelectorAll('.carrito-item-titulo');

    for (let item of nombresItemsCarrito) {
        if (item.innerText === titulo) {
            alert("El item ya se encuentra en el carrito");
            return;
        }
    }

    console.log(existencias);

    const itemHTML = `
        <div class="carrito-item" data-existencias="${existencias}">
            <img src="${imagenSrc}" width="80px" alt="">
            <div class="carrito-item-detalles">
                <span class="carrito-item-titulo">${titulo}</span>
                <div class="selector-cantidad">
                    <i class="fa-solid fa-minus restar-cantidad"></i>
                    <input type="text" value="1" class="carrito-item-cantidad" disabled>
                    <i class="fa-solid fa-plus sumar-cantidad"></i>
                </div>
                <span class="carrito-item-precio">${precio}</span>
            </div>
            <button class="btn-eliminar"><i class="fa-solid fa-trash"></i></button>
        </div>
    `;

    const nuevoItem = document.createElement('div');
    nuevoItem.classList.add('item');
    nuevoItem.innerHTML = itemHTML;
    document.querySelector('.carrito-items').appendChild(nuevoItem);

    nuevoItem.querySelector('.btn-eliminar').addEventListener('click', eliminarItemCarrito);
    nuevoItem.querySelector('.sumar-cantidad').addEventListener('click', sumarCantidad);
    nuevoItem.querySelector('.restar-cantidad').addEventListener('click', restarCantidad);

    actualizarTotalCarrito();
}


function eliminarItemCarrito(event) {
    event.target.closest('.carrito-item').remove();
    actualizarTotalCarrito();

    // Mostrar en consola la cantidad actual de productos
    const cantidadProductos = document.querySelectorAll('.carrito-item').length;
    console.log("Productos en el carrito después de eliminar:", cantidadProductos);
}

function sumarCantidad(event) {
    const selector = event.target.parentElement;
    const itemCarrito = selector.closest('.carrito-item');
    const existenciasMax = parseInt(itemCarrito.dataset.existencias);
    let cantidad = parseInt(selector.querySelector('.carrito-item-cantidad').value);

    if (cantidad + 1 > existenciasMax) {
        alert("Existencias insuficientes");
        selector.querySelector('.carrito-item-cantidad').value = 1;
    } else {
        selector.querySelector('.carrito-item-cantidad').value = ++cantidad;
    }

    actualizarTotalCarrito();
}


function restarCantidad(event) {
    const selector = event.target.parentElement;
    let cantidad = parseInt(selector.querySelector('.carrito-item-cantidad').value);
    if (cantidad > 1) {
        selector.querySelector('.carrito-item-cantidad').value = --cantidad;
        actualizarTotalCarrito();
    }
}

function actualizarTotalCarrito() {
    let totalCredito = 0;

    document.querySelectorAll('.carrito-item').forEach(item => {
        const precioTexto = item.querySelector('.carrito-item-precio').innerText;
        const precio = parseFloat(precioTexto.replace('$', '').replace(/,/g, '')); // Quita comas
        const cantidad = parseInt(item.querySelector('.carrito-item-cantidad').value);
        const subtotal = precio * cantidad;

        totalCredito += subtotal;
    });

    // Calcular otros tipos de pago
    const totalCrediContado = totalCredito * 0.80; // 20% de descuento
    const totalContado = totalCredito * 0.70; // 30% de descuento

    // Mostrar resultados con formato
    document.querySelector('.carrito-precio-credito').innerText =
        '$' + totalCredito.toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    document.querySelector('.carrito-precio-credcont').innerText =
        '$' + totalCrediContado.toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    document.querySelector('.carrito-precio-contado').innerText =
        '$' + totalContado.toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}


function pagarClicked(event) {
    const tipo = event.currentTarget.getAttribute('data-tipo');

    // Obtener los tres precios
    const credito = document.querySelector('.carrito-precio-credito').innerText;
    const credi_contado = document.querySelector('.carrito-precio-credcont').innerText;
    const contado = document.querySelector('.carrito-precio-contado').innerText;


    // Determinar cuál precio se seleccionó
    let totalTexto = '';
    if (tipo === 'credito') {
        totalTexto = credito;
    } else if (tipo === 'credicontado') {
        totalTexto = credi_contado;
    } else if (tipo === 'contado') {
        totalTexto = contado;
    }

    const total = parseFloat(totalTexto.replace('$', '').replace(/,/g, ''));

    if (total <= 0 || isNaN(total)) {
        alert("La compra no es válida porque no contiene ningún producto.");
        ocultarCarrito();
        return;
    }

    alert("Gracias por su compra al precio de " + totalTexto);


    console.log("Precios disponibles:");
    console.log("Crédito: " + credito);
    console.log("Crédito/Contado: " + credi_contado);
    console.log("Contado: " + contado);
    console.log("Precio Seleccionado: " + totalTexto);

    // Limpiar carrito
    document.querySelector('.carrito-items').innerHTML = '';
    actualizarTotalCarrito();
    ocultarCarrito();
}


















