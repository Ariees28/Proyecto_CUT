
<script src="../js/creados/infoLibro.js"></script>

<div class="card mb-4" style="align-items: center; text-align: center">
  <div class="card-body">
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

<div class="card">
  <div class="row" id="info"></div>
</div>
<div class="card mt-4 mb-4">
  <div class="card-header">
    <h1>COMENTARIOS</h1>
  </div>
  <div class="card-body row" id="com">
    <div class="col-md-12">
      <h3>DEJA UN COMENTARIO</h3>
      <textarea id="comentario" name="comentario" class="form-control sipnosis"></textarea><br>
      <button type="button" id="comentar" class="mb-2 mr-2 btn btn-success">COMENTAR EN ESTE LIBRO</button>
    </div>
    <div class="divider"></div>
    <div class="col-md-12">
      <h1>ÚLTIMOS COMENTARIOS</h1>
    </div>
  </div>
</div>

<style>
      .sipnosis {
        resize: none;
        height: 100px;
      }
</style>