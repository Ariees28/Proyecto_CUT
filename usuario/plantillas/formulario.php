<script src="../js/creados/formulario.js"></script>

<h1>FORMULARIO</h1>

<div class="main-card mb-3 card">
  <div class="card-header"><h4 class="text-primary">FORMULARIO PARA REGISTRO DE LIBROS</h4></div>

  <div class="card-body">
    <form method="post" id="formLibro" action="" enctype="multipart/form-data">
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
            <select id="genero" class="form-control"></select>
          </div>

          <div class="col-md-2">
            <label>ISBN</label>
            <input type="text" id="isbn" class="form-control">
          </div>

          <div class="col-md-2">
            <label>EDITORIAL</label>
            <input type="text" id="editorial" class="form-control">
          </div>

          <div class="col-md-2">
            <label>AÑO PUBLICACIÓN</label>
            <input type="number" id="fecha" class="form-control">
          </div>

          <div class="col-md-2">
            <label>IDIOMA</label>
            <input type="text" id="idioma" class="form-control" value="ESPAÑOL">
          </div>

          <div class="col-md-2">
            <label>EJEMPLARES</label>
            <input type="number" id="ejemplares" class="form-control">
          </div>

          <div class="col-md-8">
            <label>PORTADA</label>
            <input type="file" id="portada" class="form-control" accept=".jpg,.jpeg,.png">

            <img src="../../files/portadas/Portada_Generica.jpg" class="card-img-top" id="mostrarimagenLibro">
            <div class="card-body">
              <h5 class="card-title">TITULO IMAGEN</h5>
              <p class="card-text" id="NomFotLibro">Sin Imagen</p>
              <input type="hidden" name="imagenactual" id="imagenactual">
            </div>
        </div>
        <br>
        <button type="button" id="guardar" class="mb-2 mr-2 btn-hover-shine btn btn-success">GUARDAR</button>
      </div>
    </form>
  </div>
</div>