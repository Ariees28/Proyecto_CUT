<?php 
session_start(); 
session_destroy();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Login Biblioteca</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="BIBLIOTECA ANDROMEDA">
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" href="./vendors/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="./vendors/ionicons-npm/css/ionicons.css">
        <link rel="stylesheet" href="./vendors/linearicons-master/dist/web-font/style.css">
        <link rel="stylesheet" href="./vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css">
        <link href="./styles/css/base.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    </head> 
    <body>
        <div class="app-container app-theme-white body-tabs-shadow">
            <div class="app-container">
                <div class="h-100">
                    <div class="h-100 g-0 row">
                        <div class="d-none d-lg-block col-lg-4">
                            <div class="slider-light">
                                <div class="slick-slider">
                                    <div>
                                        <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                            <div class="slide-img-bg" style="background-image: url('images/originals/abstract5.jpg');"></div>
                                            <div class="slider-content">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                            <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                                <div class="app-logo"></div>
                                <h4 class="mb-0">
                                    <span class="d-block">BIENVENIDO</span>
                                    <span>Ingrese Sus Credenciales de Acceso</span>
                                </h4>
                                <div class="divider row"></div>
                                <div>
                                    <form action="" class="form" method="post" id="frmAcceso">
                                        <div class="">
                                            <div class="col-md-6">
                                                <div class="position-relative mb-3">
                                                    <label for="exampleEmail" class="form-label">Ingrese Usuario</label>
                                                    <input name="text" id="exampleEmail"
                                                        placeholder="Usuario" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative mb-3">
                                                    <label for="examplePassword" class="form-label">Contraseña </label>
                                                    <input name="password" id="examplePassword"
                                                        placeholder="Clave de acceso" type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider row"></div>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-auto">
                                                <button type="submit" class="btn btn-primary btn-lg">Ingreso</button>
                                            </div>
                                        </div>
                                    </form>
                                    <br><br><br><br><br>
        <div class="divider"></div>
        <div id="nuevo">
            <label>¿ERES NUEVO? <a href="plantillas/nuevaCuenta.php">Crea una cuenta</a></label><br><br>
        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- plugin dependencies -->
        <script type="text/javascript" src="./vendors/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="./vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="./vendors/slick-carousel/slick/slick.min.js"></script>
        <!-- custome.js -->
        <script type="text/javascript" src="./js/carousel-slider.js"></script>
        <!-- .js  especifico-->
        <script type="text/javascript" src="./js/creados/ingreso.js"></script>
    </body>
</html>
