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
    <title>Nueva Venta</title>

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
                        <h4>Nueva Venta</h4>
                        <h6>Registra rápidamente una nueva venta, productos y detalles de pago</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Cliente</label>
                                    <!-- Cuadro de texto para búsqueda -->
                                    <!-- Cuadro de texto para búsqueda -->
                                    <input type="text" id="buscarCliente" class="form-control"
                                        placeholder="Escribe para buscar cliente..." onkeyup="buscarClientes()">
                                    <br>
                                    <!-- ComboBox (select) para mostrar las opciones -->
                                    <select id="ComboCliente" name="ComboCliente" class="form-select">
                                        <option value="seleccion" disabled selected>Seleccione un cliente</option>
                                        <?php
                                        // Conexión a la base de datos
                                        require("conexion.php");
                                        // Ejecutar el procedimiento almacenado
                                        $query = "CALL ObtenerClientes();";
                                        $resultado = mysqli_query($conexion, $query);
                                        // Verificar si hay resultados
                                        if (!$resultado) {
                                            echo "Error al ejecutar el procedimiento almacenado.";
                                            exit;
                                        }
                                        // Recorrer los resultados y generar las opciones en el select
                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            echo '<option value="' . $fila[0] . '">' . $fila[0] . ' ' . $fila[1] . ' ' . $fila[2] . ' ' . $fila[3] . '</option>';
                                        }
                                        // Liberar los resultados y cerrar la conexión
                                        mysqli_free_result($resultado);
                                        mysqli_close($conexion);
                                        ?>
                                    </select>
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
                                            <input type="text" id="crediContado1" placeholder="Credito Contado"
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
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label style="font-weight: normal">Fecha de Registro</label>
                                        <div class="form-group">
                                            <input type="text" id="fechaactual" placeholder="Fecha de Registro"
                                                style="background-color: lightcoral;" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="fecha" name="fecha"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Fecha Limite de Contado</label>
                                            <input type="text" id="fecha3" placeholder="Fecha de Contado"
                                                style="background-color: lightblue;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <label style="font-weight: normal">F. Limite de Credi-Contado</label>
                                            <input type="text" id="fecha2" placeholder="Fecha Credi-Contado"
                                                style="background-color: lightblue;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Fecha Limite de Credito</label>
                                            <input type="text" id="fecha1" placeholder="Fecha de Credito"
                                                style="background-color: lightblue;" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Pago Semanal Minimo</label>
                                            <input type="number" class="form-control" id="cantidad1"
                                                placeholder="Pago Minimo">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Pago Maximo Semanal</label>
                                            <input type="text" id="cantidad2" placeholder="Pago Maximo"
                                                style="background-color: #FFCC80;" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Enganche</label>
                                            <input type="number" class="form-control" id="enganche"
                                                placeholder="Enganche">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Enganche total</label>
                                            <input type="number" class="form-control" id="enganche_total"
                                                placeholder="Enganche total">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Parciales</label>
                                            <select id="ComboParcial" name="ComboParcial" class="form-select">
                                                <option value="seleccion" disabled selected>Seleccione</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Dia de Pago</label>
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
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Tipo de Pago</label>
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
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: normal">Opcion Adicional</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="toggleRebaja">
                                                    <label class="form-check-label" for="toggleRebaja">Precio con rebaja
                                                        o cargo adicional</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <input type="text" id="creditoEscrito" placeholder="Precio"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div
                                        class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                                        <div class="form-group">
                                            <button type="button" id="saveColor" class="btn btn-primary"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Guardar">
                                                <img src="./assets/img/guardar-el-archivo.png" alt=""
                                                    onclick="enviarDatos()">
                                            </button>
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
                                            <?php

                                            ?>
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

    <script src="assets/js/activar_ventanas.js"></script>
    <script src="assets/js/agregar_base_datos_2.js"></script>
    <script src="assets/js/modificar_base_datos_2.js"></script>
    <script src="assets/js/eliminar_base_datos_2.js"></script>
    <script src="assets/js/funcion_adicional_venta_3.js"></script>
    <script src="assets/js/script_producto_venta_2.js"></script>
    <script src="assets/js/alamcenar_venta_6.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/fechas_anteriores.js"></script>
    <script src="assets/js/otras_funciones_sistema.js"></script>

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