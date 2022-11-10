$.post(
  "../../proceso/controlador_prestamos.php?op=infLib",
  { id: idInfo },
  function (res) {
    $("#info").append(res);
    $("#fechaR").on("change", function () {
      let fecha = $("#fechaR").val();
      console.log(fecha);
      alert(addDays($("#fechaR").val(), 30));
      $("#fechaE").val(addDays($("#fechaR").val(), 30));
    });
  }
);

$(document).ready(function () {});

function addDays(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  mes = result.getMonth() + 1;
  dia = result.getDate();
  year = result.getFullYear();
  return year + "/" + mes + "/" + dia;
}
