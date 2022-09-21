$(document).ready(function () {
  $("#frmAcceso").on("submit", function (e) {
    e.preventDefault();
    var logina = $("#exampleEmail").val();
    var clavea = $("#examplePassword").val();
    $.post(
      "../proceso/usuario.php?op=verificar",
      { logina: logina, clavea: clavea },
      function (data) {
        if (data != false) {
          $(location).attr("href", "plantillas/BannerUsuario.php");
        } else {
          alert("Usuario y/o Password incorrectos");
        }
      }
    );
  });
});
