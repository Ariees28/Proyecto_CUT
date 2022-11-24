<?php

require_once "../conexion/Conexion.php";

class ModeloPrestamos{
  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  //traer toda la información del libro para su despliegue
  public function infoCompleta($id){
    $sentencia = $this->db->query("SELECT * FROM libros WHERE id_libro = '$id';");
    return $sentencia;
  }

  //Para saber si el libro se puede prestar 3 días (tipo 0), o 30 (tipo 1)
  function tipoPrestamo($genero){
    $sql = $this->db->query("SELECT tipoPrestamos FROM genero WHERE genero = '$genero' LIMIT 1;");
    return $sql;
  }

  //Insertar los datos del prestamo
  function prestamo($idSol, $idLib, $fechaS, $fechaE, $numSeguim){
    $sql = $this->db->prepare("INSERT INTO prestamos (id_libro, id_solicitante, fecha_solicitud, fecha_entrega, numSeguim) VALUES (?,?,?,?,?)");

    try{
      $sql->execute([$idLib, $idSol, $fechaS, $fechaE, $numSeguim]);
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  //Aumentamos en 1 el numero de libros prestados de la tabla libros
  public function sumarPrestamo ($idLibro){
    $sql = $this->db->query("UPDATE libros SET prestados = prestados + 1 WHERE id_libro = '$idLibro';");
    return $sql;
  }

  //Buscamos cuantos prestamos activos tiene un usuario en concreto
  public function listadoPrestamosAct($id){
    $sql = $this->db->query("SELECT * FROM prestamos WHERE id_solicitante = '$id' AND entregado = 0;");
    return $sql;
  }

  /*
  Consultamos si el usuario ya había
  el prestamo de este libro con
  anterioridad.
  */
  public function conLibPres($idLib, $idUs){
    $sql = $this->db->query("SELECT * FROM prestamos WHERE id_libro = '$idLib' AND id_solicitante = '$idUs' AND entregado = 0;");
    return $sql;
  }

  //obtener el ultimo num de seguimiento para generar uno nuevo
  public function ultNumSeg(){
    $sql = $this->db->query("SELECT numSeguim FROM prestamos ORDER BY NumSeguim DESC LIMIT 1;");
    return $sql;
  }

  //Obtener todos los libros solicitados por el usuario
  public function listPrestUs($id){
    $sql = $this->db->query("SELECT * FROM prestamos WHERE id_solicitante = '$id' ORDER BY entregado ASC");

    return $sql;
  }

  //obtenemos lista de lectores para poder asignarles un prestamo
  public function usuarios(){
    $sql = $this->db->query("SELECT * FROM usuario");

    return $sql;
  }

  //obtenemos los libros disponibles para prestamos
  public function libros(){
    $sql = $this->db->query("SELECT * FROM libros");
    return $sql;
  }

  //obtenemos el tipo de prestamo del genero seleccionado
  public function tipoP($genero){
    $sql = $this->db->query("SELECT tipoPrestamos FROM genero WHERE genero = '$genero';");
    return $sql;
  }

  //Obtenemos la lista de prestamos no entregados de un usuario dado
  public function prestamosUsuario($id){
    $sql = $this->db->query("SELECT * FROM prestamos WHERE id_solicitante = '$id' AND entregado = '0';");
    return $sql;
  }

  // hacemos el retorno de un libro actualizando su status
  public function retornarLib($idLib, $idUs){
    $sql = $this->db->prepare("UPDATE prestamos SET entregado = '1' WHERE id_libro = '$idLib' AND id_solicitante = '$idUs';");
    try{
      $sql->execute();
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  //Actualizamos el numero de libros prestados
  public function restarPrest($idLib){
    $sql = $this->db->prepare("UPDATE libros SET prestados = prestados-1 WHERE id_libro = '$idLib';");
    try{
      $sql->execute();
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  //Obtenemos TODOS los prestamos (activos primero)
  public function listaPresTotal(){
    $sql = $this->db->query("SELECT * FROM prestamos ORDER BY entregado ASC");
    return $sql;
  }

  public function listaPresTotal2($id_lib){
    $sql = $this->db->query("SELECT * FROM prestamos WHERE id_libro = '$id_lib' ORDER BY entregado ASC");
    return $sql;
  }

  //Obtener info de un usuario dado
  public function infoUs($id){
    $sql = $this->db->query("SELECT * FROM usuario WHERE id = '$id';");
    return $sql;
  }

  public function infoUsBusq($info){
    $sql = $this->db->query("SELECT * FROM usuario WHERE nombre LIKE '%$info%' OR login LIKE '%$info%' OR correo LIKE '%$info%';");
    return $sql;
  }

  public function infoLibBusq($info){
    $sql = $this->db->query("SELECT * FROM libros WHERE Titulo LIKE '%$info%' OR ISBN LIKE '%$info%';");
    return $sql;
  }

  public function infoLib($ISBN){
    $sentencia = $this->db->query("SELECT * FROM libros WHERE ISBN = '$ISBN';");
    return $sentencia;
  }
}

