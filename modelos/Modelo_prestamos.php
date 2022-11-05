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
}