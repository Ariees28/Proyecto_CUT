<style>
      .sipnosis {
        resize: none;
        height: 100px;
      }
</style>
<script src="../js/creados/formulario.js"></script>

<h1>FORMULARIO</h1>

<div class="main-card mb-3 card">
  <div class="card-header"><h4 class="text-primary">FORMULARIO PARA REGISTRO DE LIBROS</h4></div>

  <div class="card-body">
    <form method="post" id="formLibro" name="formLibro" action="" enctype="multipart/form-data">
      <div class="content">
        <div class="row">

          <div class="col-md-6">
            <label>TITULO</label>
            <input type="text" id="titulo" name="titulo" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div class="col-md-4">
            <label>AUTOR</label>
            <input type="text" id="autor" name="autor" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div class="col-md-2">
            <label>PAGINAS</label>
            <input type="number" id="paginas" name="paginas" class="form-control" onkeydown="eliminarE()">
          </div>

          <div class="col-md-2">
            <label>GENERO</label>
            <select id="genero" name="genero" class="form-control"></select>
          </div>

          <div class="col-md-2">
            <label>ISBN</label>
            <input type="text" id="isbn" name="isbn" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div class="col-md-2">
            <label>EDITORIAL</label>
            <input type="text" id="editorial" name="editorial" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div class="col-md-2">
            <label>AÑO PUBLICACIÓN</label>
            <input type="number" id="fecha" name="fecha" class="form-control" onkeydown="eliminarE()">
          </div>

          <div class="col-md-2">
            <label>IDIOMA</label>
            <input type="text" id="idioma" name="idioma" class="form-control" value="ESPAÑOL" oninput="this.value = eliminarAcentos(this.value)">
          </div>

          <div class="col-md-2">
            <label>EJEMPLARES</label>
            <input type="number" id="ejemplares" name="ejemplares" class="form-control" onkeydown="eliminarE()">
          </div>

          <div class="col-md-12">
            <label>SIPNOSIS</label>
            <textarea id="sipnosis" name="sipnosis" class="form-control sipnosis"></textarea>
          </div>

          <div class="col-md-12">
            <label>PORTADA</label>
            <input type="file" id="portada" name="portada" class="form-control" accept=".jpg,.jpeg,.png">

            <div class="card mt-4" style="width: 15rem;">
              <img src="../../files/portadas/Portada_Generica.png" class="card-img-top" id="mostrarimagenLibro">
            </div>
            <div class="card-body">
              <h5 class="card-title">TITULO IMAGEN</h5>
              <p class="card-text" id="NomFotLibro">Sin Imagen</p>
            </div>
        </div>
        <br>
        <button id="guardar" class="mb-2 mr-2 btn-hover-shine btn btn-success">GUARDAR</button>
      </div>
    </form>
  </div>
</div>

<!-- mb-2 mr-2 btn-hover-shine btn btn-success -->