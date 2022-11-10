
<div class="app-header__logo">
    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    <div class="logo-src"></div>
    <div class="header__pane ms-auto">
        <div>
            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
</div>
<div class="app-header__mobile-menu">
    <div>
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
</div>
<div class="app-header__menu">
    <span>
        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
                <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
        </button>
    </span>
</div>
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu Principal</li>
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "1"){ ?>
                <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','formulario.php')">
                        <i class="metismenu-icon pe-7s-study"></i>
                        FORMULARIO
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "1"){ ?>
                <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','edicionElimin.php')">
                        <i class="metismenu-icon pe-7s-study"></i>
                        EDICION/ELIMINACION
                    </a>
                </li>
            <?php } ?>
                <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','busquedaGenero.php')">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        CONSULTA DE LIBROS
                    </a>
                </li>

            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-server"></i>
                    LISTA DE PRUEBA
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a onclick="cargarcontenido('ContenedorPrincipal','vistaLibros.php')">
                            <i class="metismenu-icon"></i>
                            CONSULTA DE LIBROS - OLD
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-id"></i>
                    CUENTA
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a onclick="cargarcontenido('ContenedorPrincipal','cuenta.php')">
                            <i class="metismenu-icon"></i>
                            CONFIGURACION
                        </a>
                    </li>
                    <li>
                        <a onclick="cargarcontenido('ContenedorPrincipal','cerrarSesion.php')">
                            <i class="metismenu-icon"></i>
                            CERRAR SESIÓN
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>