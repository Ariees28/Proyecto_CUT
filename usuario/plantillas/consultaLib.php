<script src="../js/creados/vistaLibros.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<div class="main-card mb-3 card">
  <div class="card-header"><h2 class="text-primary">CONSULTA DE LIBROS</h2></div>
  <div class="card-body">
    <h3 class="text-secondary">GENEROS PRINCIPALES</h3>
    <div class="row">
      <div class="col-md-4">
        <label class="form-control">LITERATURA Y NOVELAS</label>
        <button id="litNov">
          <img src="../../files/generos/literatura_y_novelas.jpg" style="width: 100%;">
        </button>
      </div>

      <div class="col-md-4">
        <label class="form-control">MEDICINA</label>
        <button id="medicina">
          <img src="../../files/generos/medicina.jpg" style="width: 100%;">
        </button>
      </div>

      <div class="col-md-4">
        <label class="form-control">DERECHO</label>
        <button id="derecho">
          <img src="../../files/generos/Derecho.jpg" style="width: 100%;">
        </button>
      </div>
    </div>

    <div class="divider"></div>

    <div class="row">
      <div class="col-md-12">
        <label>BUSCAR LIBRO</label>
      </div>
    </div>

    <div class="divider"></div>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../../files/generos/literatura_y_novelas.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../../files/generos/medicina.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../../files/generos/Derecho.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


  </div>
</div>

