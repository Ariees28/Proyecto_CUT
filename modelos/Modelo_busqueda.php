<?php

require_once "../conexion/Conexion.php";

class ModeloBusqueda {

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  public function generos(){
    $sentencia = $this->db->query("SELECT genero FROM genero");
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
}