var id = "";
var tk = "";

$(document).ready(function () {
  let params = new URLSearchParams(location.search);
  id = params.get("op");
  tk = params.get("tk");

  $.post(
    "../../proceso/Controlador_cuenta.php?op=verCambCont",
    { id: id, token: tk },
    function (res) {
      if (res == "true") {
        let cadGral = `
          <div class="row">
            <h3 class="text-primary">CREA TU NUEVA CONTRASEÑA</h3>
          
            <div class="col-md-6 mt-3">
              <label>Ingresa la contraseña</label>
              <input type="password" id="pass1" class="form-control">
            </div>
            <div class="col-md-6 mt-3"></div>

            <div class="col-md-6 mt-3">
              <label>Repite la contraseña</label>
              <input type="password" id="pass2" class="form-control">
            </div>
            <div class="col-md-6 mt-3"></div>
            <div class="col-md-6 mt-3">
              <button type="button" class="btn-wide mb-2 mr-2 btn-pill btn btn-primary" onclick="nuevaContra()">REESTABLECER CONTRASEÑA</button>
            </div>

          </div>
        `;
        $("#cont").append(cadGral);
      } else {
        $("#msj").html(res);
      }
    }
  );
});

function nuevaContra() {
  let c1 = $("#pass1").val();
  let c2 = $("#pass2").val();

  if (c1 != c2) {
    Swal.fire({
      title: "Error!",
      text: "Las contraseñas no coinciden",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  } else {
    $.post(
      "../../proceso/Controlador_cuenta.php?op=nvaContra",
      { contra: c1, contra2: c2, id: id, token: tk },
      function (res) {
        if (res == "error") {
          Swal.fire({
            title: "Error!",
            text: "Ocurrió un error",
            icon: "warning",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          });
        } else {
          $("#cont").html("");
          let cadGral = `
          <div class="row">
            <h3 class="text-primary">SOLICITUD COMPLETADA</h3>
          
            <div class="card-body">
              <h5>Puedes cerrar esta ventana, o bien, <a href="../login.php">Inicia Sesión</a></h5>
            </div>
          </div>
        `;
          $("#cont").append(cadGral);
        }
      }
    );
  }
}
