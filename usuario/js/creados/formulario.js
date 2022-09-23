//PARA ACCEDER A ELEMENTOS DEL DOCUMENTO CON JQUERY:

//# ES PARA ID
//. ES PARA CLASES

//TIPOS DE VARIABLES EN JAVASCRIPT

//const = para variables constantes
//var = variables cuyo valor puede ser global
//let = variables cuyo valor se usa en funciones

$(document).ready(function () {
  $("#form_libro").on("submit", function (e) {
    e.preventDefault();
  });

  $("#guardar").on("click", function () {
    guardar();
  });
});

function guardar() {
  let autor = $("#autor").val();
  let titulo = $("#titulo").val();
  let paginas = $("#paginas").val();
  let sipnosis = $("#sipnosis").val();

  alert(titulo + "\n" + autor + "\n" + paginas + "\n" + sipnosis);
}
