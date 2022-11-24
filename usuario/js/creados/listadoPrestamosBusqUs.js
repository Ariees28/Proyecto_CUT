$.post(
  "../../proceso/Controlador_prestamos.php?op=prestUsuaBusq",
  { id: idUs },
  function (res) {
    let datos = JSON.parse(res);
    $("#nombre").html(datos["0"]["nombre"]);
    $("#login").html(datos["0"]["usuario"]);
    $("#correo").html(datos["0"]["correo"]);
    if (datos["0"]["verif"] == "VERIFICADO") {
      $("#verif").html(datos["0"]["verif"]);
      $("#verif").addClass("text-success");
    } else {
      $("#verif").html(datos["0"]["verif"]);
      $("#verif").addClass("text-danger");
    }
  }
);
