<?php

require_once "../conexion/Conexion.php";

class Modelo
{
  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }
  public function getTablaAgente($nombre, $apellido, $id)
  {
    $sentencia = $this->db->query("SELECT * FROM agente WHERE (nombre = '$nombre' AND apellidos = '$apellido') OR id = '$id';");

    return $sentencia;
  }

  public function getTablaArma($mat)
  {
    $sentencia = $this->db->query("SELECT * FROM arma WHERE matricula = '$mat' AND status=1;");

    return $sentencia;
  }

  public function obtenerID($id){
    $sentencia = $this->db->query("SELECT oficios.id_agente FROM `arma` INNER JOIN oficios ON arma.matricula = oficios.matricula_arma WHERE arma.idArma = '$id';");

    return $sentencia;
  }

  public function obtenerArmas($id){
    $sentencia = $this->db->query("SELECT arma.tipo, arma.clase, arma.marca, arma.calibre, arma.modelo, arma.matricula, oficios.cadena_oficio FROM `arma` INNER JOIN oficios ON arma.matricula = oficios.matricula_arma WHERE oficios.id_agente = '$id';");

    return $sentencia;
  }
  public function listadoAgente(){
    $sentencia = $this->db->query("SELECT nombre, apellidos FROM agente WHERE status = 1;");

    return $sentencia;
  }
  public function listadoArmas(){
    $sentencia = $this->db->query("SELECT * FROM arma WHERE status = 2;");
    
    return $sentencia;
  }

  public function listadoArmas2(){
    $sentencia = $this->db->query("SELECT * FROM arma WHERE status != 0;");
    
    return $sentencia;
  }

  public function insertar($tabla, $dato){
    $col = implode(",", array_keys($dato));
    $val = implode("','", array_values($dato));

    $sentencia = $this->db->prepare("INSERT INTO $tabla ( $col ) VALUES ('$val');");
    try{
      $sentencia->execute();
    }catch(Exception $e){
      return $e;
    }
    
  }
  public function actDatosAgente($dato){

    $id = $dato[0][0];
    $nombre = $dato[0][1];
    $apellidos = $dato[0][2];
    $depe = $dato[0][3];
    $guardia = $dato[0][4];

    $sql = $this->db->prepare("UPDATE agente SET nombre = '$nombre', apellidos = '$apellidos', dependencia = '$depe', guardia = '$guardia' WHERE id = '$id';");
    try{
      $sql->execute();
    }catch(Exception $e){
      return $e;
    }
  }

  public function actDatosArma($dato, $m){

    $tipo = $dato[0][0];
    $clase = $dato[0][1];
    $marca = $dato[0][2];
    $calibre = $dato[0][3];
    $modelo = $dato[0][4];
    $matr = $dato[0][5];

    $sql = $this->db->prepare("UPDATE arma SET tipo = '$tipo', clase = '$clase', marca = '$marca', calibre = '$calibre', modelo = '$modelo', matricula = '$matr' WHERE matricula = '$m';");
    try{
      $sql->execute();
    }catch(Exception $e){
      return $e;
    }
  }

  public function actualizarArmas($arma, $guardia){
    $sql = $this->db->prepare("UPDATE arma SET status = 1 , guardia = '$guardia' WHERE matricula = '$arma'");
    try{
      $sql->execute();
    }catch(Exception $e){
      return $e;
    }
  }

  public function actualizarAgente($id){
    $sql = $this->db->prepare("UPDATE agente SET oficio = '1' WHERE id = '$id'");

    try{
      $sql->execute();
    }catch(Exception $e){
      return $e;
    }
  }

  public function revisarOficio($oficio){
    $sql = $this->db->query("SELECT * FROM oficios WHERE cadena_oficio = '$oficio'");
    return $sql;
  }

  public function eliminarAgente($idAgente){
    $sql = $this->db->prepare("UPDATE agente SET status = 0 WHERE id = '$idAgente'");

    try{
      $sql->execute();
    }catch(Exception $e){
      return $e;
    }
  }

  public function eliminarArm($mat){
    $sql = $this->db->prepare("UPDATE arma SET status = 0 WHERE matricula = '$mat'");

    try{
      $sql->execute();
    }catch(Exception $e){
      return $e;
    }
  }

  public function getGuardias($mat){
    $sql = $this->db->query("SELECT guardia FROM arma WHERE matricula = '$mat'");

    return $sql;
  }

  public function armasNoasignadas($guardia){
    $sql = $this->db->query("SELECT * from arma WHERE guardia != '3' AND (guardia = '0' OR guardia != '$guardia')");

    return $sql;
  }

  public function agenSinOf(){
    $sql = $this->db->query("SELECT * FROM AGENTE WHERE oficio = '0'");
    return $sql;
  }
}