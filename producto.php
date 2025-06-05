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
    <title>Productos</title>

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
                        <h4>Productos</h4>
                        <h6>Control de Productos de la Muebleria</h6>
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
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <a onclick="togglePopup()" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Nuevo Producto">
                                            <img src="assets/img/icons/boton-mas.png" alt="img">
                                        </a>
                                    </li>

                                    <li>
                                        <a onclick="togglePopupMarcas()" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Marca">
                                            <img src="assets/img/icons/lealtad-a-la-marca.png" alt="img">
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="togglePopupColores()" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Color"><img
                                                src="assets/img/icons/pintura.png" alt="img"></a>
                                    </li>
                                    <li>
                                        <a onclick="generarListaProductos()" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Exportar a Documento"><img
                                                src="assets/img/icons/sobresalir.png" alt="img"></a>
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
                                        <th>Clave Producto</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Color</th>
                                        <th>Contado</th>
                                        <th>Credi-Contado</th>
                                        <th>Credito</th>
                                        <th>Enganche</th>
                                        <th>Comision</th>
                                        <th>Categoria</th>
                                        <th>Eliminar</th>
                                        <th>Imagns.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require("conexion.php");

                                    // Recuperar datos del procedimiento almacenado
                                    $consulta1 = "CALL ObtenerProductos();";
                                    $ejecutarconsulta1 = mysqli_query($conexion, $consulta1);

                                    while ($tabla1 = mysqli_fetch_array($ejecutarconsulta1)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox"
                                                        onclick="togglePopupModificarProducto('<?php echo $tabla1[0]; ?>', 
                                                        '<?php echo $tabla1[1]; ?>', '<?php echo $tabla1[2]; ?>', '<?php echo $tabla1[3]; ?>', '<?php echo $tabla1[4]; ?>',
                                                        '<?php echo $tabla1[5]; ?>', '<?php echo $tabla1[6]; ?>', '<?php echo $tabla1[7]; ?>', '<?php echo $tabla1[8]; ?>', '<?php echo $tabla1[9]; ?>', '<?php echo $tabla1[10]; ?>')">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $tabla1[0]; ?></td>
                                            <td><?php echo $tabla1[1]; ?>     <?php echo $tabla1[3]; ?></td>
                                            <td><?php echo $tabla1[2]; ?></td>
                                            <td><?php echo $tabla1[4]; ?></td>
                                            <td><?php echo number_format($tabla1[5], 2, '.', ''); ?></td>
                                            <td><?php echo number_format($tabla1[6], 2, '.', ''); ?></td>
                                            <td><?php echo number_format($tabla1[7], 2, '.', ''); ?></td>
                                            <td><?php echo number_format($tabla1[8], 2, '.', ''); ?></td>
                                            <td><?php echo number_format($tabla1[9], 2, '.', ''); ?></td>
                                            <td><?php echo $tabla1[10]; ?></td>
                                            <td>
                                                <span class="badges bg-lightgreen" id="badgeEliminar">
                                                    <a href="#" id="btnEliminar"
                                                        onclick="togglePopupEliminarProducto('<?php echo $tabla1[0]; ?>')">ELIMINAR</a>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badges bg-lightgreen" id="badgeEliminar">
                                                    <a href="#" id="btnImagen"
                                                        onclick="togglePopupImagenes('<?php echo $tabla1[0]; ?>')">AGR.</a>
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

    <script src="assets/js/ventanas_productos_3.js"></script>
    <script src="assets/js/funciones_ad_2.js"></script>
    <script src="assets/js/agregar_productos_1.js"></script>
    <script src="assets/js/modificar_producto_3.js"></script>
    <script src="assets/js/eliminar_base_datos_2.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/eliminar_producto.js"></script>
    <script src="assets/js/crear_documento.js"></script>
    <script src="assets/js/imagenes.js"></script>


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

