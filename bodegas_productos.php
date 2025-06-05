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
    <title>Insertar a Bodega</title>

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
    <link rel="stylesheet" href="assets/css/style5.css">
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
                        <h4>Insertar Productos a Bodega</h4>
                        <h6>Inserta los Productos que Contendra la Nueva Bodega</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <?php
                            // Recuperar los parámetros enviados por la URL
                            $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
                            $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
                            ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Id Bodega</label>
                                        <input type="text" id="claveBodega" value="<?php echo $id ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Ubicación Bodega</label>
                                        <input type="text" id="ubicacion" value="<?php echo $name ?>" readonly>
                                    </div>
                                </div>
                            </div>
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
                            <table class="table datanew" id="tabla1">
                                <thead>
                                    <tr>
                                        <th>Asignar</th>
                                        <th>Clave Producto</th>
                                        <th>Nombre Producto</th>
                                        <th>Credito</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require("conexion.php");

                                    // Recuperar datos del procedimiento almacenado
                                    $consulta2 = "CALL ObtenerProductosSucursal();";
                                    $ejecutarconsulta2 = mysqli_query($conexion, $consulta2);

                                    while ($tabla3 = mysqli_fetch_array($ejecutarconsulta2)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox" class="asignar-checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $tabla3[0]; ?></td>
                                            <td><?php echo $tabla3[1].",".$tabla3[2].",MARCA ".$tabla3[3]; ?></td>
                                            <td><?php echo "$" . $tabla3[4]; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button type="submit" id="btnGuardar" class="btn btn-primary" onclick="AgregarTodosLosProductos2()">AGREGAR TODOS LOS PRODUCTOS</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h7>Lista de Productos por su Bodega</h7>
                        <div class="table-responsive2">
                            <table class="table" id="tabla2">
                                <thead>
                                    <tr>
                                        <th>Clave Producto</th>
                                        <th>Nombre Producto</th>
                                        <th>Credito</th>
                                        <th>Existencias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                                <div class="form-group">
                                    <button type="submit" id="btnGuardar" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Guardar Productos en la Bodega"
                                        onclick="guardarProductoBodega()">
                                        <img src="./assets/img/guardar-el-archivo.png" alt=""></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/producto_bodega.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/funcion_tabla.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/agregar_todos_productos.js"></script>

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