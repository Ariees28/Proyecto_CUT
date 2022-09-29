<?php

require_once "../conexion/Conexion.php";

class ModeloFormulario{

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  public function guardarLibros($titulo, $autor, $paginas, $genero){
    $sentencia = $this->db->prepare("INSERT INTO libros (Titulo, Autor, Paginas, Genero) VALUES (?,?,?,?)");

    try{
      $sentencia->execute([$titulo, $autor, $paginas, $genero]);
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  public function mostrarLibros(){
    $setencia = $this->db->query("SELECT * FROM libros");
    return $setencia;
  }
}
