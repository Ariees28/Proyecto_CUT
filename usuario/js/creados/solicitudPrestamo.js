$.post(
  "../../proceso/controlador_prestamos.php?op=infLib",
  { id: idInfo },
  function (res) {
    $("#info").append(res);
    $("#fechaR").on("change", function () {
      let fecha = $("#fechaR").val();
      console.log(fecha);
    });
  }
);

$(document).ready(function () {});