<div id="popup" class="popup">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="contenedor2">
            <div class="card">
                <div class="card-body">
                    <form id="formAgregarProducto">
                        <div class="page-title">
                            <h5>Agregar Producto</h5>
                            <h7>Registra Nuevo Producto</h7>
                        </div>
                        <br>
                        <!-- Copiado exactamente como tu formulario original -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Clave Producto</label>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-9">
                                            <div class="form-group">
                                                <input type="text" id="claveProducto1">
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1">
                                            <div class="form-group">
                                                <!-- Botón para generar la clave -->
                                                <button type="button" id="btnGenerar"
                                                    class="btn btn-primary custom-btn2" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Generar Clave"
                                                    onclick="generarClave()">GENERAR</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Nombre</label>
                                    <input type="text" id="nombreProducto1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Marca</label>
                                    <select id="ComboMarca" name="ComboMarca" class="form-select">
                                        <option value="seleccion" disabled selected>Seleccione una opción</option>
                                        <?php
                                        // Conexión a la base de datos
                                        require("conexion.php");
                                        // Ejecutar el procedimiento almacenado
                                        $query = "CALL ObtenerMarcas()";
                                        $resultado = mysqli_query($conexion, $query);
                                        // Verificar si hay resultados
                                        if (!$resultado) {
                                            echo "Error al ejecutar el procedimiento almacenado.";
                                            exit;
                                        }
                                        // Recorrer los resultados y generar las opciones del combobox
                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            echo '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
                                        }
                                        // Liberar los resultados y cerrar la conexión
                                        mysqli_free_result($resultado);
                                        mysqli_close($conexion);
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Caracteristicas</label>
                                    <input type="text" id="caracteristicas1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Color</label>
                                    <select id="ComboColor" name="ComboColor" class="form-select">
                                        <option value="seleccion" disabled selected>Seleccione una opción</option>
                                        <?php
                                        // Conexión a la base de datos
                                        require("conexion.php");
                                        // Ejecutar el procedimiento almacenado
                                        $query = "CALL obtenerColores()";
                                        $resultado = mysqli_query($conexion, $query);
                                        // Verificar si hay resultados
                                        if (!$resultado) {
                                            echo "Error al ejecutar el procedimiento almacenado.";
                                            exit;
                                        }
                                        // Recorrer los resultados y generar las opciones del combobox
                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            echo '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
                                        }
                                        // Liberar los resultados y cerrar la conexión
                                        mysqli_free_result($resultado);
                                        mysqli_close($conexion);
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Precio Credito</label>
                                    <input type="text" id="precioCredito1" placeholder="Ingrese Precio Crédito">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Credi-Contado</label>
                                    <input type="text" id="crediContado1" placeholder="Credito Contado" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Contado</label>
                                    <input type="text" id="contado1" placeholder="Contado" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Enganche</label>
                                    <input type="text" id="enganche1" placeholder="Enganche" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Comision</label>
                                    <input type="text" id="comision1" placeholder="Comisión" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Categoria</label>
                                    <select id="ComboCategoria" name="ComboCategoria" class="form-select">
                                        <option value="seleccion" disabled selected>Seleccione una opción</option>
                                        <?php
                                        // Conexión a la base de datos
                                        require("conexion.php");
                                        // Ejecutar el procedimiento almacenado
                                        $query = "CALL ObtenerClasificaciones();";
                                        $resultado = mysqli_query($conexion, $query);
                                        // Verificar si hay resultados
                                        if (!$resultado) {
                                            echo "Error al ejecutar el procedimiento almacenado.";
                                            exit;
                                        }
                                        // Recorrer los resultados y generar las opciones del combobox
                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            echo '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
                                        }
                                        // Liberar los resultados y cerrar la conexión
                                        mysqli_free_result($resultado);
                                        mysqli_close($conexion);
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                                <div class="form-group">
                                    <button type="button" id="closePopup" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><img
                                            src="./assets/img/cancelar.png" alt=""></button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                                <div class="form-group">
                                    <button type="submit" id="btnGuardar" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Guardar"
                                        onclick="guardarProducto(event)">
                                        <img src="./assets/img/guardar-el-archivo.png" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popupmarcas" class="popup" style="display: none;">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="card">
            <div class="card-body">
                <div class="page-title">
                    <h5>Marcas</h5>
                    <h7>Gestión de Marcas</h7>
                </div>
                <div class="scroll-container">
                    <div class="table-responsive1">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Clave Marca</th>
                                    <th>Marca</th>
                                    <th>ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require("conexion.php");
                                // Recuperar datos del procedimiento almacenado
                                $consulta1 = "CALL ObtenerMarcas();";
                                $ejecutarconsulta1 = mysqli_query($conexion, $consulta1);

                                while ($tabla1 = mysqli_fetch_array($ejecutarconsulta1)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox"
                                                    onclick="togglePopupModificarMarca('<?php echo $tabla1[0]; ?>', '<?php echo $tabla1[1]; ?>')">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td><?php echo $tabla1[0]; ?></td>
                                        <td><?php echo $tabla1[1]; ?></td>
                                        <td>
                                            <span class="badges bg-lightgreen">
                                                <a href="#"
                                                    onclick="togglePopupEliminarMarca('<?php echo $tabla1[0]; ?>')">ELIMINAR</a>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label style="font-weight: normal">Nueva Marca</label>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="form-group">
                                <input type="text" id="nuevaMarca">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="button" id="closePopupmarcas" class="btn btn-primary "
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar">
                                    <img src="./assets/img/cancelar.png" alt=""></button>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Guardar" onclick="guardarMarca(event)">
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

<div id="popupcolores" class="popup" style="display: none;">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="card">
            <div class="card-body">
                <div class="page-title">
                    <h5>Colores</h5>
                    <h7>Gestión de Colores</h7>
                </div>
                <div class="scroll-container">
                    <div class="table-responsive1">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Clave Color</th>
                                    <th>Color</th>
                                    <th>ELIMINAR</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require("conexion.php");
                                // Recuperar datos del procedimiento almacenado
                                $consulta2 = "CALL obtenerColores();";
                                $ejecutarconsulta2 = mysqli_query($conexion, $consulta2);

                                while ($tabla2 = mysqli_fetch_array($ejecutarconsulta2)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox"
                                                    onclick="togglePopupModificarColor('<?php echo $tabla2[0]; ?>', '<?php echo $tabla2[1]; ?>')">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td><?php echo $tabla2[0]; ?></td>
                                        <td><?php echo $tabla2[1]; ?></td>
                                        <td>
                                            <span class="badges bg-lightgreen">
                                                <a href="#"
                                                    onclick="togglePopupEliminarColor('<?php echo $tabla2[0]; ?>')">ELIMINAR</a>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label style="font-weight: normal">Nueva Color</label>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="form-group">
                                <input type="text" id="nuevoColor">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="button" id="closePopupColores" class="btn btn-primary "
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><img
                                        src="./assets/img/cancelar.png" alt=""></button>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Guardar" onclick="guardarColor(event)">
                                    <img src="./assets/img/guardar-el-archivo.png" alt=""></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popupnuevamarca" class="popup" style="display: none;">
    <div class="popup-content">
        <div class="contenedor3">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Modificar Marca</h5>
                        <h7>Modifica la Marca</h7>
                    </div>
                    <br>
                    <!-- Formulario para modificar marca -->
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <div class="form-group">
                                <label style="font-weight: normal">Id Marca</label>
                                <input type="text" name="idmodificarMarca" id="idmodificarMarca1" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Marca</label>
                                <input type="text" name="modificarMarca" id="modificarMarca1">
                            </div>
                        </div>
                    </div>
                    <!-- Botones de Cancelar y Guardar -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="button" id="closePopupProducto" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar">
                                    <img src="./assets/img/cancelar.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Guardar" onclick="actualizarMarca(event)">
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

<div id="popupnuevacolor" class="popup" style="display: none;">
    <div class="popup-content">
        <div class="contenedor3">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Modificar Color</h5>
                        <h7>Modifica el Color</h7>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Id.Color</label>
                                <input type="text" name="iColor1" id="idmodificarColor">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Color</label>
                                <input type="text" name="Color1" id="modificarColor">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="button" id="closePopupColor" class="btn btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar">
                                    <img src="./assets/img/cancelar.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="button" id="saveColor" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Guardar">
                                    <img src="./assets/img/guardar-el-archivo.png" alt=""
                                        onclick="actualizarColor(event)">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="popupModificarProducto" class="popup">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="contenedor2">
            <div class="card">
                <div class="card-body">
                    <div class="page-title">
                        <h5>Modificar Producto</h5>
                        <h7>Modifica el Producto</h7>
                    </div>
                    <br>
                    <!-- Copiado exactamente como tu formulario original -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Clave Producto</label>
                                <input type="text" id="claveProducto" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Nombre</label>
                                <input type="text" id="nombreProducto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label style="font-weight: normal">Marca</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" id="marca" class="input-color" placeholder="Marca" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select id="ComboMarcaMod" name="ComboMarcaMod" class="form-select input-color"
                                    onchange="updateTextMarca()">
                                    <option value="seleccion" selected>Seleccione una opción</option>
                                    <!-- Opción inicial -->
                                    <?php
                                    // Conexión a la base de datos
                                    require("conexion.php");
                                    // Ejecutar el procedimiento almacenado
                                    $query = "CALL ObtenerMarcas()";
                                    $resultado = mysqli_query($conexion, $query);
                                    // Verificar si hay resultados
                                    if (!$resultado) {
                                        echo "Error al ejecutar el procedimiento almacenado.";
                                        exit;
                                    }
                                    // Recorrer los resultados y generar las opciones del combobox
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $fila[1] . '">' . $fila[1] . '</option>';
                                    }
                                    // Liberar los resultados y cerrar la conexión
                                    mysqli_free_result($resultado);
                                    mysqli_close($conexion);
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label style="font-weight: normal">Caracteristicas</label>
                                <input type="text" id="caracteristicas">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label style="font-weight: normal">Color</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" id="color" class="input-color" placeholder="Color" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select id="ComboColorMod" name="ComboColorMod" class="form-select input-color"
                                    onchange="updateTextColor()">
                                    <option value="seleccion" selected>Seleccione una opción</option>
                                    <!-- Opción inicial -->
                                    <?php
                                    // Conexión a la base de datos
                                    require("conexion.php");
                                    // Ejecutar el procedimiento almacenado
                                    $query = "CALL obtenerColores()";
                                    $resultado = mysqli_query($conexion, $query);
                                    // Verificar si hay resultados
                                    if (!$resultado) {
                                        echo "Error al ejecutar el procedimiento almacenado.";
                                        exit;
                                    }
                                    // Recorrer los resultados y generar las opciones del combobox
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $fila[1] . '">' . $fila[1] . '</option>';
                                    }
                                    // Liberar los resultados y cerrar la conexión
                                    mysqli_free_result($resultado);
                                    mysqli_close($conexion);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Precio Contado</label>
                                <input type="text" id="precioContado" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: normal">Credi-Contado</label>
                                <input type="text" id="crediContado" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Credito</label>
                                <input type="text" id="credito">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Enganche</label>
                                <input type="text" id="enganche" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: normal">Comision</label>
                                <input type="text" id="comision" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label style="font-weight: normal">Categoria</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" id="categoria" class="input-color" placeholder="Categoria" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select id="ComboCategoriaMod" name="ComboCategoriaMod" class="form-select input-color"
                                    onchange="updateTextCategoria()">
                                    <option value="seleccion" selected>Seleccione una opción</option>
                                    <!-- Opción inicial -->
                                    <?php
                                    // Conexión a la base de datos
                                    require("conexion.php");
                                    // Ejecutar el procedimiento almacenado
                                    $query = "CALL ObtenerClasificaciones();";
                                    $resultado = mysqli_query($conexion, $query);
                                    // Verificar si hay resultados
                                    if (!$resultado) {
                                        echo "Error al ejecutar el procedimiento almacenado.";
                                        exit;
                                    }
                                    // Recorrer los resultados y generar las opciones del combobox
                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $fila[1] . '">' . $fila[1] . '</option>';
                                    }
                                    // Liberar los resultados y cerrar la conexión
                                    mysqli_free_result($resultado);
                                    mysqli_close($conexion);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="buttonEliminarCa" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupModifiP">
                                    <img src="./assets/img/cancelar.png" alt=""></button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Guardar" onclick="actualizarProducto(event)">
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

