<?php
public function infoCompleta($id){
    $sentencia = $this->db->query("SELECT * FROM libros WHERE id_libro = '$id';");
    return $sentencia;
  }