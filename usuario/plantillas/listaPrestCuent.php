<?php session_start(); ?>

<script src="../js/creados/listaPrestCuent.js"></script>
<link rel="stylesheet" href="../styles/css/listado.css">

<div class="card mb-4" style="align-items: center; text-align: center">
  <div class="card-body">
    <h1 class="text-primary" id="usuario"><?php echo $_SESSION["nombre"]; ?></h1>
  </div>
</div>
<div class="row" id="lista">
</div>

