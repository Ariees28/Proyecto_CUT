<?php

require_once "../conexion/Conexion.php";

class ModeloVerCor {

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }
  
  public function validarToken($id, $token)
  {
    $sql = $this->db->query("SELECT verificado FROM usuario WHERE id = '$id' and TokenUsuario = '$token' LIMIT 1;");
    return $sql;
  }

  public function valCorreo($id){
    $sql = $this->db->prepare("UPDATE usuario SET verificado = 1 WHERE id = '$id'");
    $res = $sql->execute();
    return $res;
  }

}