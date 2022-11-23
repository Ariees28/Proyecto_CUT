<script src="../js/creados/listadoPrestamos.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<div class="card">
  <div class="card-body">
    <h1 class="text-primary">LISTADO DE PRESTAMOS</h1>
  </div>
</div>

<div class="card-group mt-4 mb-4">

  <div class="card">
    <div class="card-body">
      <h3 class="text-primary">Buscar por usuario<h5 class="text-success">(Nombre, Usuario o Correo)</h5></h3>
      <input type="text" class="form-control" id="buscUsuario"/><br>
      <button type="button" id="busqUs" class="mb-2 mr-2 btn btn-success">BUSCAR</button>
    </div>
  </div>
  
  <div class="card">
    <div class="card-body">
      <h3 class="text-primary">Buscar por libro<h5 class="text-success">(Titulo o ISBN)</h5></h3>
      <input type="text" class="form-control" id="buscLibro"/><br>
      <button type="button" id="busqLi" class="mb-2 mr-2 btn btn-success">BUSCAR</button>
    </div>
  </div>
</div>

<div class="card mt-4" id="info">
  <table id="prestamosT" class="display" style="width: 100%;">
    <thead>
      <tr>
        <th>TITULO LIBRO</th>
        <th>SOLICITANTE</th>
        <th>NUMERO DE SEGUIMIENTO</th>
        <th>FECHA SOLICITUD</th>
        <th>FECHA ENTREGA</th>
        <th>STATUS</th>
      </tr>
    </thead>
    <tbody></tbody>
    <tfoot>
      <tr>
        <th>TITULO LIBRO</th>
        <th>SOLICITANTE</th>
        <th>NUMERO DE SEGUIMIENTO</th>
        <th>FECHA SOLICITUD</th>
        <th>FECHA ENTREGA</th>
        <th>STATUS</th>
      </tr>
    </tfoot>
  </table>
</div>