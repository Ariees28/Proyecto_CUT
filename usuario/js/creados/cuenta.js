$(document).ready(function () {
  $("#actPss").click(function () {
    actPss();
  });
});

function actPss() {
  let cadGral = `
    <div class="col-md-6">
      <label>INGRESE LA NUEVA CONTRASEÑA</label>
      <input type="password" class="form-control" id="pass1">
    </div>
    <div class="col-md-6">
      <label>REPITA LA CONTRASEÑA</label>
      <input type="password" class="form-control" id="pass2">
    </div>
    <div class="col-md-6 mt-3">
      <button id="gdrNva" class="mb-2 mr-2 btn btn-success" onclick="guardarContra()">GUARDAR CONTRASEÑA NUEVA</button>
    </div>
  `;
  $("#password").append(cadGral);
}

function guardarContra() {
  let c1 = $("#pass1");
  let c2 = $("#pass2");

  if (c1 == c2) {
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
    var sessionValue = '<%=Session["id"]%>';
    alert(sessionValue);
  }
}
