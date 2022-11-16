$(document).ready(function () {
  $("#formNuevoUs").on("submit", function (e) {
    e.preventDefault();
    nuevoUs();
  });
});

function nuevoUs() {
  let email = $("#email").val();
  let nombre = $("#nombre").val();
  let user = $("#usuario").val();
  let contra = $("#contra").val();
  let contraRep = $("#contraRep").val();

  if (contra != contraRep) {
    Swal.fire({
      title: "Error!",
      text: "Las contraseñas no coinciden!",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  } else {
    if (
      es(email) ||
      es(nombre) ||
      es(user) ||
      es(contra) ||
      email == "" ||
      nombre == "" ||
      user == "" ||
      contra == ""
    ) {
      Swal.fire({
        title: "Error!",
        text: "No puede haber espacios en ningún campo",
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
        { correo: email },
        function (res) {
          if (res == "true") {
            $.post(
              "../../proceso/Controlador_NuevoUsuario.php?op=NuevoLector",
              { email: email, nombre: nombre, user: user, contra: contra },
              function (res) {
                if (res == "0") {
                  Swal.fire({
                    title: "Error!",
                    text: "El usuario ya existe!",
                    icon: "warning",
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showCancelButton: 0,
                    confirmButtonText: "Entendido",
                  });
                } else if (res == "exito") {
                  Swal.fire({
                    title: "Usuario Creado Exitosamente!",
                    icon: "success",
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showCancelButton: 0,
                    confirmButtonText: "OK",
                  }).then(function (e) {
                    if (e.value) {
                      $(location).attr("href", "../login.php");
                    }
                  });
                } else {
                  Swal.fire({
                    title: "Error!",
                    text: "Ocurrió un error!",
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
          } else {
            Swal.fire({
              title: "Error!",
              text: "Correo ya registrado, ingrese uno nuevo!",
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
  }
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
