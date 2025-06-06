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
    <title>Muebleria Santana Sanchez</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_santana_mobile.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style_ventana.css">
    <link rel="stylesheet" href="assets/css/estilo2.css">
    <link rel="stylesheet" href="assets/css/estilo3.css">
    <link rel="stylesheet" href="assets/css/estilo4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="assets/img/usuario.png" alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="signin.php"><img src="assets/img/iniciar-sesion.png" class="me-2" alt="img">Iniciar Secion</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="signin.php">Iniciar Secion</a>
                </div>
            </div>

        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <?php include('conexion.php'); ?>
                    <ul>
                        <?php
                        $consulta = "CALL obtener_clasificaciones()";
                        $resultado = mysqli_query($conexion, $consulta);

                        while ($fila = mysqli_fetch_row($resultado)) {
                            $descripcion = htmlspecialchars($fila[0]); // DESCRIPCION_CLASIFICACION
                            $id = $fila[1]; // ID_CLASIFICACION

                            echo '
                            <li>
                                <button class="categoria-btn" data-id="' . $id . '">
                                    <img src="assets/img/sofa.png" alt="img" style="width:16px; height:16px; vertical-align:middle; margin-right:5px;">
                                    ' . $descripcion . '
                                </button>
                            </li>
                        ';
                        }
                        ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>



    <div class="page-wrapper">
        <div class="content">
            <section class="contenedor">
                <!-- Contenedor de elementos -->
                <div class="contenedor-items">
                </div>
                <!-- Carrito de Compras -->
                <div class="carrito" id="carrito">
                    <div class="header-carrito">
                        <h2>Tu Carrito</h2>
                    </div>

                    <div class="carrito-items">
                        <!-- 
                <div class="carrito-item">
                    <img src="img/boxengasse.png" width="80px" alt="">
                    <div class="carrito-item-detalles">
                        <span class="carrito-item-titulo">Box Engasse</span>
                        <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="1" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                        <span class="carrito-item-precio">$15.000,00</span>
                    </div>
                   <span class="btn-eliminar">
                        <i class="fa-solid fa-trash"></i>
                   </span>
                </div>
                <div class="carrito-item">
                    <img src="img/skinglam.png" width="80px" alt="">
                    <div class="carrito-item-detalles">
                        <span class="carrito-item-titulo">Skin Glam</span>
                        <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                        <span class="carrito-item-precio">$18.000,00</span>
                    </div>
                   <button class="btn-eliminar">
                        <i class="fa-solid fa-trash"></i>
                   </button>
                </div>
                 -->
                    </div>
                    <div class="carrito-total">
                        <div class="fila">
                            <strong>Total Credito</strong>
                            <span class="carrito-precio-credito"></span>
                        </div>
                        <div class="fila">
                            <strong>Total Credi-Contado</strong>
                            <span class="carrito-precio-credcont"></span>
                        </div>
                        <div class="fila">
                            <strong>Total Contado</strong>
                            <span class="carrito-precio-contado"></span>
                        </div>
                        <button class="btn-pagar" data-tipo="credito">Pagar por Precio de Credito <i class="fa-solid fa-bag-shopping"></i> </button>
                        <br>
                        <button class="btn-pagar" data-tipo="credicontado">Pagar por Precio de Credi-Contado <i class="fa-solid fa-bag-shopping"></i> </button>
                        <br>
                        <button class="btn-pagar" data-tipo="contado">Pagar por Precio de Contado <i class="fa-solid fa-bag-shopping"></i> </button>
                    </div>
                </div>
            </section>
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
    <script src="assets/js/obtener_productos_categoria.js"></script>
</body>

</html>