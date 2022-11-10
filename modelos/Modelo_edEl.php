<?php

require_once "../conexion/Conexion.php";

class ModeloEdicion{

  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }


  public function datos(){
    $sql = $this->db->query("SELECT * FROM libros");
    return $sql;
  }

  public function datosIsbn($isbn){
    $sql = $this->db->query("SELECT * FROM libros WHERE isbn = '$isbn';");
    return $sql;
  }

  public function editarLibro($titulo, $autor, $paginas, $genero, $isbn, $editorial, $fecha, $idioma, $ejemplares, $sipnosis, $id){
    $sql = $this->db->prepare("UPDATE libros SET Titulo = '$titulo', Autor = '$autor', Paginas = '$paginas', Genero = '$genero', ISBN = '$isbn', Editorial = '$editorial', Fecha = '$fecha', Idioma = '$idioma', Ejemplares = '$ejemplares', sipnosis = '$sipnosis' WHERE id_libro = '$id'");

    try{
      $sql->execute();
      return true;
    }catch(Exception $e){
      return $e;
    }
  }

  public function actPortada($portada, $id){
    $sql = $this->db->prepare("UPDATE libros SET Portada = '$portada' WHERE id_libro = '$id';");

    try {
      $sql->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}