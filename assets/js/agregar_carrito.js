// Variable que mantiene el estado visible del carrito
var carritoVisible = false;

// Esperamos que todos los elementos de la página carguen para ejecutar el script
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

function ready() {
    // Funcionalidad botones eliminar del carrito
    var botonesEliminarItem = document.getElementsByClassName('btn-eliminar');
    for (var i = 0; i < botonesEliminarItem.length; i++) {
        var button = botonesEliminarItem[i];
        button.addEventListener('click', eliminarItemCarrito);
    }

    // Funcionalidad botones sumar cantidad
    var botonesSumarCantidad = document.getElementsByClassName('sumar-cantidad');
    for (var i = 0; i < botonesSumarCantidad.length; i++) {
        var button = botonesSumarCantidad[i];
        button.addEventListener('click', sumarCantidad);
    }

    // Funcionalidad botones restar cantidad
    var botonesRestarCantidad = document.getElementsByClassName('restar-cantidad');
    for (var i = 0; i < botonesRestarCantidad.length; i++) {
        var button = botonesRestarCantidad[i];
        button.addEventListener('click', restarCantidad);
    }

    // Funcionalidad botón AGREGAR AL CARRITO
    var botonesAgregarAlCarrito = document.getElementsByClassName('boton-item');
    for (var i = 0; i < botonesAgregarAlCarrito.length; i++) {
        var button = botonesAgregarAlCarrito[i];
        button.addEventListener('click', agregarAlCarritoClicked);
    }

    // Funcionalidad botón COMPRAR
    var btnPagar = document.getElementsByClassName('btn-pagar')[0];
    if (btnPagar) {
        btnPagar.addEventListener('click', pagarClicked);
    }
}

// Función que controla el botón clickeado AGREGAR AL CARRITO
function agregarAlCarritoClicked(event) {
    var button = event.target;
    var item = button.closest('.item');
    var titulo = item.getElementsByClassName('titulo-item')[0].innerText;
    var precio = item.getElementsByClassName('precio-item')[0].innerText;
    var imagenSrc = item.getElementsByClassName('img-item')[0].src;

    agregarItemAlCarrito(titulo, precio, imagenSrc);
    hacerVisibleCarrito();
}

// Mostrar carrito
function hacerVisibleCarrito() {
    carritoVisible = true;
    var carrito = document.getElementsByClassName('carrito')[0];
    carrito.style.marginRight = '0';
    carrito.style.opacity = '1';

    var items = document.getElementsByClassName('contenedor-items')[0];
    items.style.width = '60%';
}

// Agregar item al carrito
function agregarItemAlCarrito(titulo, precio, imagenSrc) {
    var item = document.createElement('div');
    item.classList.add('item');
    var itemsCarrito = document.getElementsByClassName('carrito-items')[0];

    var nombresItemsCarrito = itemsCarrito.getElementsByClassName('carrito-item-titulo');
    for (var i = 0; i < nombresItemsCarrito.length; i++) {
        if (nombresItemsCarrito[i].innerText == titulo) {
            alert("El item ya se encuentra en el carrito");
            return;
        }
    }

    var itemCarritoContenido = `
        <div class="carrito-item">
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

    item.innerHTML = itemCarritoContenido;
    itemsCarrito.append(item);

    item.getElementsByClassName('btn-eliminar')[0].addEventListener('click', eliminarItemCarrito);
    item.getElementsByClassName('restar-cantidad')[0].addEventListener('click', restarCantidad);
    item.getElementsByClassName('sumar-cantidad')[0].addEventListener('click', sumarCantidad);

    actualizarTotalCarrito();
}

// Sumar cantidad
function sumarCantidad(event) {
    var selector = event.target.parentElement;
    var cantidadActual = parseInt(selector.getElementsByClassName('carrito-item-cantidad')[0].value);
    cantidadActual++;
    selector.getElementsByClassName('carrito-item-cantidad')[0].value = cantidadActual;
    actualizarTotalCarrito();
}

// Restar cantidad
function restarCantidad(event) {
    var selector = event.target.parentElement;
    var cantidadActual = parseInt(selector.getElementsByClassName('carrito-item-cantidad')[0].value);
    cantidadActual--;
    if (cantidadActual >= 1) {
        selector.getElementsByClassName('carrito-item-cantidad')[0].value = cantidadActual;
        actualizarTotalCarrito();
    }
}

// Eliminar item
function eliminarItemCarrito(event) {
    event.target.closest('.carrito-item').remove();
    actualizarTotalCarrito();
    ocultarCarrito();
}

// Ocultar carrito si está vacío
function ocultarCarrito() {
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    if (carritoItems.childElementCount == 0) {
        var carrito = document.getElementsByClassName('carrito')[0];
        carrito.style.marginRight = '-100%';
        carrito.style.opacity = '0';
        carritoVisible = false;

        var items = document.getElementsByClassName('contenedor-items')[0];
        items.style.width = '100%';
    }
}

// Actualizar total
function actualizarTotalCarrito() {
    var carritoItems = document.getElementsByClassName('carrito')[0].getElementsByClassName('carrito-item');
    var total = 0;

    for (var i = 0; i < carritoItems.length; i++) {
        var item = carritoItems[i];
        var precioElemento = item.getElementsByClassName('carrito-item-precio')[0];
        var precio = parseFloat(precioElemento.innerText.replace('$', '').replace('.', ''));
        var cantidad = parseInt(item.getElementsByClassName('carrito-item-cantidad')[0].value);
        total += precio * cantidad;
    }

    total = Math.round(total * 100) / 100;
    document.getElementsByClassName('carrito-precio-total')[0].innerText = '$' + total.toLocaleString("es") + ",00";
}

// Pagar (vaciar carrito)
function pagarClicked() {
    alert("Gracias por la compra");
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    while (carritoItems.hasChildNodes()) {
        carritoItems.removeChild(carritoItems.firstChild);
    }
    actualizarTotalCarrito();
    ocultarCarrito();
}
