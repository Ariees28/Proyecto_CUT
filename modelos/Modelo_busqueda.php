<?php

require_once "../conexion/Conexion.php";

class ModeloBusqueda {

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  public function generos(){
    $sentencia = $this->db->query("SELECT * FROM genero ORDER BY genero");
    return $sentencia;
  }

  public function librosGenero($genero){
    $sentencia = $this->db->query("SELECT * FROM libros WHERE Genero = '$genero' order by Titulo;");
    return $sentencia;
  }

  public function librosBusqueda($busqueda){
    $sentencia = $this->db->query("SELECT * FROM libros WHERE Titulo LIKE '%$busqueda%' or Autor LIKE '%$busqueda%' order by Titulo;");
    return $sentencia;
  }

  public function infoCompleta($id){
    $sentencia = $this->db->query("SELECT * FROM libros WHERE id_libro = '$id';");
    return $sentencia;
  }

  public function descGen($genero){
    $sentencia = $this->db->query("SELECT descripcion FROM genero WHERE genero = '$genero';");
    return $sentencia;
  }

  public function comentario($idLib, $idUs, $comentario){
    $sql = $this->db->prepare("INSERT INTO comentarios(id_libro, id_usuario, comentario) VALUES(?,?,?)");

    try{
      $sql->execute([$idLib, $idUs, $comentario]);
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  public function ultComent($libro){
    $sql = $this->db->query("SELECT * FROM comentarios WHERE id_libro = '$libro' ORDER BY id_comentario DESC LIMIT 10;");
    return $sql;
  }

  public function usuario($id){
    $sql = $this->db->query("SELECT * FROM usuario WHERE id = '$id';");
    return $sql;
  }
}