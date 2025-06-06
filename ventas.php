<?php
session_start();
// Verificar si la sesión de usuario no está activa
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a signin.php
    header("Location: catalogo.php");
    exit(); // Asegurar que el script se detenga después de la redirección
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Ventas</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_santana_mobile.jpg">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style_ventana.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style3.css">
    <link rel="stylesheet" href="assets/css/style4.css">
    <link rel="stylesheet" href="assets/css/style8.css">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo_santana_dd1.png" alt="">
                </a>
                <a href="index.html" class="logo-small">
                    <img src="assets/img/logo_santana_mobile.jpg" alt="">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <script>
                var usuario = "<?php echo $_SESSION['usuario']; ?>";
            </script>
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="assets/img/usuario.png" alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <hr class="m-0">
                            <a class="dropdown-item" onclick="togglePopupUsuarios(usuario)"> <i class="me-2"
                                    data-feather="user"></i> My
                                Perfil</a>
                            <a class="dropdown-item logout pb-0" onclick="cerrarSesion()"><img
                                    src="assets/img/icons/log-out.svg" class="me-2" alt="img">Cerrar Sesion</a>
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" onclick="togglePopupUsuarios(usuario)">My Perfil</a>
                    <a class="dropdown-item" onclick="cerrarSesion()">Cerrar Sesion</a>
                </div>
            </div>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <script>
                        var usuarioRol = <?php echo $_SESSION["rol"]; ?>;
                    </script>
                    <ul>
                        <li>
                            <a href="index.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                    Inicio</span> </a>
                        </li>
                        <li class="submenu" id="productos4">
                            <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>
                                    Productos</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="producto.php">Gestion de Productos</a></li>
                                <li><a href="juegos.php">Juegos</a></li>
                            </ul>
                        </li>
                        <li class="submenu" id="clientes4">
                            <a href="javascript:void(0);"><img src="assets/img/icons/cliente.png" alt="img"><span>
                                    Clientes</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="clientes.php">Gestion de Clientes</a></li>
                            </ul>
                        </li>
                        <li class="submenu" id="Contabilidad4">
                            <a href="javascript:void(0);"><img src="assets/img/icons/contabilidad.png" alt="img"><span>
                                    Contabilidad</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="ventas.php">Ventas</a></li>
                                <li><a href="creditos.php">Creditos/Bonos</a></li>
                                <li><a href="deudores.php">Deudores</a></li>
                                <li><a href="compras.php">Compras</a></li>
                            </ul>
                        </li>
                        <li class="submenu" id="colaboradores4">
                            <a href="javascript:void(0);"><img src="assets/img/icons/agregar-usuario.png"
                                    alt="img"><span>
                                    Usuarios</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="colaboradores.php">Colaboradores</a></li>
                                <li><a href="rutas_cobro.php">Rutas de Cobro</a></li>
                            </ul>
                        </li>
                        <li class="submenu" id="sucursales4">
                            <a href="javascript:void(0);"><img src="assets/img/icons/sucursales.png" alt="img"><span>
                                    Sucursales</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="sucursales.php">Gestion de Sucursales</a></li>
                            </ul>
                        </li>
                        <li class="submenu" id="bodegas4">
                            <a href="javascript:void(0);"><img src="assets/img/icons/bodega (1).png" alt="img"><span>
                                    Bodegas</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="bodegas.php">Gestion de Bodegas</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Ventas</h4>
                        <h6>Registra y gestiona transacciones de ventas rápidamente.</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="search-set">
                                <div class="search-path">
                                    <a class="btn btn-filter" id="filter_search">
                                        <img src="assets/img/icons/filter.svg" alt="img">
                                    </a>
                                </div>
                                <div class="search-input">
                                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                            alt="img"></a>
                                </div>
                            </div>
                            <script>
                                var usuarioRol = <?php echo $_SESSION["rol"]; ?>;
                            </script>
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <a onclick="redirecttoVenta()" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Nuevo Venta">
                                            <img src="assets/img/icons/boton-mas.png" alt="img">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>ID. Venta</th>
                                        <th>Cliente Que Realizo la Venta</th>
                                        <th>F.L Contado</th>
                                        <th>F.L Credi-Contado</th>
                                        <th>F.L Credito</th>
                                        <th>Total</th>
                                        <th>Abonado</th>
                                        <th>Restante</th>
                                        <th>Enganche Total</th>
                                        <th>Enganche Prop.</th>
                                        <th>Tipo de Pago</th>
                                        <th>Dar de Baja</th>
                                        <th>Enganche</th>
                                        <th>Ticket de Venta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require("conexion.php");

                                    // Recuperar datos del procedimiento almacenado
                                    $consulta1 = "CALL obtener_ventas_clientes();";
                                    $ejecutarconsulta1 = mysqli_query($conexion, $consulta1);

                                    while ($tabla1 = mysqli_fetch_array($ejecutarconsulta1)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox"
                                                        onclick="togglePopupDetalleVenta('<?php echo $tabla1[0]; ?>','<?php echo $tabla1[1]; ?>','<?php echo $tabla1[2]; ?>','<?php echo $tabla1[3]; ?>','<?php echo $tabla1[15]; ?>','<?php echo $tabla1[5]; ?>','<?php echo $tabla1[6]; ?>','<?php echo $tabla1[7]; ?>','<?php echo $tabla1[8]; ?>','<?php echo $tabla1[9]; ?>',)">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $tabla1[0]; ?></td>
                                            <td><?php echo $tabla1[1]; ?> <?php echo $tabla1[2]; ?>
                                                <?php echo $tabla1[3]; ?>
                                            </td>
                                            <td><?php echo $tabla1[5]; ?></td>
                                            <td><?php echo $tabla1[6]; ?></td>
                                            <td><?php echo $tabla1[7]; ?></td>
                                            <td><?php echo number_format($tabla1[15], 2); ?></td>
                                            <td><?php echo number_format($tabla1[8], 2); ?></td>
                                            <td><?php echo number_format($tabla1[9], 2); ?></td>
                                            <td><?php echo number_format($tabla1[17], 2); ?></td>
                                            <td><?php echo number_format($tabla1[18], 2); ?></td>
                                            <td><?php echo $tabla1[16]; ?></td>
                                            <td>
                                                <span class="badges bg-lightgreen" id="badgeEliminar">
                                                    <a href="#"
                                                        onclick="togglePopupEliminarVenta('<?php echo $tabla1[0]; ?>')">ELIMINAR</a>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badges bg-lightgreen boton-enganche" id="badgeEnganche">
                                                    <a href="#"
                                                        onclick="toggleEnganche('<?php echo $tabla1[0]; ?>')">AÑADIR</a>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badges bg-lightgreen">
                                                    <a href="#" onclick="generarTicketVenta(
                                                        '<?php echo $tabla1[0]; ?>',  // ID de venta
                                                        '<?php echo $tabla1[1]; ?>',  // Nombre
                                                        '<?php echo $tabla1[2]; ?>',  // Apellido Paterno
                                                        '<?php echo $tabla1[3]; ?>',  // Apellido Materno
                                                        '<?php echo $tabla1[15]; ?>', // Total
                                                        '<?php echo $tabla1[8]; ?>',  // Abonado
                                                        '<?php echo $tabla1[9]; ?>'   // Restante
                                                    )">DESCARGAR</a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/activar_ventanas.js"></script>
    <script src="assets/js/agregar_base_datos_2.js"></script>
    <script src="assets/js/modificar_base_datos_2.js"></script>
    <script src="assets/js/eliminar_base_datos_2.js"></script>
    <script src="assets/js/ventas.js"></script>
    <script src="assets/js/detalle_venta_5.js"></script>
    <script src="assets/js/dirigir_actualizar_ventana.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/eliminar_venta.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/ticket_3.js"></script>
    <script src="assets/js/deudores.js"></script>
    <script src="assets/js/enganche4.js"></script>


    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>





