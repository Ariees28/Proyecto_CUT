//INICIALIZACION DE LA DATATABLE:
$("#tabLibros").DataTable({
  //PARAMETROS PARA DECLARAR LAS OPCIONES DE NUESTRA TABLA:
  //BUSCADOR
  bFilter: true,
  //PARA MOSTRAR INFORMACION
  bInfo: true,
  //MOSTRAR BOTONES DE CAMBIO DE PAGINAS
  bPaginate: true,

  //DECLARACION DEL LENGUAJE DE LA TABLA
  language: {
    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
  },

  //PETICION AL SERVIDOR DE LA INFORMACION
  ajax: {
    //URL A LA QUE SE HACE LA PETICION
    url: "../../proceso/Controlador_formulario.php?op=vista",
    //DATA QUE VAMOS A ENVIAR (EN ESTE CASO ESTA VACIA PORQUE NO SE REQUIERE INFO)
    data: {},
    //TIPO DE SOLICITUD
    type: "POST",
    //TIPO DE DATO CON EL QUE VAMOS A TRABAJAR
    dataType: "json",
    //FUNCION PARA IMPRIMIR ERRORES EN LA CONSOLA
    error: function (e) {
      console.log(e.responseText);
    },
  },
});

$(document).ready(function () {
  $(".carousel").carousel();
});
