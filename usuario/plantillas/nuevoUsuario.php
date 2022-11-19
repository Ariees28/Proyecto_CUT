<script src="../js/creados/nuevoUsuario.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php session_start() ?>


<div class="card">
<div class="card-header"><h1 class="text-primary">NUEVO USUARIO</h1></div>
<div class="card-body">
    <form method="post" id="formUs" name="formLibro" action="">
      <div class="content">
        <div class="row">

          <div class="col-md-4">
            <label>EMAIL</label>
            <input type="email" id="email" name="email" class="form-control">
          </div>

          <div class="col-md-4">
            <label>NOMBRE</label>
            <input type="text" id="nombre" name="nombre" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div class="col-md-4">
            <label>USUARIO</label>
            <input type="text" id="usuario" name="usuario" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div class="col-md-4">
            <label>CONTRASEÑA</label>
            <input type="password" id="contra" name="contra" class="form-control">
          </div>

          <div class="col-md-4">
            <label>REPETIR CONTRASEÑA</label>
            <input type="password" id="contraR" name="contraR" class="form-control">
          </div>

          <div class="col-md-4">
            <label>TIPO DE USUARIO</label>
            <select name="tipo" id="tipo" class="form-control">
              <?php if($_SESSION["tipo"] == "0"){ ?>
              <option value="Admin">ADMINISTRADOR</option>
              <?php }?>
              <?php if($_SESSION["tipo"] == "0" || $_SESSION["tipo"] == "Admin"){ ?>
              <option value="Empleado">EMPLEADO</option>
              <?php }?>
              <option value="Lector">LECTOR</option>
            </select>
          </div>

        <br><br>
        <div class="divider"></div>
        <button type="submit" id="guardar" class="mb-2 mr-2 btn btn-success">GUARDAR</button>
      </div>
    </form>
  </div>
</div>
</div>