<script src="../js/creados/compPrestamo.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<div class="card">
  <div class="card-body">
    <h1 class="text-primary">SELECCIONA UN USUARIO</h1>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <table id="tabUs" class="display" style="width: 100%;">
      <thead>
        <tr>
          <th>ID</th>
          <th>USUARIO</th>
          <th>NOMBRE</th>
          <th>CORREO</th>
        </tr>
      </thead>
      <tbody></tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>USUARIO</th>
          <th>NOMBRE</th>
          <th>CORREO</th>
        </tr>
      </tfoot>
    </table>
    <button type="button" class="mb-2 mr-2 btn-hover-shine btn btn-success" id="usuario">SELECCIONAR USUARIO</button>
  </div>
</div>

<div class="card mt-3 mb-3" id="lib"></div>