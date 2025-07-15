<?php
// SIEMPRE inicia la sesión al principio de cualquier script PHP que vaya a usar $_SESSION
session_start();

// Incluimos el archivo global.php para poder usar las constantes (como PRO_NOMBRE)
// La ruta es ../config/global.php porque login.php está en vistas/ y global.php está en config/
require_once "../config/global.php";

// Definimos un título para esta página de login, usando la constante de PRO_NOMBRE
$titulo_pagina = "Iniciar Sesión - " . PRO_NOMBRE;

// --- Lógica para mostrar mensajes de error/éxito desde el controlador ---
$mostrar_mensaje_error = false;
$mensaje_error = "";
if (isset($_SESSION['mensaje_error'])) {
    $mensaje_error = $_SESSION['mensaje_error'];
    $mostrar_mensaje_error = true;
    unset($_SESSION['mensaje_error']); // Limpiamos el mensaje de la sesión
}

$mostrar_mensaje_exito = false;
$mensaje_exito = "";
if (isset($_SESSION['mensaje_exito'])) {
    $mensaje_exito = $_SESSION['mensaje_exito'];
    $mostrar_mensaje_exito = true;
    unset($_SESSION['mensaje_exito']); // Limpiamos el mensaje de la sesión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>

    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/font-awesome.css">

    <link rel="stylesheet" href="../public/css/AdminLTE.min.css"> 

    <link rel="stylesheet" href="../public/css/style_login.css">

    <link rel="shortcut icon" href="../public/img/favicon.ico">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Proyecto</b>Final</a> </div>
        <div class="login-box-body">
            <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>

            <?php
            // Mostrar mensajes de alerta de Bootstrap
            if ($mostrar_mensaje_error):
            ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    <?php echo $mensaje_error; ?>
                </div>
            <?php
            endif;
            if ($mostrar_mensaje_exito):
            ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Éxito!</h4>
                    <?php echo $mensaje_exito; ?>
                </div>
            <?php
            endif;
            ?>

            <form action="../controladores/UsuarioController.php?op=login" method="POST">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- O -</p>
                <a href="registro.php" class="btn btn-block btn-social btn-facebook btn-flat">
                    <i class="fa fa-user-plus"></i> Regístrate aquí
                </a>
            </div>
            </div>
        </div>
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
    <script src="../public/js/app.js"></script> </body>
</html>