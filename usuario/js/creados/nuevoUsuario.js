$(document).ready(function () {
  $("#formUs").submit(function (e) {
    e.preventDefault();
    nuevoUs();
  });
});

function nuevoUs() {
  let email = $("#email").val();
  let nombre = $("#nombre").val();
  let user = $("#usuario").val();
  let contra = $("#contra").val();
  let contraR = $("#contraR").val();
  let tipo = $("#tipo").val();

  if (contra != contraR) {
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
        "../../proceso/Controlador_NuevoUsuario.php?op=NuevoUser",
        {
          email: email,
          nombre: nombre,
          user: user,
          contra: contra,
          tipo: tipo,
        },
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
                cargarcontenido("ContenedorPrincipal", "nuevoUsuario.php");
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
    }
  }
}

function es(s) {
  return /\s/g.test(s);
}
