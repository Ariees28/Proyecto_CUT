<?php

require_once "../conexion/Conexion.php";

class ModeloCuenta {

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  public function actPss($contra, $id){
    $sql = $this->db->prepare("UPDATE usuario SET clave = '$contra' WHERE id = '$id';");

    try {
      $sql->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function actDatos($nombre, $correo, $id){
    $sql = $this->db->prepare("UPDATE usuario SET nombre = '$nombre', Correo = '$correo' WHERE id = '$id';");

    try {
      $sql->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function verificarEmail($correo){
    $sql = $this->db->query("SELECT id FROM usuario WHERE Correo = '$correo';");

    return $sql;
  }

}