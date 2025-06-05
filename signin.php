<?php
session_start();

// Verificar si la sesión de usuario está activa
if (isset($_SESSION['usuario'])) {
    // Si la sesión está activa, redirigir al usuario a index.php
    header("Location: index.php");
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
    <title>Iniciar Sesion</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_santana_mobile.jpg">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="assets/img/logo_santana_dd1.png" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Iniciar Secion</h3>
                            <h4>Porfavor Acceda a Su Cuenta</h4>
                        </div>
                        <div class="form-login">
                            <label>Usuario</label>
                            <div class="form-addons">
                                <input type="text" id="usuario" placeholder="Ingresa tu Usuario">
                            </div>
                        </div>
                        <div class="form-login">
                            <label>Contraseña</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input" id="contrasena" placeholder="Ingresa tu contraseña">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <a class="btn btn-login" onclick="iniciodeSecion()">Acceder</a>
                        </div>
                        <div class="signinform text-center">
                            <a href="#" onclick="olvide_contrasena()" class="hover-a">Olvidate tu Contraseña?</a>
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="assets/img/blp_muebles_salamodu_0424.avif" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/inicio_secion.js"></script>
    <script src="assets/js/mayusculas.js"></script>
    <script src="assets/js/olvide_contrasena_2.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>