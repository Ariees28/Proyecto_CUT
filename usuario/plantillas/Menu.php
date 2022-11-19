
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
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu Principal</li>
            <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','ContenedorEscritorio.php')">
                        <i class="metismenu-icon pe-7s-study"></i>
                        MENÚ PRINCIPAL
                    </a>
                </li>
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
                <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','formulario.php')">
                        <i class="metismenu-icon pe-7s-study"></i>
                        FORMULARIO
                    </a>
                </li>
            <?php } ?>
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
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
            <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-id"></i>
                    CREACION DE USUARIOS
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <?php if($_SESSION['tipo'] == "0" || $_SESSION['tipo'] == "Admin" || $_SESSION['tipo'] == "Empleado"){ ?>
                    <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','nuevoUsuario.php')">
                        <i class="metismenu-icon pe-7s-study"></i>
                        NUEVO USUARIO
                    </a>
                    </li>
                    <?php } ?>

                    <?php if($_SESSION['tipo'] == "0"){ ?>
                    <li>
                    <a onclick="cargarcontenido('ContenedorPrincipal','eliminarUsuario.php')">
                        <i class="metismenu-icon pe-7s-study"></i>
                        ELIMINAR/EDITAR USUARIO
                    </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
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