$("#prestamosT").DataTable({
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
    url: "../../proceso/Controlador_prestamos.php?op=listadoPresTot",
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
  $("#prestamosT tfoot th").each(function () {
    var title = $(this).text();
    $(this).html(
      '<input type="text" placeholder="Buscar por ' +
        title +
        '" oninput="this.value = eliminarAcentos(this.value)"/>'
    );
  });

  $("#busqUs").click(function () {
    if ($("#buscUsuario").val() == "") {
      alert("INGRESA UN USUARIO");
    } else {
      $.post(
        "../../proceso/Controlador_prestamos.php?op=numUsua",
        { usuario: $("#buscUsuario").val() },
        function (res) {
          let datos = JSON.parse(res);
          if (datos["0"]["0"] == "NO ENCONTRADO") {
            alert("USUARIO NO ENCONTRADO");
          } else if (datos.length == 1) {
            idUs = datos["0"]["1"];
            cargarcontenido(
              "ContenedorPrincipal",
              "listadoPrestamosBusqUs.php"
            );
          } else {
            let cad = `
            <h1>VARIOS USUARIOS ENCONTRADOS</h1>
            <br>
            <div class="row">
            `;
            for (let i = 0; i < datos.length; i++) {
              cad += `
              <div class= "col-md-6">
                <button 
                  id="${datos[i]["1"]}" 
                  onclick="buscar(this)" 
                  class="mb-2 mr-2 btn btn-success col-md-6"
                >
                ${datos[i]["0"]}
                </button>
                <br>
              </div>
            `;
            }
            cad += "</div>";

            Swal.fire({
              title: "!!",
              icon: "info",
              html: cad,
              showConfirmButton: false,
              showCancelButton: true,
              cancelButtonText: "CANCELAR",
              cancelButtonColor: "#d33",
            });
          }
        }
      );
    }
  });

  $("#busqLi").click(function () {
    $("#info").html("");
    $("#info").append(
      "<h1>Info de libros</h1><button type='button' onclick='regresar()'>Regresar al listado</button>"
    );
  });
});

function regresar() {
  cargarcontenido("ContenedorPrincipal", "listadoPrestamos.php");
}

function buscar(boton) {
  idUs = boton.id;
  Swal.close();
  cargarcontenido("ContenedorPrincipal", "listadoPrestamosBusqUs.php");
}
