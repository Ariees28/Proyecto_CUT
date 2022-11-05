<?php

require_once "../conexion/Conexion.php";

class ModeloFormulario{

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  public function guardarLibros($titulo, $autor, $paginas, $genero, $isbn, $editorial, $fecha, $idioma, $ejemplares, $portada, $sipnosis){
    $sentencia = $this->db->prepare("INSERT INTO libros (Titulo, Autor, Paginas, Genero, ISBN, EDITORIAL, FECHA, IDIOMA, EJEMPLARES, PORTADA, SIPNOSIS) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    try{
      $sentencia->execute([$titulo, $autor, $paginas, $genero, $isbn, $editorial, $fecha, $idioma, $ejemplares, $portada, $sipnosis]);
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  public function mostrarLibros(){
    $setencia = $this->db->query("SELECT * FROM libros");
    return $setencia;
  }

  public function generos(){
    $sentencia = $this->db->query("SELECT genero FROM genero");
    return $sentencia;
  }
}
