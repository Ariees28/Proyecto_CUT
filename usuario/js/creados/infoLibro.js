$.post(
  "../../proceso/Controlador_busqueda.php?op=infoCompl",
  { id: idInfo },
  function (res) {
    $("#info").append(res);
  }
);

$.post(
  "../../proceso/Controlador_busqueda.php?op=ultComent",
  {
    libro: idInfo,
  },
  function (res) {
    if (res == "NADA") {
      $("#com").append("<h3>Sin comentarios</h3>");
    } else {
      let datos = JSON.parse(res);
      let cad = "";
      for (let i = 0; i < datos.length; i++) {
        cad += `
        <div class="col-md-6">
        <h4>${datos[i]["0"]}</h4>
        <p>${datos[i]["1"]}</p>
      </div>
        `;
      }
      $("#com").append(cad);
    }
  }
);

$(document).ready(function () {
  $("#regresar").click(function () {
    cargarcontenido("ContenedorPrincipal", "busquedaGenero.php");
  });

  $("#btnTi").click(function () {
    buscarLibro();
  });

  $("#comentar").click(function () {
    comentario();
  });
});

function buscarLibro() {
  libroBusqueda = $("#bqTit").val();
  cargarcontenido("ContenedorPrincipal", "listadoLibrosBusqueda.php");
}

function solicitarPrestamo(libro) {
  idLibrPrestamo = libro.id;
  cargarcontenido("ContenedorPrincipal", "solicitudPrestamo.php");
}

function comentario() {
  let comentario = $("#comentario").val();
  $.post(
    "../../proceso/Controlador_busqueda.php?op=comentar",
    {
      libro: idInfo,
      comentario: comentario,
    },
    function (res) {
      if (res == "exito") {
        Swal.fire({
          title: "COMENTARIO PUBLICADO!",
          text: "para ver tu comentario, es necesario que recargues la página",
          icon: "success",
          showConfirmButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          showCancelButton: 0,
          confirmButtonText: "Entendido",
        }).then(function () {
          $("#comentario").val("");
          $("#comentar").prop("disabled", true);
        });
      } else {
        Swal.fire({
          title: "Error!",
          text: "Ocurrió un error al publicar tu comentario",
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
}
