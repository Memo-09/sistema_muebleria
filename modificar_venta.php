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
    <title>Actualizar Venta</title>

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
    <link rel="stylesheet" href="assets/css/style9.css">
    <link rel="stylesheet" href="assets/css/style12.css">
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
                        <h4>Actualizar Venta</h4>
                        <h6>Actualiza la Venta del Cliente</h6>
                    </div>
                </div>
                <?php
                    include('conexion.php');
                    $claveVenta = $_GET['id'];
                    $sql = "CALL detalleVenta(?)";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("i", $claveVenta);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $nombreCliente = $row['NOMBRE'] . " " . $row['AP_P'] . " " . $row['AP_M'];
                    $totalVentaCredito = $row['TOTAL_VENTA_CREDITO'];
                    $fechaContado = $row['FECHA_CONTADO'];
                    $fechaCrediContado = $row['FECHA_CREDI_CONTADO'];
                    $fechaCredito = $row['FECHA_CREDITO'];
                    $totalCrediContado = $row['TOTAL_CREDI_CONTADO'];
                    $totalContado = $row['TOTAL_CONTADO'];
                    $abonado = $row['ABONADO'];
                    $restante = $row['RESTANTE'];
                    $pagoMinimo = $row['PAGO_MINOMO'];
                    $pagoMax = $row['PAGO_MAX'];
                    $dia = $row['DESCRIPCION_DIA'];
                    $tipoPago = $row['DESCRIPCION_TIPOPAGO'];
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="actualizarCantidad">
                                    <label style="font-weight: normal">Actualizar Productos Vendidos</label>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Id Venta</label>
                                                <!-- Cuadro de texto para búsqueda -->
                                                <input type="text" id="clave" class="form-control"
                                                    placeholder="Nombre de Cliente" value="<?php echo $claveVenta; ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Cliente</label>
                                                <!-- Cuadro de texto para búsqueda -->
                                                <input type="text" id="nombre" class="form-control"
                                                    placeholder="Nombre de Cliente"
                                                    value="<?php echo $nombreCliente; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <label style="font-weight: normal">Productos Seleccionados</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive6">
                                            <table class="table ventas">
                                                <thead>
                                                    <tr>
                                                        <th>Clave Producto</th>
                                                        <th>Nombre Completo</th>
                                                        <th>Credito</th>
                                                        <th>Id del Almacen</th>
                                                        <th>Cantidad</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    require("conexion.php");

                                                    // Recuperar datos del procedimiento almacenado
                                                    $consulta1 = "CALL ObtenerProductosVenta($claveVenta);";
                                                    $ejecutarconsulta1 = mysqli_query($conexion, $consulta1);

                                                    while ($tabla1 = mysqli_fetch_array($ejecutarconsulta1)) {
                                                        ?>
                                                    <tr>
                                                        <td><?php echo $tabla1[0]; ?></td>
                                                        <td><?php echo $tabla1[1]; ?> <?php echo $tabla1[2]; ?> MARCA:
                                                            <?php echo $tabla1[3]; ?> COLOR: <?php echo $tabla1[4]; ?>
                                                        </td>
                                                        <td><?php echo $tabla1[5]; ?></td>
                                                        <td><?php echo $tabla1[6]; ?></td>
                                                        <td><input type="number" name="cantidad" class="form-control"
                                                                style="width: 70px;" value="<?php echo $tabla1[7]; ?>"
                                                                disabled></td>
                                                        <td><a href="#"
                                                                class="btn btn-success btn-sm fw-bold eliminar-venta">ELIMINAR</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Credito</label>
                                                <input type="text" id="credito1" placeholder="Credito"
                                                    style="background-color: #90EE90;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Cre-Contado</label>
                                                <input type="text" id="crediContado1" placeholder="Credi-Contado"
                                                    style="background-color: #90EE90;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Contado</label>
                                                <input type="text" id="contado1" placeholder="Contado"
                                                    style="background-color: #90EE90;" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Fecha Limite de Contado</label>
                                                <input type="text" id="fecha3" placeholder="Fecha de Contado"
                                                    style="background-color: lightblue;"
                                                    value="<?php echo $fechaContado; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Fecha Limite de Credi-Contado</label>
                                                <input type="text" id="fecha2" placeholder="Fecha Credi-Contado"
                                                    style="background-color: lightblue;"
                                                    value="<?php echo $fechaCrediContado; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Fecha Limite de Credito</label>
                                                <input type="text" id="fecha1" placeholder="Fecha de Credito"
                                                    style="background-color: lightblue;"
                                                    value="<?php echo $fechaCredito; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Enganche</label>
                                                <input type="text" id="Enganche1" placeholder="Enganche"
                                                    style="background-color: #FFCC80;" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Opcion Adicional</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="toggleRebajaActualizar">
                                                        <label class="form-check-label" for="toggleRebajaActualizar">Precio por
                                                            rebaja</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" id="creditoEscritoActualizar" placeholder="Precio"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="toggleCargoAdicionalActualizar">
                                                        <label class="form-check-label" for="toggleCargoAdicionalActualizar">Cargo
                                                            Adicional</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" id="cargoAdicionalActualizar"
                                                            placeholder="Añadir Cargo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <button type="button" id="agregarCargoActualizar"
                                                            class="btn btn-primary">AGREGAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="detalleVenta">
                                    <label style="font-weight: normal">Actualizar Informacion Base de Venta</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Pago Semanal Minimo</label>
                                                <input type="text" id="cantidad1" placeholder="Pago Minimo"
                                                    value="<?php echo $pagoMinimo; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Pago Maximo Semanal</label>
                                                <input type="text" id="cantidad2" placeholder="Pago Maximo"
                                                    style="background-color: #FFCC80;" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="font-weight: normal">Abono</label>
                                                <input type="text" id="enganche"
                                                    placeholder="Enganche aportado por Cliente"
                                                    value="<?php echo $abonado; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label style="font-weight: normal">Dia de Pago</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" id="diaMod" placeholder="Pago Minimo"
                                                    value="<?php echo $dia; ?>" disabled
                                                    style="background-color: #FFE5E5;">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div class="form-group">
                                                <select id="Combodia" name="Combodia" class="form-select">
                                                    <option value="seleccion" disabled selected>Seleccione una opción
                                                    </option>
                                                    <?php
                                                    // Conexión a la base de datos
                                                    require("conexion.php");
                                                    // Ejecutar el procedimiento almacenado
                                                    $query = "SELECT * FROM dias;";
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
                                        <label style="font-weight: normal">Tipo de Pago</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" id="pagoMod" placeholder="Pago Minimo"
                                                    value="<?php echo $tipoPago; ?>" disabled
                                                    style="background-color: #FFE5E5;">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div class="form-group">
                                                <select id="ComboTipoPago" name="Combodia" class="form-select">
                                                    <option value="seleccion" disabled selected>Seleccione una opción
                                                    </option>
                                                    <?php
                                                    // Conexión a la base de datos
                                                    require("conexion.php");
                                                    // Ejecutar el procedimiento almacenado
                                                    $query = "SELECT * FROM tipo_pago;";
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
                                        <div
                                            class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                                            <div class="form-group">
                                                <button type="button" id="saveColor" class="btn btn-primary"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Actualizar Informacion Base">
                                                    <img src="./assets/img/guardar-el-archivo.png" alt=""
                                                        onclick="actualizarVentaDatosA()">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label style="font-weight: normal">Lista de Productos</label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <select id="ComboSucursalProducto" name="ComboColabaorador" class="form-select"
                                            onchange="mostrarProductosSucursal()">
                                            <option value="seleccion" disabled selected>Seleccione una opción</option>
                                            <?php
                                            // Conexión a la base de datos
                                            require("conexion.php");
                                            // Ejecutar el procedimiento almacenado
                                            $query = "CALL ObtenerSucursalesBodegas();";
                                            $resultado = mysqli_query($conexion, $query);
                                            // Verificar si hay resultados
                                            if (!$resultado) {
                                                echo "Error al ejecutar el procedimiento almacenado.";
                                                exit;
                                            }
                                            // Recorrer los resultados y generar las opciones del combobox
                                            while ($fila = mysqli_fetch_array($resultado)) {
                                                echo '<option value="' . $fila[0] . '">' . $fila[1] . ' ' . $fila[2] . '</option>';
                                            }
                                            // Liberar los resultados y cerrar la conexión
                                            mysqli_free_result($resultado);
                                            mysqli_close($conexion);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="buscarprod" placeholder="Buscar Producto....">
                                    </div>
                                </div>
                                <div class="table-responsive6">
                                    <table class="table productos">
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
                                                <th>Credito</th>
                                                <th>Existencias</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/script_modificar_venta_5.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/otras_funciones_actualizar_venta.js"></script>

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