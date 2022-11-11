<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<div class="app-main__inner" id="ContenedorPrincipal">
    <h1>HOLA MUNDO! Este será nuestrto escritorio principal</h1>
    <?php echo "<h1>BIENVENIDO ".$_SESSION["nombre"]."</h1>" ?>
    <h1>AH QUE LA CHINGÁ</h1>
</div>