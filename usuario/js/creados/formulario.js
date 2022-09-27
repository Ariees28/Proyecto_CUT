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
  let genero = $("#genero").val();

  if (autor == "" || titulo == "" || paginas == "" || genero == "") {
    alert("LLENA TODOS LOS CAMPOS");
  } else {
    //Estructura para el post de Jquery:

    //URL A LA QUE QUEREMOS ACCEDER
    //DATA QUE VAMOS A ENVIAR
    //FUNCION PARA MANEJAR EL POST

    $.post(
      "../../proceso/Controlador_formulario.php?op=guardar",
      {
        autor: autor,
        titulo: titulo,
        paginas: paginas,
        apachedecombate: genero,
      },
      function (data) {
        alert(data);
        cargarcontenido("ContenedorPrincipal", "formulario.php");
      }
    );
  }
}
