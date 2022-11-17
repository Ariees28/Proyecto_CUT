var id = "";
var tk = "";

$(document).ready(function () {
  let params = new URLSearchParams(location.search);
  id = params.get("op");
  tk = params.get("tk");
  $.post(
    "../../proceso/Controlador_verCor.php?op=verCor",
    {
      id: id,
      token: tk,
    },
    function (res) {
      $("#msj").html(res);
    }
  );
});