<div id="popupDetalleVenta" class="popup">
    <div class="popup-content2">
        <!-- Tu formulario original -->
        <div class="contenedor2">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Detalle de Venta</h5>
                        <h7>Detalles de la venta del Cliente</h7>
                    </div>
                    <br>
                    <!-- Copiado exactamente como tu formulario original -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label style="font-weight: normal">Clave de la Venta</label>
                                <input type="text" id="claveVenta" disabled>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="form-group">
                                <label style="font-weight: normal">Nombre de Cliente</label>
                                <input type="text" id="nombreCliente" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Fecha de Credito</label>
                                <input type="text" id="fecha1" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Fecha de Cre-Contado</label>
                                <input type="text" id="fecha2" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Fecha de Contado</label>
                                <input type="text" id="fecha3" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Total</label>
                                <input type="text" id="total" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Abonado</label>
                                <input type="text" id="abonado" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Restante</label>
                                <input type="text" id="restante" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Enganche dado</label>
                                <input type="text" id="enganche" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Parciales</label>
                                <input type="text" id="parciales" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label style="font-weight: normal">Lista de Productos Comprados</label>
                        <div class="table-responsive">
                            <table class="table productosVenta">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>Clave Producto</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="buttonEliminarCa" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupDetalleVenta">
                                    <img src="./assets/img/cancelar.png" alt=""></button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Actualizar Venta" onclick="redirectToGestionVenta()">
                                    <img src="./assets/img/ventas.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Añadir a Deudores" onclick="actualizarStatusVenta()">
                                    <img src="./assets/img/deuda.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popupEliminarVenta" class="popup" style="display: none;">
    <div class="popup-content1">
        <div class="contenedor4">
            <div class="card">
                <div class="card-body">
                    <div class="page-title d-flex justify-content-center align-items-center">
                        <h7>¿QUÉ QUIERES HACER?</h7>
                    </div>
                    <br>
                    <!-- Mostrar el ID del producto -->
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <center><label id="ventaLabel" class="form-label">Id Venta:</label></center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Eliminar Permanetemente" id="btnEliminarVenta">
                                    <img src="./assets/img/borrar.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupEliminarVenta">
                                    <img src="./assets/img/cancelado.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popupAnadirEnganche" class="popup" style="display: none;">
    <div class="popup-content1">
        <div class="contenedor4">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Agregar Enganche</h5>
                        <h7>Ingresa el monto del enganche para completar el pago requerido.</h7>
                    </div>
                    <br>
                    <!-- Mostrar el ID del producto -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Clave de la Venta</label>
                                <input type="text" id="claveVentaEnganche" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Fecha</label>
                                <input type="date" class="form-control" id="fechaEnganche" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label style="font-weight: normal">Añadir Enganche</label>
                                <input type="number" class="form-control" id="Enganche3">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <center><button type="submit" class="btn btn-primary" id="btnEliminarVenta" onclick="agregarEnganche()">AGREGAR</button></center>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <center><button type="button" class="btn btn-primary" id="closePopupAnadirEnganche">CANCELAR</button></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="Usuario" class="popup">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="contenedor2">
            <div class="card">
                <div class="card-body">
                    <form id="formAgregarProducto">
                        <div class="page-title">
                            <h5>Informacion de Usuario</h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Nombre del Empleado</label>
                                    <input type="text" id="nombreu" placeholder="Nombre" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Rol del Empleado</label>
                                    <input type="text" id="rolu" placeholder="Rol" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                                <div class="form-group">
                                    <button type="button" id="closePopupUusario" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><img
                                            src="./assets/img/cancelar.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>