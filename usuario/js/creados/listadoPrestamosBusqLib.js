$.post(
  "../../proceso/Controlador_prestamos.php?op=infLibBusq",
  { id: idLib },
  function (res) {
    datos = JSON.parse(res);
    $("#titulo").html(datos["0"]["0"]);
    $("#autor").html(datos["0"]["1"]);
    $("#paginas").html(datos["0"]["2"]);
    $("#genero").html(datos["0"]["3"]);
    $("#isbn").html(datos["0"]["4"]);
    $("#editorial").html(datos["0"]["5"]);

    $("#portada").attr("src", "../../files/portadas/" + datos["0"]["6"]);
  }
);

$("#tabUs").DataTable({
  bFilter: true,
  bInfo: false,
  bPaginate: true,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
  },
  select: {
    style: "single",
    info: false,
  },

  ajax: {
    url: "../../proceso/Controlador_prestamos.php?op=listadoPresTot2",
    data: { idLib: idLib },
    type: "POST",
    dataType: "json",
    error: function (e) {
      alert("ocurrió un error, contacte al administrador");
    },
  },

  initComplete: function () {
    // Apply the search
    this.api()
      .columns()
      .every(function () {
        var that = this;

        $("input", this.footer()).on("keyup change clear", function () {
          if (that.search() !== this.value) {
            that.search(this.value).draw();
          }
        });
      });
  },
});
