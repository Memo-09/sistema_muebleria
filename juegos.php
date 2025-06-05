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
    <title>Juegos</title>

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
                        <h4>Gestion de Juegos</h4>
                        <h6>Crea y personaliza los juegos solicitados por el cliente</h6>
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
                                        <a onclick="redirecttoJuego()" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Realizar Nuevo Juego">
                                            <img src="assets/img/juegos-de-cartas.png" alt="img">
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="generarListaJuegos()" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Imprimir Lista de Contenido de los Juegos">
                                            <img src="assets/img/pdf.png" alt="img">
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="generarListaDetalladaJuegos()" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Imprimir Lista de Juegos">
                                            <img src="assets/img/lista-de-la-compra.png" alt="img">
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
                                        <th>Clave Producto de Juego</th>
                                        <th>Nombre de Juego</th>
                                        <th>Contado</th>
                                        <th>Credi-Contado</th>
                                        <th>Credito</th>
                                        <th>Enganche</th>
                                        <th>Comision</th>
                                        <th>Existencias</th>
                                        <th>Agregar Existencias</th>
                                        <th>Dar de Baja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require("conexion.php");

                                    // Recuperar datos del procedimiento almacenado
                                    $consulta1 = "CALL productosJuegos();";
                                    $ejecutarconsulta1 = mysqli_query($conexion, $consulta1);

                                    while ($tabla1 = mysqli_fetch_array($ejecutarconsulta1)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox"
                                                        onclick="togglePopupDetalleJuego('<?php echo $tabla1[1]; ?>','<?php echo $tabla1[2]; ?>')">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $tabla1[0]; ?></td>
                                            <td><?php echo $tabla1[1]; ?> <?php echo $tabla1[2]; ?></td>
                                            <td><?php echo number_format($tabla1[3], 2, '.', ','); ?></td>
                                            <td><?php echo number_format($tabla1[4], 2, '.', ','); ?></td>
                                            <td><?php echo number_format($tabla1[5], 2, '.', ','); ?></td>
                                            <td><?php echo number_format($tabla1[6], 2, '.', ','); ?></td>
                                            <td><?php echo number_format($tabla1[7], 2, '.', ','); ?></td>
                                            <td><?php echo $tabla1[9]; ?></td>
                                            <td>
                                                <span class="badges bg-lightgreen" id="badgeActualizae">
                                                    <a href="#"
                                                        onclick="toglepopupExistencias('<?php echo $tabla1[0]; ?>','<?php echo $tabla1[9]; ?>')">AGRERAR</a>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badges bg-lightgreen" id="badgeEliminar">
                                                    <a href="#"
                                                        onclick="eliminarJuego('<?php echo $tabla1[1]; ?>','<?php echo $tabla1[2]; ?>')">ELIMINAR</a>
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
    <script src="assets/js/juegos.js"></script>
    <script src="assets/js/detalle_venta_3.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/eliminar_juego_5.js"></script>
    <script src="assets/js/detalle_juego_3.js"></script>
    <script src="assets/js/documento_juegos.js"></script>
    <script src="assets/js/agregar_existencias.js"></script>


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





<div id="popupDetalleJuego" class="popup">
    <div class="popup-content2">
        <!-- Tu formulario original -->
        <div class="contenedor2">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Detalle de Juego</h5>
                        <h7>Detalles de la venta del Cliente</h7>
                    </div>
                    <br>
                    <!-- Copiado exactamente como tu formulario original -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label style="font-weight: normal">Id de Juego</label>
                                <input type="text" id="idJuego" disabled>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="form-group">
                                <label style="font-weight: normal">Nombre del Juego</label>
                                <input type="text" id="nombreJuego" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Credito</label>
                                <input type="text" id="creditoJuego" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Credi-Contado</label>
                                <input type="text" id="crediContadoJuego" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Contado</label>
                                <input type="text" id="contadojuego" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Enganche</label>
                                <input type="text" id="enganche" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Comision</label>
                                <input type="text" id="comision" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label style="font-weight: normal">Lista de Productos que Pertenecen al Juego</label>
                        <div class="table-responsive">
                            <table class="table productosJuego2">
                                <thead>
                                    <tr>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="buttonEliminarCa" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupJuego">
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


<div id="popupAgregarExistencias" class="popup">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="contenedor">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Detalle de Juego</h5>
                        <h7>Detalles de la venta del Cliente</h7>
                    </div>
                    <br>
                    <!-- Copiado exactamente como tu formulario original -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Id de Juego</label>
                                <input type="text" id="idJuego2" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Agrega Existencias</label>
                                <input type="text" id="existencias2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="buttonEliminarCa" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar" id="closePopupJuegoExistencias">
                                    <img src="./assets/img/cancelar.png" alt=""></button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Guardar"
                                    onclick="actualizarExistencias(event)">
                                    <img src="./assets/img/guardar-el-archivo.png" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>