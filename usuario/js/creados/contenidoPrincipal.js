function cargarcontenido(contenedor, contenido) {
  //recibe el id de donde se mostrara la info y la informacion a mostrar
  $("#" + contenedor).load(contenido);
}
