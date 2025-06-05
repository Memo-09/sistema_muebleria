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
    <title>Colaboradores</title>

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
    <link rel="stylesheet" href="assets/css/style13.css">
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
                        <h4>Empleados</h4>
                        <h6>Gestión de empleados: registra, actualiza y administra la información del personal de manera eficiente.</h6>
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
                                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                                </div>
                            </div>
                            <script>
                                var usuarioRol = <?php echo $_SESSION["rol"]; ?>;
                            </script>
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <a onclick="togglePopupRegistrarColaborador()" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Nuevo Colaborador">
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
                                        <th>Clave Colaborador</th>
                                        <th>Nombre Completo</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require("conexion.php");

                                    // Recuperar datos del procedimiento almacenado
                                    $consulta1 = "CALL obtener_colaboradores();";
                                    $ejecutarconsulta1 = mysqli_query($conexion, $consulta1);

                                    while ($tabla1 = mysqli_fetch_array($ejecutarconsulta1)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox"
                                                        onclick="togglePopupActualizarColaborador('<?php echo $tabla1[0]; ?>', '<?php echo $tabla1[1]; ?>','<?php echo $tabla1[2]; ?>', '<?php echo $tabla1[3]; ?>')">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $tabla1[0]; ?></td>
                                            <td><?php echo $tabla1[1] . " " . $tabla1[2] . " " . $tabla1[3]; ?> </td>
                                            <td>
                                                <span class="badges bg-lightgreen">
                                                    <a href="#" onclick="togglePopupEliminarColaborador('<?php echo $tabla1[0]; ?>')">ELIMINAR</a>
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
    <script src="assets/js/eliminar_colaborador.js"></script>
    <script src="assets/js/gestion_colaborador_4.js"></script>
    <script src="assets/js/dirigir_ventanas.js"></script>
    <script src="assets/js/dirigir_ventanas_2.js"></script>
    <script src="assets/js/funciones_colaborador.js"></script>
    <script src="assets/js/f_2.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/cerrar_sesion.js"></script>
    <script src="assets/js/ocultar_elementos_4.js"></script>
    <script src="assets/js/usuarios.js"></script>


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



<div id="popupActualizarColaborador" class="popup">
    <script>
        var usuarioRol = <?php echo $_SESSION["rol"]; ?>;
    </script>

    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="contenedor3">
            <div class="card">
                <div class="card-body">
                    <form id="formActualizarEmpleado">
                        <div class="page-title">
                            <h5>Actualizar Sucursal</h5>
                            <h7>Actualizar datos del Colaborador</h7>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Clave del Colaborador</label>
                                    <input type="text" id="claveContador" placeholder="Clave" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Nombre del Colaborador</label>
                                    <input type="text" id="nombreContador" placeholder="Nombre">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Apellido Paterno</label>
                                    <input type="text" id="apellido1Contador" placeholder="Apellido Paterno">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-weight: normal">Apellido Materno</label>
                                    <input type="text" id="apellido2Contador" placeholder="Apellido Materno">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label style="font-weight: normal">Rol del Empleado</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" id="descripcionRolEmpleado" placeholder="Apellido Paterno" disabled style="background-color: #90EE90;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select id="ComboRolColaboradorMod" name="ComboMarcaMod" class="form-select">
                                        <option value="seleccion" selected>Seleccione una opción</option>
                                        <!-- Opción inicial -->
                                        <?php
                                        // Conexión a la base de datos
                                        require("conexion.php");
                                        // Ejecutar el procedimiento almacenado
                                        $query = "SELECT * FROM roles;";
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
                                    <button type="button" id="closePopupColaborador" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><img
                                            src="./assets/img/cancelar.png" alt=""></button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                                <div class="form-group">
                                    <button type="submit" id="btnGuardarMod" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Guardar"
                                        onclick="actualizarColaborador(event)">
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

<div id="popupAgregarColaborador" class="popup">
    <div class="popup-content">
        <!-- Tu formulario original -->
        <div class="contenedor3">
            <div class="card">
                <div class="card-body">
                    <form id="formAgregarEmpleado">
                        <div class="page-title">
                            <h5>Agregar Empleado</h5>
                            <h7>Agrega un nuevo empleado ingresando su información</h7>
                        </div>
                        <br>
                        <div class="informacion">
                            <label style="font-weight: normal">Informacion Principal</label>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Nombre del Colaborador</label>
                                        <input type="text" id="nombreContador1" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Apellido Paterno</label>
                                        <input type="text" id="apellido1Contador1" placeholder="Apellido Paterno">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Apellido Materno</label>
                                        <input type="text" id="apellido2Contador1" placeholder="Apellido Materno">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Rol a Asignar</label>
                                        <select id="ComboRolColaborador" name="ComboMarcaMod" class="form-select">
                                            <option value="seleccion" selected>Seleccione una opción</option>
                                            <!-- Opción inicial -->
                                            <?php
                                            // Conexión a la base de datos
                                            require("conexion.php");
                                            // Ejecutar el procedimiento almacenado
                                            $query = "SELECT * FROM roles;";
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
                        <div class="datosdeacceso">
                            <label style="font-weight: normal">Datos de Acceso</label>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Usuario(CURP)</label>
                                        <input type="text" id="usuario" placeholder="Usuario">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Contraseña</label>
                                        <div class="password-container col-lg-12 col-md-12 col-sm-12">
                                            <input type="password" id="contrasenia" placeholder="Password" disabled>
                                            <span class="toggle-password" onclick="togglePassword()">🔒</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                                <div class="form-group">
                                    <button type="button" id="closePopupColaboradorIn" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><img
                                            src="./assets/img/cancelar.png" alt=""></button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                                <div class="form-group">
                                    <button type="submit" id="btnGuardar" class="btn btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Guardar"
                                        onclick="agregarColaborador(event)">
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



<div id="popupEliminarColaborador" class="popup" style="display: none;">
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <center><label id="colaboradorlIdLabel" class="form-label">Clave Colaborador:</label></center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Dar de Baja Sucursal" id="btnEliminarColaborador">
                                    <img src="./assets/img/borrar.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Cancelar" id="closePopupEliminarCol">
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