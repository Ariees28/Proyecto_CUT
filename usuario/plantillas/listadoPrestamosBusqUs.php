<script src="../js/creados/listadoPrestamosBusqUs.js"></script>
<div class="card-shadow-info border mb-3 card card-body border-info">
  <h1>INFORMACIÓN DEL USUARIO</h1>
</div>
<div class="row">
  <div class="card col-md-6">
    <h1 class="text-success">NOMBRE: </h1>
    <h4 id="nombre">NOMBRE</h4>
    <h3 class="text-primary">USUARIO: </h3>
    <h4 id="usuario">USUARIO</h4>
    <h3 class="text-primary">CORREO</h3>
    <h4 id="correo">CORREO</h4>
    <h4 id="verif">CORREO</h4>
    <button id="regresar" class="btn-wide mb-2 mr-2 btn btn-warning btn-lg" onclick="cargarcontenido('ContenedorPrincipal','listadoPrestamos.php')">REGRESAR A LISTADO DE PRESTAMOS</button>
  </div>
  <div class="card col-md-6" style="align-items: center; text-align: center">
    
  </div>
</div>

<div class="row" id="lista"></div>