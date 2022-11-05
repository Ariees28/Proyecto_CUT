
<script src="../js/creados/listadoLibros.js"></script>
<link rel="stylesheet" href="../styles/css/listado.css">

<div class="card mb-4" style="align-items: center; text-align: center">
  <div class="card-body">
    <h1 class="text-primary" id="gen"></h1>
    <button id="regresar" class="btn-wide mb-2 mr-2 btn btn-warning btn-lg">REGRESAR A LISTADO DE GENEROS</button>
  </div>
</div>

<div class="card mb-4" style="align-items: center; text-align: center">
  <div class="col-md-4">
    <h3 class="text-primary">Buscar por Titulo o Autor</h3>
    <input type="text" class="form-control" id="bqTit"><br>
    <button id="btnTi" class="mb-2 mr-2 btn btn-success">Buscar</button>
  </div>
</div>
<div class="row" id="lista"></div>