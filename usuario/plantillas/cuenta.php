<?php
  session_start();
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/creados/cuenta.js"></script>
<h1>CONFIGURACION DE LA CUENTA</h1>
<div class="card">
  <div class="card-header">
    <h2 class="text-success">USUARIO: <?php echo $_SESSION["login"] ?></h2>
  </div>
  <div class="card-body row">
    <form id="formDatos">
      <div class="col-md-6">
        <label for="nomUs">NOMBRE</label>
        <input type="text" class="form-control" id="nomUs" value="<?php echo $_SESSION["nombre"]; ?>" oninput="this.value = eliminarAcentos(this.value)">
      </div>

      <div class="col-md-6"></div>

      <div class="col-md-6">
        <label for="emUs">EMAIL</label>
        <input type="email" class="form-control" id="emUs" value="<?php echo $_SESSION["Correo"]; ?>">
      </div>

      <div class="col-md-6"></div>
      
      <div class="col-md-6 mt-3">
        <button class="mb-2 mr-2 btn btn-success">ACTUALIZAR DATOS</button>
      </div>
    </form>

    <div class="divider"></div>

    <div class="card mt-4" id="password">
      <h2>Actualizar contraseña:</h2>
      <div class="col-md-6">
        <button class="mb-2 mr-2 btn btn-warning" id="actPss">ACTUALIZAR</button>
      </div>

      <div class="col-md-6">
      </div>

    </div>

    <div class="divider"></div>

    <div class="col-md-6 mt-4">
      <h1 class="text-primary">VERIFICACIÓN DE CORREO</h1>
    </div>
    <div class="col-md-6"></div>
    <div class="divider"></div>
    <?php if($_SESSION['verificado'] == 0){ ?>
    <div class="col-md-6" id="divVerCor">
      <h3 class="text-warning">Correo no verificado</h3>
      <button class="mb-2 mr-2 btn btn-warning" type="button" id="verCor">SOLICITAR VERIFICACIÓN</button>
    </div>
    <?php }else{ ?>
    <div class="col-md-6" id="divVerCor">
      <h3 class="text-success">Correo verificado</h3>
      <h4 class="text-primary">No son necesarias más acciones</h4>
    </div>
    <?php }?>
  </div>
</div> 