<div id="popupEliminarProducto" class="popup" style="display: none;">
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
                            <center><label id="productoIdLabel" class="form-label">ID Producto:</label></center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Eliminar Permanetemente" id="btnEliminarProducto">
                                    <img src="./assets/img/borrar.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupEliminarCa">
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

<div id="popupEliminarMarca" class="popup" style="display: none;">
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
                            <center><label id="marcaIdLabel" class="form-label">Id Marca:</label></center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Eliminar Permanetemente" id="btnEliminarMarca">
                                    <img src="./assets/img/borrar.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupEliminarMa">
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

<div id="popupEliminarColor" class="popup" style="display: none;">
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
                            <center><label id="colorIdLabel" class="form-label">Id Marca:</label></center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Eliminar Permanetemente" id="btnEliminarColor">
                                    <img src="./assets/img/borrar.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupEliminarCo">
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


<div id="popupImagen" class="popup">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="contenedor2">
            <div class="card">
                <div class="card-body">
                    <form id="formSubirImagenes">
                        <div class="page-title">
                            <h5>Agregar Imágenes</h5>
                            <h7>Selecciona y sube una imagen para el producto</h7>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Clave del Producto</label>
                                    <input type="text" class="input-color form-control" id="claveProductoInput"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Imagen 1</label>
                                    <input class="form-control" type="file" id="imagenProducto1" name="imagenProducto[]"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Imagen 2</label>
                                    <input class="form-control" type="file" id="imagenProducto2" name="imagenProducto[]"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Imagen 3</label>
                                    <input class="form-control" type="file" id="imagenProducto3" name="imagenProducto[]"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-weight: normal">Imagen 4</label>
                                    <input class="form-control" type="file" id="imagenProducto4" name="imagenProducto[]"
                                        accept="image/*">
                                </div>
                            </div>
                            <center>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary">SUBIR IMAGENES</button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <button type="button" class="btn btn-primary" id="closePopupImagenes">CANCELAR</button>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>