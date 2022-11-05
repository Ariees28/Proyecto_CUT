$.post(
  "../../proceso/Controlador_busqueda.php?op=listadoLibrosBusqueda",
  { libro: libroBusqueda },
  function (res) {
    $("#lista").append(res);
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

function info(seleccion) {
  idInfo = seleccion.id;
  cargarcontenido("ContenedorPrincipal", "infoLibro.php");
}
