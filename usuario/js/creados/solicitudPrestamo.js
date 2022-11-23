var tipoPrestamo;
var idLibro;

m = moment();
var minDate = m.date() + "-" + (m.month() + 1) + "-" + m.year();
m.add(7, "day");
var maxDate = m.date() + "-" + (m.month() + 1) + "-" + m.year();

$.post(
  "../../proceso/Controlador_prestamos.php?op=numPrestamos",
  { id: idInfo },
  function (res) {
    let x = JSON.parse(res);
    if (x["0"]["0"] == "false") {
      $("#info").append(x["0"]["1"]);
    } else {
      $.post(
        "../../proceso/Controlador_prestamos.php?op=infLib",
        { id: idInfo },
        function (res) {
          let respuesta = JSON.parse(res);
          $("#info").append(respuesta["0"]["0"]);

          $("#fechaR").flatpickr({
            enableTime: false,
            dateFormat: "d-m-Y",
            minDate: minDate,
            maxDate: maxDate,
            disable: [
              function (date) {
                return date.getDay() === 0 || date.getDay() === 6; // disable weekends
              },
            ],
            locale: {
              firstDayOfWeek: 1, // set start day of week to Monday
              weekdays: {
                shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                longhand: [
                  "Domingo",
                  "Lunes",
                  "Martes",
                  "Miércoles",
                  "Jueves",
                  "Viernes",
                  "Sábado",
                ],
              },
              months: {
                shorthand: [
                  "Ene",
                  "Feb",
                  "Mar",
                  "Abr",
                  "May",
                  "Jun",
                  "Jul",
                  "Ago",
                  "Sep",
                  "Oct",
                  "Nov",
                  "Dic",
                ],
                longhand: [
                  "Enero",
                  "Febrero",
                  "Marzo",
                  "Abril",
                  "Mayo",
                  "Junio",
                  "Julio",
                  "Agosto",
                  "Septiembre",
                  "Octubre",
                  "Noviembre",
                  "Diciembre",
                ],
              },
            },
          });

          tipoPrestamo = respuesta["0"]["1"];
          idLibro = respuesta["0"]["2"];
          $("#fechaR").on("change", function () {
            let diaSel = moment();
            let d = $("#fechaR").val();
            let f = d.split("-");
            let diaSel2 = new Date(`${f[1]}-${f[0]}-${f[2]}`);
            let dia = diaSel2.getDate();
            let mes = diaSel2.getMonth();
            let year = diaSel2.getFullYear();
            diaSel.date(dia);
            diaSel.month(mes);
            diaSel.year(year);
            if (respuesta["0"]["1"] == "1") {
              let diaEnt = moment();
              diaEnt = diaSel.add(30, "days");
              if (diaEnt.day() == 6) {
                diaEnt = diaSel.add(2, "days");
              } else if (diaEnt.day() == 0) {
                diaEnt = diaSel.add(1, "days");
              }
              $("#fechaE").html(
                `${diaEnt.date()}-${diaEnt.month() + 1}-${diaEnt.year()}`
              );
            } else {
              let diaEnt = moment();
              diaEnt = diaSel.add(3, "days");
              if (diaEnt.day() == 6) {
                diaEnt = diaSel.add(2, "days");
              } else if (diaEnt.day() == 0) {
                diaEnt = diaSel.add(1, "days");
              }
              $("#fechaE").html(
                `${diaEnt.date()}-${diaEnt.month() + 1}-${diaEnt.year()}`
              );
            }
          });
        }
      );
    }
  }
);

function solicitar() {
  if ($("#fechaR").val() == "") {
    Swal.fire({
      title: "Error!",
      text: "Introduce una fecha",
      icon: "warning",
      showConfirmButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: 0,
      confirmButtonText: "Entendido",
    });
  } else {
    let diaSel = moment();
    let fechaS = $("#fechaR").val();
    let f = fechaS.split("-");
    let diaSel2 = new Date(`${f[1]}-${f[0]}-${f[2]}`);
    let dia = diaSel2.getDate();
    let mes = diaSel2.getMonth();
    let year = diaSel2.getFullYear();
    diaSel.date(dia);
    diaSel.month(mes);
    diaSel.year(year);
    let fechaE;
    if (tipoPrestamo == "1") {
      let diaEnt = moment();
      diaEnt = diaSel.add(30, "days");
      if (diaEnt.day() == 6) {
        diaEnt = diaSel.add(2, "days");
      } else if (diaEnt.day() == 0) {
        diaEnt = diaSel.add(1, "days");
      }
      fechaE = `${diaEnt.year()}-${diaEnt.month() + 1}-${diaEnt.date()}`;
      fechaS = year + "-" + (mes + 1) + "-" + dia;
    } else {
      let diaEnt = moment();
      diaEnt = diaSel.add(3, "days");
      if (diaEnt.day() == 6) {
        diaEnt = diaSel.add(2, "days");
      } else if (diaEnt.day() == 0) {
        diaEnt = diaSel.add(1, "days");
      }
      fechaE = `${diaEnt.year()}-${diaEnt.month() + 1}-${diaEnt.date()}`;
      fechaS = year + "-" + (mes + 1) + "-" + dia;
    }

    $.post(
      "../../proceso/Controlador_prestamos.php?op=solicitar",
      {
        fechaS: fechaS,
        fechaE: fechaE,
        idLibro: idLibro,
      },
      function (res) {
        let imp = JSON.parse(res);
        Swal.fire({
          title: "!!",
          html:
            "<h2>" +
            imp["0"]["0"] +
            "</h2>" +
            "Numero de seguimiento:<br>" +
            "<strong>" +
            imp["0"]["1"] +
            "</strong>",
          icon: "info",
          showConfirmButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          showCancelButton: 0,
          confirmButtonText: "Entendido",
        }).then(function () {
          cargarcontenido("ContenedorPrincipal", "busquedaGenero.php");
        });
      }
    );
  }
}
