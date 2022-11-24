<script src="../js/creados/listadoPrestamosBusqLib.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">

<div class="card-shadow-info border mb-3 card card-body border-info">
  <h1>INFORMACIÓN DEL LIBRO</h1>
</div>

<div class="row">
  <div class="card col-md-6">
    <h1 class="text-success">TITULO: </h1>
    <h4 id="titulo"></h4>
    <h3 class="text-primary">AUTOR: </h3>
    <h4 id="autor"></h4>
    <h3 class="text-primary">PÁGINAS: </h3>
    <h4 id="paginas"></h4>
    <h3 class="text-primary">GÉNERO</h3>
    <h4 id="genero"></h4>
    <h3 class="text-primary">ISBN</h3>
    <h4 id="isbn"></h4>
    <h3 class="text-primary">EDITORIAL</h3>
    <h4 id="editorial"></h4>
    <button id="regresar" class="btn-wide mb-2 mr-2 btn btn-warning btn-lg" onclick="cargarcontenido('ContenedorPrincipal','listadoPrestamos.php')">REGRESAR A LISTADO DE PRESTAMOS</button>
  </div>
  <div class="card col-md-6">
    <div class="card-body row">
      <div class='col-lg-8 col-md-8 col-sm-8 mb-4'>
        <img id="portada" src='../../files/portadas/Portada_Generica.png' class='card-img-top' style='border-radius: 10px' height='600'>
      </div>
    </div>
    
  </div>
</div>

<div class="main-card mb-3 mt-4 card">
  <div class="card-header"><h4>LISTA USUARIOS</h4></div>
  <div class="card-body">
    <table id="tabUs" class="display" style="width: 100%;">
      <thead>
        <tr>
          <th>SOLICITANTE</th>
          <th>NUMERO DE SEGUIMIENTO</th>
          <th>FECHA DE SOLICITUD</th>
          <th>FECHA DE ENTREGA</th>
          <th>STATUS</th>
        </tr>
      </thead>
      <tbody></tbody>
      <tfoot>
        <tr>
          <th>SOLICITANTE</th>
          <th>NUMERO DE SEGUIMIENTO</th>
          <th>FECHA DE SOLICITUD</th>
          <th>FECHA DE ENTREGA</th>
          <th>STATUS</th>
      </tr>
    </tfoot>
    </table>
  </div>
</div>