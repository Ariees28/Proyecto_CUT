var tipoPrestamo;
var idLibro;

$.post(
  "../../proceso/Controlador_prestamos.php?op=numPrestamos",
  {},
  function (res) {
    let x = JSON.parse(res);
    if (x["0"]["0"] == "false") {
      $("#info").append(x["0"]["1"]);
    } else {
      $.post(
        "../../proceso/Controlador_prestamos.php?op=infLib",
        { id: idInfo },
        function (res) {
          let respuesta = JSON.parse(res);
          $("#info").append(respuesta["0"]["0"]);
          tipoPrestamo = respuesta["0"]["1"];
          idLibro = respuesta["0"]["2"];
          $("#fechaR").on("change", function () {
            if (respuesta["0"]["1"] == "1") {
              $("#fechaE").html(addDays($("#fechaR").val(), 30));
            } else {
              $("#fechaE").html(addDays($("#fechaR").val(), 3));
            }
          });
        }
      );
    }
  }
);

$(document).ready(function () {});

function addDays(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  mes = result.getMonth() + 1;
  dia = result.getDate();
  year = result.getFullYear();
  return year + "-" + mes + "-" + dia;
}

function solicitar() {
  if ($("#fechaR").val() == "") {
    Swal.fire({
      title: "Error!",
      text: "Introduce una fecha",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  } else {
    let fechaS = $("#fechaR").val();
    let fechaE;
    if (tipoPrestamo == "1") {
      fechaE = addDays($("#fechaR").val(), 30);
    } else {
      fechaE = addDays($("#fechaR").val(), 3);
    }

    $.post(
      "../../proceso/Controlador_prestamos.php?op=solicitar",
      {
        fechaS: fechaS,
        fechaE: fechaE,
        idLibro: idLibro,
      },
      function (res) {
        Swal.fire({
          title: "!!",
          text: res,
          icon: "info",
          showConfirmButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          showCancelButton: 0,
          confirmButtonText: "Entendido",
        });
      }
    );
  }
}
