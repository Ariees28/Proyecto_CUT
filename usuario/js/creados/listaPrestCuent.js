$.post(
  "../../proceso/Controlador_prestamos.php?op=listPrestUsuario",
  {},
  function (res) {
    if (res == "nada") {
    } else {
      $("#lista").append(res);
    }
  }
);
