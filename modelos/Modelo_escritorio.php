<?php

require_once "../conexion/Conexion.php";

class ModeloEscritorio {

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  function frases($id){
    $sql = $this->db->query("SELECT * FROM frases WHERE id = '$id'");
    return $sql;
  }
}