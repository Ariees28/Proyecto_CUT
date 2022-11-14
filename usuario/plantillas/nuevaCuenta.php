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
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <div class="h-100 d-md-flex d-sm-block bg-white justify-content-center align-items-center col-md-12 col-lg-7">
                    <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                        <div class="app-logo"></div>
                        <h4>
                            <div>BIENVENIDO,</div>
                            <span>Solo te tomará <span class="text-success">unos momentos</span> crear tu cuenta nueva</span>
                        </h4>
                        <div>
                            <form class="" id="formNuevoUs">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="email" class=""><span class="text-danger">*</span> Email</label>
                                            <input name="email" id="email" placeholder="Email aquí..." type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="nombre" class=""><span class="text-danger">*</span> Nombre</label>
                                            <input name="text" id="nombre" placeholder="Tu Nombre Aquí..." type="text" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="nombre" class=""><span class="text-danger">*</span> Usuario</label>
                                            <input name="text" id="usuario" placeholder="Tu Usuario Aquí..." type="text" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="contra" class=""><span class="text-danger">*</span> Contraseña</label>
                                            <input name="contra" id="contra" placeholder="Contraseña aquí..." type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="contraRep" class=""><span class="text-danger">*</span> Repite tu contraseña</label>
                                            <input name="contraRep" id="contraRep" placeholder="Repite tu contraseña aquí" type="password" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 position-relative form-check">
                                    <button class="btn-wide btn-pill btn-shadow btn btn-primary btn-lg" id="crear" type="submit">Crear Cuenta</button>
                                </div>
                                <div class="mt-4 d-flex align-items-center">
                                    <h5 class="mb-0">¿Ya tienes cuenta? <a href="../login.php">Inicia Sesión</a></h5>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="d-lg-flex d-xs-none col-lg-5">
                    <div class="slider-light">
                        <div class="slick-slider slick-initialized">
                            <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('../images/originals/abstract2.jpg');"></div>
                                    <div class="slider-content">
                                        <h3>Ingresa a nuestra comunidad de lectores</h3>
                                        <p>Busca libros que siempre quisiste leer, encuentra nuevos gustos y solicita prestamos para ampliar tus conocimientos en los temas en los que te quieras volver un experto.
                                        </p>
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

<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg>

<script src="../js/creados/nuevaCuenta.js"></script>
