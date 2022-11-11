<?php

require_once "../conexion/Conexion.php";

class ModeloNuevoUsuario{

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  public function usuarios(){
    $sql = $this->db->query("SELECT * FROM usuario;");

    return $sql;
  }

  public function revisarUs($login){
    $sql = $this->db->query("SELECT Login FROM usuario WHERE Login = '$login';");
    return $sql;
  }

  public function nuevo($login, $clave, $nombre, $correo, $privilegio){
    $sql = $this->db->prepare("INSERT INTO usuario (Login, clave, nombre, Correo, Privilegio) VALUES (?,?,?,?,?);");

    try {
      $sql->execute([$login, $clave, $nombre, $correo, $privilegio]);
      return true;
    } catch (Exception $e) {
      return $e;
    }
  }

  public function datUsEdit($id){
    $sql = $this->db->query("SELECT * FROM usuario WHERE id = '$id';");
    return $sql;
  }

  public function editar($nombre, $correo, $privilegio, $id){
    $sql = $this->db->prepare("UPDATE usuario SET nombre = '$nombre', Correo = '$correo', Privilegio = '$privilegio' WHERE id = '$id';");

    try{
      $sql->execute();
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  public function editarContra($id, $contra){
    $sql = $this->db->prepare("UPDATE usuario SET clave = '$contra' WHERE id = '$id';");

    try {
      $sql->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}