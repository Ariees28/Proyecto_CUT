var bandera = true;

function eliminarAcentos(texto) {
  texto = texto.toUpperCase();
  return texto
    .normalize("NFD")
    .replace(
      /([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,
      "$1"
    );
}

$("#tabLib").DataTable({
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
    url: "../../proceso/Controlador_edEl.php?op=listadoLib",
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
  $("#editar").click(function () {
    editar();
  });

  $("#editarP").click(function () {
    editarPortada();
  });

  $("#eliminar").click(function () {
    eliminarLib();
  });

  $("#tabLib tfoot th").each(function () {
    var title = $(this).text();
    $(this).html(
      '<input type="text" placeholder="Buscar por ' +
        title +
        '" oninput="this.value = eliminarAcentos(this.value)"/>'
    );
  });
});

function editar() {
  let tablaLib = $("#tabLib").DataTable();
  let datosLib = tablaLib.rows({ selected: true }).data();

  if (datosLib.length > 0) {
    $("#divRegistro").html("");

    let cadGral = `
    <div class="row">

    <div class="col-md-6">
      <label>TITULO</label>
      <input type="text" id="titulo" name="titulo" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
    </div>

    <div class="col-md-4">
      <label>AUTOR</label>
      <input type="text" id="autor" name="autor" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
    </div>

    <div class="col-md-2">
      <label>PAGINAS</label>
      <input type="number" id="paginas" name="paginas" class="form-control" onkeydown="eliminarE()">
    </div>

    <div class="col-md-2">
      <label>GENERO</label>
      <select id="genero" name="genero" class="form-control"></select>
    </div>

    <div class="col-md-2">
      <label>ISBN</label>
      <input type="text" id="isbn" name="isbn" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
    </div>

    <div class="col-md-2">
      <label>EDITORIAL</label>
      <input type="text" id="editorial" name="editorial" class="form-control" oninput="this.value = eliminarAcentos(this.value)">
    </div>

    <div class="col-md-2">
      <label>AÑO PUBLICACIÓN</label>
      <input type="number" id="fecha" name="fecha" class="form-control" onkeydown="eliminarE()">
    </div>

    <div class="col-md-2">
      <label>IDIOMA</label>
      <input type="text" id="idioma" name="idioma" class="form-control" value="ESPAÑOL" oninput="this.value = eliminarAcentos(this.value)">
    </div>

    <div class="col-md-2">
      <label>EJEMPLARES</label>
      <input type="number" id="ejemplares" name="ejemplares" class="form-control" onkeydown="eliminarE()">
    </div>

    <div class="col-md-12">
      <label>SIPNOSIS</label>
      <textarea id="sipnosis" name="sipnosis" class="form-control sipnosis"></textarea>
    </div>

      <div><br></div>
      <button id="guardar" class="mb-2 mr-2 btn-hover-shine btn btn-success" onclick="guardar()">GUARDAR REGISTRO EDITADO</button>
  </div>
    `;
    $("#divRegistro").append(cadGral);

    $.post(
      "../../proceso/Controlador_edEl.php?op=editar",
      {
        isbn: datosLib[0][2],
      },
      function (res) {
        let arr = JSON.parse(res);

        $.post(
          "../../proceso/Controlador_formulario.php?op=cargarGeneros",
          {},
          function (data) {
            $("#genero").html(data);
            $("#genero").val(arr[0][3]).change();
          }
        );

        $("#titulo").val(arr[0][0]);
        $("#autor").val(arr[0][1]);
        $("#paginas").val(arr[0][2]);
        $("#isbn").val(arr[0][4]);
        $("#editorial").val(arr[0][5]);
        $("#fecha").val(arr[0][6]);
        $("#idioma").val(arr[0][7]);
        $("#ejemplares").val(arr[0][8]);
        $("#sipnosis").val(arr[0][9]);

        idLibrEditar = arr[0][10];
      }
    );
  } else {
    swal("SELECCIONE UN LIBRO", {
      icon: "warning",
    });
  }
}

function guardar() {
  swal({
    title: "¿Estás Seguro?",
    text: "Una vez guardado, se guardará",
    icon: "warning",
    buttons: ["Cancelar", true],
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.post(
        "../../proceso/Controlador_edEl.php?op=guardar",
        {
          id: idLibrEditar,
          titulo: $("#titulo").val(),
          autor: $("#autor").val(),
          paginas: $("#paginas").val(),
          isbn: $("#isbn").val(),
          editorial: $("#editorial").val(),
          genero: $("#genero").val(),
          fecha: $("#fecha").val(),
          idioma: $("#idioma").val(),
          ejemplares: $("#ejemplares").val(),
          sipnosis: $("#sipnosis").val(),
        },
        function (res) {
          if (res == "REGISTRO EXITOSO") {
            swal("Guardado Exitoso", {
              icon: "success",
            });

            cargarcontenido("ContenedorPrincipal", "edicionElimin.php");
          } else {
            swal("HA OCURRIDO UN ERROR", {
              icon: "warning",
            });
          }
        }
      );
    } else {
      swal("Sigue Editando");
    }
  });
}

function editarPortada() {
  let tablaLib = $("#tabLib").DataTable();
  let datosLib = tablaLib.rows({ selected: true }).data();

  if (datosLib.length > 0) {
    $("#divRegistro").html("");

    let cadGral = `
      <form method="post" id="formPortada" name="formPortada" action="" enctype="multipart/form-data">
      <div class="row">
      <div class="col-md-12">
      <input type="hidden" id="id" name="id">
      <input type="hidden" id="titulo" name="titulo">
      <input type="hidden" id="autor" name="autor">
      <label>PORTADA</label>
      <input type="file" id="portada" name="portada" class="form-control" accept=".jpg,.jpeg,.png">

      <div class="card mt-4" style="width: 15rem;">
        <img src="../../files/portadas/Portada_Generica.png" class="card-img-top" id="mostrarimagenLibro">
      </div>
      <div class="card-body">
        <h5 class="card-title">TITULO IMAGEN</h5>
        <p class="card-text" id="NomFotLibro">Sin Imagen</p>
      </div>
  </div>
    <div><br></div>
    <button type="button" id="guardarP" class="mb-2 mr-2 btn-hover-shine btn btn-success" onclick="guardarPortada()">GURDAR PORTADA</button>
      </div>
    </form>
    `;

    $("#divRegistro").append(cadGral);

    $.post(
      "../../proceso/Controlador_edEl.php?op=editar",
      {
        isbn: datosLib[0][2],
      },
      function (res) {
        let arr = JSON.parse(res);
        $("#mostrarimagenLibro").prop(
          "src",
          "../../files/portadas/" + arr[0][11]
        );

        $("#id").val(arr[0][10]);
        $("#titulo").val(arr[0][0]);
        $("#autor").val(arr[0][1]);

        $("#portada").change(function () {
          var x = $("#titulo").val(); //solicitar el nombre
          $("#NomFotLibro").text(x); //agregarlo al nombre de la foto
          const file = this.files[0];
          var nombre = this.files[0].name; // nombre del archivo con todo y extension
          var ext = nombre.split("."); //extension del archivo
          ext = ext[ext.length - 1];

          if (file) {
            if (ext == "jpg" || ext == "png" || ext == "jpeg") {
              let reader = new FileReader();
              reader.onload = function (event) {
                //    console.log(event.target.result);
                $("#mostrarimagenLibro").attr("src", event.target.result);
              };
              reader.readAsDataURL(file);
            } else {
              alert("La extension (" + ext + ") NO es valida, verifique¡¡¡");
              $("#mostrarimagenLibro").attr(
                "src",
                "../../files/portadas/Portada_Generica.png"
              );
              $("#portada").val("");
            }
          }
        });
      }
    );
  } else {
    swal("SELECCIONE UN LIBRO", {
      icon: "warning",
    });
  }
}

function guardarPortada() {
  $("#guardarP").prop("disabled", true);
  var formData = new FormData($("#formPortada")[0]);

  $.ajax({
    url: "../../proceso/Controlador_edEl.php?op=guardarP",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
  }).done(function (res) {
    if (res == "Correcto") {
      swal("Guardado Exitoso", {
        icon: "success",
      });

      cargarcontenido("ContenedorPrincipal", "edicionElimin.php");
    } else {
      swal("Ocurrió un error", {
        icon: "warning",
      });
      cargarcontenido("ContenedorPrincipal", "edicionElimin.php");
    }
  });
}

function eliminarLib() {
  let tablaLib = $("#tabLib").DataTable();
  let datosLib = tablaLib.rows({ selected: true }).data();

  if (datosLib.length > 0) {
    swal({
      title: "¿Estás Seguro?",
      text: "Una vez Eliminado, no se puede deshacer",
      icon: "warning",
      buttons: ["Cancelar", true],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.post(
          "../../proceso/Controlador_edEl.php?op=eliminar",
          {
            isbn: datosLib[0][2],
          },
          function (res) {
            if (res == "true") {
              swal("ELIMINACIÓN EXITOSA", {
                icon: "success",
              });

              cargarcontenido("ContenedorPrincipal", "edicionElimin.php");
            } else {
              swal("HA OCURRIDO UN ERROR", {
                icon: "warning",
              });
            }
          }
        );
      } else {
        swal("Operación cancelada");
      }
    });
  } else {
    swal("SELECCIONE UN LIBRO", {
      icon: "warning",
    });
  }
}
