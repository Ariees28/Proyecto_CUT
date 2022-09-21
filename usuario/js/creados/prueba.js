$(document).ready(function () {
  alert("HOLA");
  let nombre = "Ariees";

  $.post(
    "../../proceso/prueba.php?prueba=1",
    { nombre: nombre },
    function (data) {
      alert(data);
    }
  );
});
