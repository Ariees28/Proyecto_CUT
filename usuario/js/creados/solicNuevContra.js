$(document).ready(function () {
  $("#sbmt").click(function () {
    solNv();
  });
});

function solNv() {
  let email = $("#emailRec").val();

  $.post(
    "../../proceso/Controlador_cuenta.php?op=solContraNueva",
    { email: email },
    function (res) {
      if (res == "exito") {
        $("#divsvmt").html("");
        let cadGral = `
        <h3 class="text-success">Solicitud realizada</h3>
        <p>Revisa tu bandeja de entrada (incluida la carpeta de "spam" o Correo no deseado) para encontrar el correo de recuperación de contraseña</p>
        `;
        $("#divsvmt").append(cadGral);
      } else {
        Swal.fire({
          title: "Error!",
          text: res,
          icon: "warning",
          showConfirmButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          showCancelButton: 0,
          confirmButtonText: "Entendido",
        });
      }
    }
  );
}
