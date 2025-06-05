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
    <title>Creditos</title>

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
    <link rel="stylesheet" href="assets/css/style11.css">
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
                            <a class="dropdown-item" onclick="togglePopupUsuarios(usuario)"> <i class="me-2" data-feather="user"></i> My
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
                        <h4>Creditos/Bonos</h4>
                        <h6>Registro de créditos donde se reflejan los pagos parciales realizados por los clientes, permitiendo un seguimiento detallado del saldo pendiente.</h6>
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
                        </div>

                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th>ID de la Venta</th>
                                        <th>Cliente Que Realizo la Venta</th>
                                        <th>Total</th>
                                        <th>F.Limite Contado</th>
                                        <th>F.Limite Credi-Contado</th>
                                        <th>F.Limite Credito</th>
                                        <th>Abonado</th>
                                        <th>Restante</th>
                                        <th>Total de abonos</th>
                                        <th>Agregar Anticipo</th>
                                        <th>Detalle</th>
                                        <th>Estado de Cuenta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require("conexion.php");

                                    // Recuperar datos del procedimiento almacenado
                                    $consulta1 = "CALL obtener_ventas();";
                                    $ejecutarconsulta1 = mysqli_query($conexion, $consulta1);

                                    while ($tabla1 = mysqli_fetch_array($ejecutarconsulta1)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $tabla1[0]; ?></td>
                                            <td><?php echo $tabla1[1]; ?> <?php echo $tabla1[2]; ?> <?php echo $tabla1[3]; ?></td>
                                            <td><?php echo $tabla1[15]; ?></td>
                                            <td><?php echo $tabla1[5]; ?></td>
                                            <td><?php echo $tabla1[6]; ?></td>
                                            <td><?php echo $tabla1[7]; ?></td>
                                            <td><?php echo $tabla1[8]; ?></td>
                                            <td><?php echo $tabla1[9]; ?></td>
                                            <td><?php echo $tabla1[17]; ?></td>
                                            <td>
                                                <span class="badges bg-lightgreen" id="badgeDetalle">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar Anticipo" onclick="togglePopupDetalleVenta('<?php echo $tabla1[0]; ?>','<?php echo $tabla1[1]; ?>','<?php echo $tabla1[2]; ?>','<?php echo $tabla1[3]; ?>','<?php echo $tabla1[4]; ?>','<?php echo $tabla1[5]; ?>','<?php echo $tabla1[6]; ?>','<?php echo $tabla1[7]; ?>','<?php echo $tabla1[8]; ?>','<?php echo $tabla1[9]; ?>',)"><img src="./assets/img/abonado.png" alt=""></a>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badges bg-lightgreen" id="badgeDetalle">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Historial de Anticipos" onclick="togglePopupHistoriaAbonos('<?php echo $tabla1[0]; ?>','<?php echo $tabla1[1]; ?>','<?php echo $tabla1[2]; ?>','<?php echo $tabla1[3]; ?>','<?php echo $tabla1[15]; ?>')"><img src="./assets/img/detalle.png" alt=""></a>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badges bg-lightgreen">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Estado de Cuenta" onclick="generarEstadodeCuenta('<?php echo $tabla1[0]; ?>', '<?php echo $tabla1[1]; ?>', '<?php echo $tabla1[2]; ?>', '<?php echo $tabla1[3]; ?>')">
                                                        <img src="./assets/img/factura.png" alt="">
                                                    </a>
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
    <script src="assets/js/detalle_anticipo_5.js"></script>
    <script src="assets/js/dirigir_actualizar_ventana.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/ticket_3.js"></script>

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
                        <h5>Agregar Anticipo</h5>
                        <h7>Registro de pagos adelantados aplicados a una compra o crédito</h7>
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
                                <label style="font-weight: normal">Total Credito</label>
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
                                <input type="text" id="restante" style="background-color:rgb(137, 186, 216);" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Total Contado</label>
                                <input type="text" id="totalcont3" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Total Credi-Contado</label>
                                <input type="text" id="totalcredicon3" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label style="font-weight: normal">Historial de Abonos</label>
                        <div class="table-responsive">
                            <table class="table productosVenta">
                                <thead>
                                    <tr>
                                        <th>Clave de Producto</th>
                                        <th>Nombre del Producto</th>
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
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <div class="form-group">
                                <label style="font-weight: normal">Agregar Anticipo</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <input type="number" class="form-control" id="abono1">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Agregar Anticipo"
                                    onclick="imprimirValores()">
                                    <img src="./assets/img/agregar-pago.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="buttonEliminarCa" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar" id="closePopupDetalleVenta">
                                    <img src="./assets/img/cancelar.png" alt=""></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Actualizar Pago por Contado"
                                    onclick="actualizarContado()">ACTUALIZAR POR CONTADO
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="buttonEliminarCa" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar Pago por Credi-Contado" id="closePopupDetalleVenta"
                                    onclick="actualizarCrediContado()">ACTUALIZAR POR CREDI-CONTADO</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="HistorialAbonos" class="popup">
    <div class="popup-content2">
        <!-- Tu formulario original -->
        <div class="contenedor2">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Historial de Abonos</h5>
                        <h7>Detalle de Todos Los abonos Realizados por el Cliente</h7>
                    </div>
                    <br>
                    <!-- Copiado exactamente como tu formulario original -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label style="font-weight: normal">Clave de la Venta</label>
                                <input type="text" id="claveVenta2" disabled>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="form-group">
                                <label style="font-weight: normal">Nombre de Cliente</label>
                                <input type="text" id="nombreCliente2" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label style="font-weight: normal">Historial de Anticipos</label>
                        <div class="table-responsive7">
                            <table class="table detalleAbonos">
                                <thead>
                                    <tr>
                                        <th>Fecha de Registro</th>
                                        <th>Cantidad Abonada</th>
                                        <th>Restante</th>
                                        <th>Eliminar Registro</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Total</label>
                                <input type="text" id="total2" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Abonado</label>
                                <input type="text" id="abonado2" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Restante</label>
                                <input type="text" id="restante2" disabled>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="buttonEliminarCa" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar" id="closePopupHistorialAbonos">
                                    <img src="./assets/img/cancelar.png" alt=""></button>
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
                                    <button type="button" id="closePopupUusario" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><img src="./assets/img/cancelar.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>