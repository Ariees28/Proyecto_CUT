$(document).ready(function () {
  $("#formDatos").submit(function (e) {
    e.preventDefault();
    guardar();
  });
  $("#actPss").click(function () {
    actPss();
  });
});

function guardar() {
  let nombre = $("#nomUs").val();
  let correo = $("#emUs").val();

  if (es(nombre)) {
    Swal.fire({
      title: "Error!",
      text: "No puede haber espacios en el nombre",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  } else {
    $.post(
      "../../proceso/Controlador_cuenta.php?op=verificarEmail",
      { correo: correo },
      function (res) {
        if (res == "error") {
          Swal.fire({
            title: "Error!",
            text: "Email ya registrado, ingrese otro correo",
            icon: "warning",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          });
        } else {
          $.post(
            "../../proceso/Controlador_cuenta.php?op=grdDatos",
            { nombre: nombre, correo: correo },
            function (res) {
              if (res == "true") {
                Swal.fire({
                  title: "Completado!",
                  text: "Se han actualizado tus datos",
                  icon: "success",
                  showConfirmButton: true,
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  showCancelButton: 0,
                  confirmButtonText: "Entendido",
                });
                cargarcontenido("ContenedorPrincipal", "cuenta.php");
              } else {
                Swal.fire({
                  title: "Error!",
                  text: "Ocurrió un error actualizando los datos",
                  icon: "warning",
                  showConfirmButton: true,
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  showCancelButton: 0,
                  confirmButtonText: "Entendido",
                });
                cargarcontenido("ContenedorPrincipal", "cuenta.php");
              }
            }
          );
        }
      }
    );
  }
}

function actPss() {
  $("#password").html("");
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
    <div class="col-md-6 mt-3">
      <button id="gdrNva" class="mb-2 mr-2 btn btn-danger" onclick="cancelar()">CANCELAR</button>
    </div>
  `;
  $("#password").append(cadGral);
}

function guardarContra() {
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
      "../../proceso/Controlador_cuenta.php?op=actPss",
      { contra: c1 },
      function (res) {
        if (res == "true") {
          Swal.fire({
            title: "Completado!",
            text: "Contraseña actualizada Correctamente",
            icon: "success",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          });
          cargarcontenido("ContenedorPrincipal", "cuenta.php");
        } else {
          Swal.fire({
            title: "Error!",
            text: "Ocurrió un error actualizando la contraseña",
            icon: "warning",
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: 0,
            confirmButtonText: "Entendido",
          });
          cargarcontenido("ContenedorPrincipal", "cuenta.php");
        }
      }
    );
  }
}

function cancelar() {
  cargarcontenido("ContenedorPrincipal", "cuenta.php");
}

function es(s) {
  return /\s/g.test(s);
}

function eliminarAcentos(texto) {
  texto = texto.toUpperCase();
  return texto
    .normalize("NFD")
    .replace(
      /([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,
      "$1"
    );
}
