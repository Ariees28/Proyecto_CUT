<?php

require_once "../conexion/Conexion.php";

class ModeloPrestamos{
  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  public function infoCompleta($id){
    $sentencia = $this->db->query("SELECT * FROM libros WHERE id_libro = '$id';");
    return $sentencia;
  }

  function tipoPrestamo($genero){
    $sql = $this->db->query("SELECT tipoPrestamos FROM genero WHERE genero = '$genero' LIMIT 1;");
    return $sql;
  }

  function prestamo($idSol, $idLib, $fechaS, $fechaE){
    $sql = $this->db->prepare("INSERT INTO prestamos (id_libro, id_solicitante, fecha_solicitud, fecha_entrega) VALUES (?,?,?,?)");

    try{
      $sql->execute([$idLib, $idSol, $fechaS, $fechaE]);
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  public function sumarPrestamo ($idLibro){
    $sql = $this->db->query("UPDATE libros SET prestados = prestados + 1 WHERE id_libro = '$idLibro';");
    return $sql;
  }

  public function listadoPrestamosAct($id){
    $sql = $this->db->query("SELECT * FROM prestamos WHERE id_solicitante = '$id' AND entregado = 0;");
    return $sql;
  }
}