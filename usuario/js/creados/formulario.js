$(document).ready(function () {
  cargarSelect();
  $("#guardar").click(function (e) {
    e.preventDefault();
    if (verificarCampos() == true) {
      guardar(e);
    }
  });
});

function verificarCampos() {
  let bandera = true;

  let titulo = $("#titulo").val();
  let autor = $("#autor").val();
  let paginas = $("#paginas").val();
  let isbn = $("#isbn").val();
  let editorial = $("#editorial").val();
  let fecha = $("#fecha").val();
  let idioma = $("#idioma").val();
  let ejemplares = $("#ejemplares").val();

  if (titulo == "") {
    alert("INGRESE UN TITULO");
    bandera = false;
  }
  if (autor == "") {
    alert("INGRESE UN AUTOR");
    bandera = false;
  }
  if (paginas == "") {
    alert("INGRESE EL NUMERO DE PAGINAS");
    bandera = false;
  }
  if (isbn == "") {
    alert("INGRESE EL ISBN");
    bandera = false;
  }
  if (editorial == "") {
    alert("INGRESE LA EDITORIAL");
    bandera = false;
  }
  if (fecha == "") {
    alert("INGRESE LA FECHA");
    bandera = false;
  }
  if (idioma == "") {
    alert("INGRESE EL IDIOMA");
    bandera = false;
  }
  if (ejemplares == "") {
    alert("INGRESE EL NUMERO DE EJEMPLARES");
    bandera = false;
  }

  return bandera;
}

function guardar(e) {
  e.preventDefault();

  $("#guardar").prop("disabled", true);
  var formData = new FormData($("#formLibro")[0]);

  $.ajax({
    url: "../../proceso/Controlador_formulario.php?op=guardar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
  }).done(function (res) {
    alert(res);
    cargarcontenido("ContenedorPrincipal", "formulario.php");
  });
}

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
        "../../files/portadas/Portada_Generica.jpg"
      );
      $("#portada").val("");
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
