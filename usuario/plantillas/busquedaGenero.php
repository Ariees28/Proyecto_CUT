<link rel="stylesheet" href="../styles/css/listado.css">
<script src="../js/creados/busquedaGenero.js"></script>
<link rel="stylesheet" href="../styles/css/slider2.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">

<div class="main-card mb-3 card">
  <div class="card-header"><h2 class="text-primary">CONSULTA DE LIBROS</h2></div>
  <div class="card-body">
    <h3 class="text-secondary" style="text-align: center">GENEROS PRINCIPALES</h3><hr>
    <div class="slider-container">
    <div class="slider">
      <div class="slide active">
        <img src="../../files/generos/Literatura.jpg" alt="">
        <div class="info">
          <h2>LITERATURA Y NOVELAS</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <button id="btnLit" class="mb-2 mr-2 btn btn-success">Lista de libros</button>
        </div>
      </div>
      <div class="slide">
        <img src="../../files/generos/medicina.jpg" alt="">
        <div class="info">
          <h2>MEDICINA</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <button id="btnMed" class="mb-2 mr-2 btn btn-success">Lista de libros</button>
        </div>
      </div>
      <div class="slide">
        <img src="../../files/generos/Derecho.jpg" alt="">
        <div class="info">
          <h2>DERECHO</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <button id="btnDer" class="mb-2 mr-2 btn btn-success">Lista de libros</button>
        </div>
      </div>
      <div class="navigation">
        <i class="fas fa-chevron-left prev-btn"></i>
        <i class="fas fa-chevron-right next-btn"></i>
      </div>
      <div class="navigation-visibility">
        <div class="slide-icon active"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
      </div>
    </div>
    </div>
    
    <div class="divider"></div>
    <br>
    <h3 class="text-primary">BUSQUEDA POR TITULO DE LIBRO O AUTOR</h3>
    <input type="text" name="titulo" id="titulo" class="form-control"><br>
    <button id="bscTit" class="mb-2 mr-2 btn btn-success">BUSCAR</button>

    <div class="divider"></div>

    <div class="row" id="listadoGeneros"></div>
  </div>
</div>
