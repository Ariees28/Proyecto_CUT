var idU = "";
var idL = "";

$("#tabUs").DataTable({
  bFilter: true,
  bInfo: false,
  bPaginate: true,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
  },
  select: {
    style: "single",
    info: false,
  },

  ajax: {
    url: "../../proceso/Controlador_prestamos.php?op=usuarios",
    data: {},
    type: "POST",
    dataType: "json",
    error: function (e) {
      alert("ocurrió un error, contacte al administrador");
    },
  },

  initComplete: function () {
    // Apply the search
    this.api()
      .columns()
      .every(function () {
        var that = this;

        $("input", this.footer()).on("keyup change clear", function () {
          if (that.search() !== this.value) {
            that.search(this.value).draw();
          }
        });
      });
  },
});

$(document).ready(function () {
  $("#usuario").click(function () {
    selUsuario();
  });

  $("#tabUs tfoot th").each(function () {
    var title = $(this).text();
    $(this).html(
      '<input type="text" placeholder="Buscar por ' +
        title +
        '" oninput="this.value = eliminarAcentos(this.value)"/>'
    );
  });
});

function selUsuario() {
  let tablaUs = $("#tabUs").DataTable();
  let datosUs = tablaUs.rows({ selected: true }).data();

  if (datosUs.length > 0) {
    idU = datosUs[0][0];
    $("#lib").html("");
    let cad = `
    <div class="card-body">
    <table id="tabL" class="display" style="width: 100%;">
      <thead>
        <tr>
          <th>NUMERO SEGUIMIENTO</th>
          <th>ID LIBRO</th>
          <th>FECHA SOLICITUD</th>
          <th>FECHA ENTREGA</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <button type="button" class="mb-2 mr-2 btn-hover-shine btn btn-success" id="lib" onclick='devolver()'>SELECCIONAR LIBRO</button>
  </div>
    `;
    $("#lib").append(cad);

    $("#tabL").DataTable({
      bFilter: true,
      bInfo: false,
      bPaginate: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
      },
      select: {
        style: "single",
        info: false,
      },

      ajax: {
        url: "../../proceso/Controlador_prestamos.php?op=prestamosUs",
        data: { id: idU },
        type: "POST",
        dataType: "json",
        error: function (e) {
          alert("ocurrió un error, contacte al administrador " + e);
        },
      },

      initComplete: function (settings, json) {
        if (json.iTotalRecords == 0) {
          $("#lib").html(
            `<div class="card-body"><h5>USUARIO SIN PRESTAMOS ACTIVOS</h5></div>`
          );
        }
      },
    });
  } else {
    Swal.fire({
      title: "Error!",
      text: "Seleccione a un usuario",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  }
}

function devolver() {
  let tablaL = $("#tabL").DataTable();
  let datosL = tablaL.rows({ selected: true }).data();

  if (datosL.length > 0) {
    idL = datosL[0][1];
    $.post(
      "../../proceso/Controlador_prestamos.php?op=retornarLib",
      { idL: idL, idU: idU },
      function (res) {
        if (res == "true") {
          Swal.fire({
            title: "Exito!",
            text: "Se ha devuelto el libro correctamente",
            icon: "success",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          }).then(function () {
            cargarcontenido("ContenedorPrincipal", "compPrestamo.php");
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: res,
            icon: "warning",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          });
        }
      }
    );
  } else {
    Swal.fire({
      title: "Error!",
      text: "Seleccione un libro",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  }
}
