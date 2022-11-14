$.post(
  "../../proceso/Controlador_busqueda.php?op=infoCompl",
  { id: idInfo },
  function (res) {
    $("#info").append(res);
  }
);

$(document).ready(function () {
  $("#regresar").click(function () {
    cargarcontenido("ContenedorPrincipal", "busquedaGenero.php");
  });

  $("#btnTi").click(function () {
    buscarLibro();
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
