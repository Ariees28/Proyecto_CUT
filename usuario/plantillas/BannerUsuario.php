<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>BIBLIOTECA</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./../vendors/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./../vendors/ionicons-npm/css/ionicons.css">
    <link rel="stylesheet" href="./../vendors/linearicons-master/dist/web-font/style.css">
    <link rel="stylesheet" href="./../vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css">
    <link href="./../styles/css/base.css" rel="stylesheet">
</head>

<body>

    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
            <?php
require_once "cabecera.php";
?>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <?php
require_once "Menu.php";
?>
            </div>
            <div class="app-main__outer">

                <?php
require_once "ContenedorEscritorio.php";
?>
            </div>
        </div>
    </div>
    <?php
require_once "hamburguesa2.php"
?>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    <!-- plugin dependencies -->
    <?php
require_once "librerias.php";
?>
    <script type="text/javascript" src="./../js/creados/contenidoPrincipal.js"></script>
</body>

</html>