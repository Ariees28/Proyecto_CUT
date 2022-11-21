var tipoP = "";
var fgs = "";
var fge = "";
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
    $.post(
      "../../proceso/Controlador_prestamos.php?op=numPrestadosEmp",
      {
        id: datosUs[0][0],
      },
      function (res) {
        if (res == "false") {
          Swal.fire({
            title: "Error!",
            text: "Este usuario ya tiene más de 3 prestamos activos",
            icon: "warning",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          });
        } else {
          idU = datosUs[0][0];
          $("#lib").html("");
          let cad = `
        <div class="card-body">
        <table id="tabL" class="display" style="width: 100%;">
          <thead>
            <tr>
              <th>TITULO</th>
              <th>AUTOR</th>
              <th>ISBN</th>
              <th>GENERO</th>
              <th>EJEMPLARES</th>
              <th>PRESTADOS</th>
              <th>ID</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <th>TITULO</th>
              <th>AUTOR</th>
              <th>ISBN</th>
              <th>GENERO</th>
              <th>EJEMPLARES</th>
              <th>PRESTADOS</th>
              <th>ID</th>
            </tr>
          </tfoot>
        </table>
        <button type="button" class="mb-2 mr-2 btn-hover-shine btn btn-success" id="lib" onclick='revPres()'>SELECCIONAR LIBRO</button>
      </div>
        `;
          $("#lib").append(cad);
          $("#tabL tfoot th").each(function () {
            var title = $(this).text();
            $(this).html(
              '<input type="text" placeholder="Buscar por ' +
                title +
                '" oninput="this.value = eliminarAcentos(this.value)"/>'
            );
          });
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
              url: "../../proceso/Controlador_prestamos.php?op=libros",
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

                  $("input", this.footer()).on(
                    "keyup change clear",
                    function () {
                      if (that.search() !== this.value) {
                        that.search(this.value).draw();
                      }
                    }
                  );
                });
            },
          });
        }
      }
    );
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

function revPres() {
  let tablaL = $("#tabL").DataTable();
  let datosL = tablaL.rows({ selected: true }).data();
  if (datosL.length > 0) {
    idL = datosL[0][6];
    $.post(
      "../../proceso/Controlador_prestamos.php?op=revPres",
      {
        idL: idL,
        idU: idU,
      },
      function (res) {
        if (res == "false") {
          Swal.fire({
            title: "Error!",
            text: "Este usuario ya ha solicitado este libro",
            icon: "warning",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          });
        } else {
          disponibilidad();
        }
      }
    );
  } else {
    Swal.fire({
      title: "Error!",
      text: "Selecciona un libro",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  }
}

function disponibilidad() {
  let tablaL = $("#tabL").DataTable();
  let datosL = tablaL.rows({ selected: true }).data();

  if (datosL.length > 0) {
    idL = datosL[0][6];
    let t = datosL[0][4];
    let p = datosL[0][5];

    if (p >= t - 3) {
      Swal.fire({
        title: "Error!",
        text: "No disponible para prestamo",
        icon: "warning",
        showConfirmButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: 0,
        confirmButtonText: "Entendido",
      });
    } else {
      $.post(
        "../../proceso/Controlador_prestamos.php?op=tipoP",
        {
          genero: datosL[0][3],
        },
        function (res) {
          tipoP = res;
          let diaSel = moment();
          let diaSel2 = new Date();
          diaSel.date(diaSel2.getDate());
          diaSel.month(diaSel2.getMonth());
          diaSel.year(diaSel2.getFullYear());
          if (tipoP == "1") {
            let diaEnt = moment();
            diaEnt = diaSel.add(30, "days");
            if (diaEnt.day() == 6) {
              diaEnt = diaSel.add(2, "days");
            } else if (diaEnt.day() == 0) {
              diaEnt = diaSel.add(1, "days");
            }
            fge = `${diaEnt.year()}-${diaEnt.month() + 1}-${diaEnt.date()}`;
            fgs =
              diaSel2.getFullYear() +
              "-" +
              (diaSel2.getMonth() + 1) +
              "-" +
              diaSel2.getDate();
          } else {
            let diaEnt = moment();
            diaEnt = diaSel.add(3, "days");
            if (diaEnt.day() == 6) {
              diaEnt = diaSel.add(2, "days");
            } else if (diaEnt.day() == 0) {
              diaEnt = diaSel.add(1, "days");
            }
            fge = `${diaEnt.year()}-${diaEnt.month() + 1}-${diaEnt.date()}`;
            fgs =
              diaSel2.getFullYear() +
              "-" +
              (diaSel2.getMonth() + 1) +
              "-" +
              diaSel2.getDate();
          }

          let cad = `
      <div class="card-body">
        <h1 class="text-primary">DATOS DEL LIBRO</h1>
        <h3 class="text-success">TITULO:</h3>
        <h4>${datosL[0][0]}</h4>
        <h3 class="text-success">AUTOR:</h3>
        <h4>${datosL[0][1]}</h4>
        <h3 class="text-success">ISBN:</h3>
        <h4>${datosL[0][2]}</h4>
        <h3 class="text-success">FECHA DE ENTREGA:</h3>
        <h4>${fge}</h4><br><br>
        <button type="button" class="mb-2 mr-2 btn btn-success" onclick="prestamo()">GENERAR PRESTAMO</button>
      </div>
      `;
          $("#datos").html("");
          $("#datos").append(cad);
        }
      );
    }
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

function prestamo() {
  $.post(
    "../../proceso/Controlador_prestamos.php?op=solicitarEmp",
    {
      fechaS: fgs,
      fechaE: fge,
      idLibro: idL,
      id: idU,
    },
    function (res) {
      let imp = JSON.parse(res);
      Swal.fire({
        title: "!!",
        html:
          "<h2>" +
          imp["0"]["0"] +
          "</h2>" +
          "Numero de seguimiento:<br>" +
          "<strong>" +
          imp["0"]["1"] +
          "</strong>",
        icon: "info",
        showConfirmButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: 0,
        confirmButtonText: "Entendido",
      }).then(function () {
        cargarcontenido("ContenedorPrincipal", "solPrestaEmpl.php");
      });
    }
  );
}
