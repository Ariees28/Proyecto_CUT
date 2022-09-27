<script src="../js/creados/formulario.js"></script>

<h1>FORMULARIO</h1>

<div class="main-card mb-3 card">
  <div class="card-header"><h4 class="text-primary">FORMULARIO PARA REGISTRO DE LIBROS</h4></div>

  <div class="card-body">
    <form method="post" id="form_libro">
      <div class="content">
        <div class="row">

          <div class="col-md-6">
            <label>TITULO</label>
            <input type="text" id="titulo" class="form-control">
          </div>

          <div class="col-md-4">
            <label>AUTOR</label>
            <input type="text" id="autor" class="form-control">
          </div>

          <div class="col-md-2">
            <label>PAGINAS</label>
            <input type="number" id="paginas" class="form-control">
          </div>

          <div class="col-md-2">
            <label>GENERO</label>
            <input type="text" id="genero" class="form-control">
          </div>
        </div>
        <br>
        <button type="button" id="guardar" class="mb-2 mr-2 btn-hover-shine btn btn-success">GUARDAR</button>
      </div>
    </form>
  </div>
</div>