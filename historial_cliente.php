<?php
include('conexion.php');

// Obtener el token desde la URL
$token = isset($_GET['token']) ? $_GET['token'] : '';

// Verificar si el token está vacío
if (empty($token)) {
    mostrarAccesoNoAutorizado();
    exit;
}

// Prevenir inyección (aunque ya lo pasas como parámetro)
$token = mysqli_real_escape_string($conexion, $token);

// Llamar al procedimiento con el token
$consulta = "CALL obtener_venta_por_token('$token')";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si se obtuvo resultado
if (!$resultado || mysqli_num_rows($resultado) == 0) {
    mostrarAccesoNoAutorizado();
    exit;
}

// --- Aquí continuarías con la lógica normal si el token es válido ---
// $fila = mysqli_fetch_array($resultado);
// etc...

// Función para mostrar mensaje de acceso no autorizado
function mostrarAccesoNoAutorizado() {
    echo "<script>alert('No se encontró ninguna venta con ese token.');</script>";
    echo "
    <div style='
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-family: Arial, sans-serif;
        padding: 20px;
        color: #333;
    '>
        <img src='./assets/img/ilegal.png' alt='Acceso ilegal' style='width: 600px; max-width: 100%;'><br>
        <img src='./assets/img/logo_santana_dd1.png' alt='Logo' style='width: 300px;'><br>

        <div style='max-width: 800px;'>
            <h2 style='color: red;'>⚠️ Acceso no autorizado</h2>
            <p>Hemos detectado un intento de acceder a información que <strong>no está vinculada al enlace autorizado de tu historial de cliente</strong>.</p>
            <p>Este sistema está diseñado para proteger la privacidad de los datos. Cualquier intento de manipular el enlace, cambiar el token o acceder a información de otros clientes será <strong>registrado automáticamente</strong>.</p>
            <p><strong>Consecuencias de este intento:</strong></p>
            <ul style='text-align: left; display: inline-block;'>
                <li>El intento ha sido registrado con tu dirección IP.</li>
                <li>Se notificará al administrador del sistema.</li>
                <li>En caso de reincidencia, podrías quedar <strong>bloqueado permanentemente</strong> del sistema.</li>
            </ul>
            <p>Si crees que esto fue un error, por favor contacta al administrador para mayor información.</p>
        </div>
    </div>";
}




// Obtener la fila de datos
$fila = mysqli_fetch_array($resultado);

// Extraer datos según posición o por nombre
$clave = $fila[0];
$total = $fila[11];

// Aquí puedes continuar usando $fila para mostrar los demás datos
?>



<script>
const idVenta = <?php echo $clave; ?>;
const total = <?php echo $total; ?>;
</script>


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
    <title>Detalle</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_santana_mobile.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style_ventana.css">
    <link rel="stylesheet" href="assets/css/estilo3.css">
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
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <?php include('conexion.php'); ?>
                    <ul>
                        <button class="categoria-btn" data-id="' . $id . '"><?php echo $fila[1] ?></button>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content">
                <div class="contenedor2">
                    <div class="card">
                        <div class="card-body">
                            <div class="page-title">
                                <h5>Historial y Detalles de la Venta</h5>
                                <h7>Detalles de la venta del Cliente y su Historial de Abonos dado</h7>
                            </div>
                            <br>
                            <!-- Copiado exactamente como tu formulario original -->
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Clave de la Venta</label>
                                        <input type="text" id="claveVenta" value="<?php echo $clave ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Nombre de Cliente</label>
                                        <input type="text" id="nombreCliente" value="<?php echo $fila[1] ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Fecha de Credito</label>
                                        <input type="text" id="fecha1" value="<?php echo $fila[2] ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Fecha de Cre-Contado</label>
                                        <input type="text" id="fecha2" value="<?php echo $fila[3] ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Fecha de Contado</label>
                                        <input type="text" id="fecha3" value="<?php echo $fila[4] ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Total</label>
                                        <input type="text" id="total" value="<?php echo number_format($fila[11], 2); ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Abonado</label>
                                        <input type="text" id="abonado"
                                            value="<?php echo number_format($fila[8], 2); ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Restante</label>
                                        <input type="text" id="restante"
                                            value="<?php echo number_format($fila[9], 2); ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Precio de Credito</label>
                                        <input type="text" id="preciocredito"
                                            value="<?php echo number_format($fila[5], 2); ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Precio de Credi-Contado</label>
                                        <input type="text" id="preciocredicontado"
                                            value="<?php echo number_format($fila[6], 2); ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Precio de Contado</label>
                                        <input type="text" id="preciocontado"
                                            value="<?php echo number_format($fila[7], 2); ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">Pago Minimo</label>
                                        <input type="text" id="preciocredito"
                                            value="<?php echo number_format($fila[10], 2); ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="font-weight: normal">DIA DE PAGO</label>
                                        <input type="text" id="preciocredicontado" value="<?php echo $fila[12]; ?>"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label style="font-weight: normal">Lista de Productos Comprados</label>
                                <div class="table-responsive">
                                    <table class="table productosVenta">
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
                                <label style="font-weight: normal">Historial de Anticipos</label>
                                <div class="table-responsive7">
                                    <table class="table detalleAbonos">
                                        <thead>
                                            <tr>
                                                <th>Fecha de Registro</th>
                                                <th>Cantidad Abonada</th>
                                                <th>Restante</th>
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


    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/detalle_cliente.js"></script>
</body>

</html>