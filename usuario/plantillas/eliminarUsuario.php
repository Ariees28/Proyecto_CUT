<script src="../js/creados/eliminarUsuario.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">

<div class="main-card mb-3 card">
  <div class="card-header"><h4>EDITAR</h4></div>
  <div class="card-body">
    <h3 class="text-primary">SELECCIONE UN USUARIO</h3>
    <table id="tabUs" class="display" style="width: 100%;">
      <thead>
        <tr>
          <th>USUARIO</th>
          <th>NOMBRE</th>
          <th>CORREO</th>
          <th>PRIVILEGIO</th>
          <th>ID</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <div class="divider"></div>
    <button type="button" class="mb-2 mr-2 btn-hover-shine btn btn-success" id="editar">EDITAR DATOS DEL USUARIO</button>
    <button id="edContra" type="button" class="mb-2 mr-2 btn-hover-shine btn btn-warning">EDITAR CONTRASEÑA</button>
    <button id="eliminar" type="button" class="mb-2 mr-2 btn-hover-shine btn btn-danger">ELIMINAR USUARIO</button>
    <div id="divDatos" class="row"></div>
  </div>
</div>