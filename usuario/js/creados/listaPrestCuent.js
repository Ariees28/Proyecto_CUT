$.post(
  "../../proceso/Controlador_prestamos.php?op=listPrestUsuario",
  {},
  function (res) {
    $("#lista").append(res);
  }
);
