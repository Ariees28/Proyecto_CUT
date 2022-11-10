<script src="../js/creados/edicionElimin.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
      .sipnosis {
        resize: none;
        height: 100px;
      }
</style>
<div class="main-card mb-3 card">
  <div class="card-header"><h4>EDITAR</h4></div>
  <div class="card-body">
    <h3 class="text-primary">SELECCIONE UN LIBRO</h3>
    <table id="tabLib" class="display" style="width: 100%;">
      <thead>
        <tr>
          <th>TITULO</th>
          <th>AUTOR</th>
          <th>ISBN</th>
          <th>EJEMPLARES</th>
        </tr>
      </thead>
      <tbody></tbody>
      <tfoot>
        <tr>
          <th>TITULO</th>
          <th>AUTOR</th>
          <th>ISBN</th>
          <th>EJEMPLARES</th>
        </tr>
      </tfoot>
    </table>
    <div class="divider"></div>
    <button type="button" class="mb-2 mr-2 btn-hover-shine btn btn-success" id="editar">EDITAR DATOS DEL LIBRO</button>
    <button type="button" class="mb-2 mr-2 btn-hover-shine btn btn-success" id="editarP">EDITAR PORTADA DEL LIBRO</button>
    <button id="eliminar" type="button" class="mb-2 mr-2 btn-hover-shine btn btn-danger">ELIMINAR LIBRO</button>
    <div id="divRegistro" class="row"></div>
  </div>
</div>