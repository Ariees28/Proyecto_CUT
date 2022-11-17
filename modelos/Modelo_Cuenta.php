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
    $sql = $this->db->query("SELECT id FROM usuario WHERE Correo = '$correo' LIMIT 1;");

    return $sql;
  }

  public function traerTokenUs($id){
    $sql = $this->db->query("SELECT TokenUsuario FROM usuario WHERE id = '$id';");

    return $sql;
  }

  public function solNvContra($id, $token){
    $sql = $this->db->prepare("UPDATE usuario SET recPass = 1 , TokenPass = '$token' WHERE id = '$id';");
    try{
      $sql->execute();
      return true;
    }catch(Exception $e){
      return false;
    }
    return $sql;
  }

  public function revCambCont($id, $token){
    $sql = $this->db->query("SELECT * FROM usuario WHERE id = '$id' AND TokenPass = '$token' AND recPass = 1 LIMIT 1");
    return $sql;
  }

  public function cambCont($id, $token, $contra){
    $sql = $this->db->prepare("UPDATE usuario SET clave = '$contra', recPass = 0, TokenPass = '' WHERE id = '$id' AND TokenPass = '$token';");

    try {
      $sql->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}
