
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
            <li class="app-sidebar__heading">
                <i class="metismenu-icon pe-7s-expand1"></i>
                Menu Principal
            </li>
            <li>
                <a onclick="cargarcontenido('ContenedorPrincipal','ContenedorEscritorio.php')">
                    <i class="metismenu-icon pe-7s-study"></i>
                    MENÚ PRINCIPAL
                </a>
            </li>
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
                <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','formulario.php')">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        NUEVO LIBRO
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
                <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','edicionElimin.php')">
                        <i class="metismenu-icon pe-7s-note"></i>
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
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-add-user"></i>
                    CREACION DE USUARIOS
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
                    <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','nuevoUsuario.php')">
                        <i class="metismenu-icon"></i>
                        NUEVO USUARIO
                    </a>
                    </li>
                    <?php } ?>

                    <?php if($_SESSION['tipo'] == "0"){ ?>
                    <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','eliminarUsuario.php')">
                        <i class="metismenu-icon"></i>
                        ELIMINAR/EDITAR USUARIO
                    </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-plugin"></i>
                    PRESTAMOS
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a onclick="cargarcontenido('ContenedorPrincipal','listaPrestCuent.php')">
                            <i class="metismenu-icon"></i>
                            LISTA DE PRESTAMOS
                        </a>
                    </li>
                    <?php if($_SESSION["tipo"] != "Lector"){ ?>
                    <li>
                        <a onclick="cargarcontenido('ContenedorPrincipal','solPrestaEmpl.php')">
                            <i class="metismenu-icon"></i>
                            PRESTAMO PARA LECTOR
                        </a>
                    </li>
                    <li>
                        <a onclick="cargarcontenido('ContenedorPrincipal','compPrestamo.php')">
                            <i class="metismenu-icon"></i>
                            COMPLETAR PRESTAMO
                        </a>
                    </li>
                    <li>
                        <a onclick="cargarcontenido('ContenedorPrincipal','listadoPrestamos.php')">
                            <i class="metismenu-icon"></i>
                            LISTADO TOTAL PRESTAMO
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-users"></i>
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