<?php
// SIEMPRE inicia la sesión al principio de cualquier script PHP que vaya a usar $_SESSION
session_start();

// Incluimos el archivo global.php para poder usar las constantes (como PRO_NOMBRE)
// La ruta es ../config/global.php porque login_header.php está en vistas/ y global.php está en config/
require_once "../config/global.php";

// Definimos un título para esta página de login, usando la constante de PRO_NOMBRE
$titulo_pagina = "Iniciar Sesión - " . PRO_NOMBRE;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>

    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/font-awesome.css">

    <link rel="stylesheet" href="../public/css/style_login.css">

    <link rel="shortcut icon" href="../public/img/favicon.ico">
</head>
<body class="hold-transition login-page">