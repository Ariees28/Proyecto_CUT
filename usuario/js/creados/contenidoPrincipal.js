function cargarcontenido(contenedor, contenido) {
  //recibe el id de donde se mostrara la info y la informacion a mostrar
  $("#" + contenedor).load(contenido);
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

function eliminarE() {
  var a = event.key;
  if ([".", "e", "+", "-"].includes(a)) {
    event.preventDefault();
  }
}
