$.post(
  "../../proceso/Controlador_busqueda.php?op=listadoLibrosGenero",
  { genero: generoSeleccionado },
  function (res) {
    let elemento = JSON.parse(res);
    $("#lista").append(elemento["lib"]);
    $("#desc").append(elemento["desc"]);
  }
);

$(document).ready(function () {
  $("#gen").html(generoSeleccionado);

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
