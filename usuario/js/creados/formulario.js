//PARA ACCEDER A ELEMENTOS DEL DOCUMENTO CON JQUERY:

//# ES PARA ID
//. ES PARA CLASES

//TIPOS DE VARIABLES EN JAVASCRIPT

//const = para variables constantes
//var = variables cuyo valor puede ser global
//let = variables cuyo valor se usa en funciones

$(document).ready(function () {
  cargarSelect();
  $("#guardar").click(function (e) {
    e.preventDefault();
    guardar(e);
  });
});

function guardar(e) {
  e.preventDefault(); //no se activara la accion predeterminada
  //$("#almacenar").prop("disabled", true);
  //var formData = new FormData($("#formLibro")[0]); // guardar todo el formulario en variable
  // $.ajax({
  //   url: "../../proceso/Controlador_formulario.php?op=guardar",
  //   type: "POST",
  //   data: formData,
  //   contentType: false,
  //   processData: false,
  // }).done(function (res) {
  //   bootbox.alert(res);
  //   alert(res);
  //   cargarcontenido("ContenedorPrincipal", "formulario.php");
  // });
  let autor = $("#autor").val();
  let titulo = $("#titulo").val();
  let paginas = $("#paginas").val();
  let genero = $("#genero").val();
  let isbn = $("#genero").val();
  let editorial = $("#genero").val();
  let fecha = $("#genero").val();
  let idioma = $("#genero").val();
  let ejemplares = $("#genero").val();
  let portada = $("#portada").val();
  let imagenActual = $("imagenactual");

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
        genero: genero,
        isbn: isbn,
        editorial: editorial,
        fecha: fecha,
        idioma: idioma,
        ejemplares: ejemplares,
        portada: portada,
        imagenActual: imagenActual,
      },
      function (data) {
        alert(data);
        cargarcontenido("ContenedorPrincipal", "formulario.php");
      }
    );
  }
}

$("#portada").change(function () {
  var x = $("#titulo").val(); //solicitar el nombre
  $("#NomFotLibro").text(x); //agregarlo al nombre de la foto
  const file = this.files[0];
  var tamaño = this.files[0].size; // tamaño del archivo
  var nombre = this.files[0].name; // nombre del archivo con todo y extension
  var ext = nombre.split("."); //extension del archivo
  ext = ext[ext.length - 1];
  //console.log(ext);

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
        "../../files/portadas/Portada_Generica.jpg"
      );
      $("#FotUse").val("");
    }
  }
});

function cargarSelect() {
  $.post(
    "../../proceso/Controlador_formulario.php?op=cargarGeneros",
    {},
    function (data) {
      $("#genero").html(data);
    }
  );
}
