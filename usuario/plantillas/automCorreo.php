<?php

require_once "../../conexion/Conexion.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';



class ModeloAutom{
  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  function traerDatos($id){
    $sql = $this->db->query("SELECT * from usuario WHERE id = '$id' LIMIT 1;");
    return $sql;
  }

  function tituloLibro($id){
    $sql = $this->db->query("SELECT Titulo from libros WHERE id_libro = '$id' LIMIT 1;");
    return $sql;
  }
  
  function prestamoAtrasado(){
    $hoy = date('Y-m-d');
    $sql = $this->db->query("SELECT * FROM `prestamos` WHERE fecha_entrega < '$hoy' AND entregado = 0;");

    return $sql;
  }

  function venceHoy(){
    $hoy = date('Y-m-d');
    $sql = $this->db->query("SELECT * FROM `prestamos` WHERE fecha_entrega = '$hoy' AND entregado = 0;");

    return $sql;
  }

}

function enviarCorreo($correo, $mensaje, $titulo, $desde, $contraDesde, $setFrom, $filename){
  $mail = new PHPMailer(true);
  try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = "smtp.hostinger.com";
    $mail->SMTPAuth = true;
    $mail->Username = $desde;
    $mail->Password = $contraDesde;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->setFrom($desde, $setFrom);
    $mail->addAddress($correo);
    $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
      );

    $mail->isHTML(true);
    $mail->Subject = $titulo;
    
    $mail->Body = $mensaje;
    $mail->addEmbeddedImage($filename, "my-attach");
    $mail->send();
  } catch (Exception $e) {
    echo "error", $mail->ErrorInfo;
  }
}

function enviarEmailAtrasado(){

  $modelo = new ModeloAutom();
  $desde = "entregas@andromedabiblioteca.com";
  $contraDesde = "Entregas1!";
  $setFrom = "ENTREGA DE LIBROS";
  $tituloCorreo = "ENTREGA ATRASADA";
  $correo = array();
  $nombre = array();
  $tituloLib = array();
  $idUs = array();
  $idTit = array();

  $datos = $modelo->prestamoAtrasado();
  while($r = $datos->fetchObject()){
    $idUs[] = $r->id_solicitante;
    $idTit[] = $r->id_libro;
  }

  for ($i=0; $i < count($idUs); $i++) { 
    $datos = $modelo->traerDatos($idUs[$i]);
    while($r = $datos->fetchObject()){
      $nombre[] = $r->nombre;
      $correo[] = $r->Correo;
    }
  }
  
  for ($i=0; $i < count($idTit); $i++) { 
    $datos = $modelo->tituloLibro($idTit[$i]);
    while($r = $datos->fetchObject()){
      $tituloLib[] = $r->Titulo;
    }
  }

  for($i=0; $i<count($idUs); $i++){
    $nom = $nombre[$i];
    $lib = $tituloLib[$i];
    $destinatario = $correo[$i];
    $mensaje = "";
    $mensaje .= "<html><body>";
    $mensaje .= "<h1>HOLA! $nom</h1>";
    $mensaje .= "<h2>TIENES UNA ENTREGA ATRASADA!</h2>";
    $mensaje .= "<h3>Solicitaste el prestamo de $lib, y aun no lo has devuelto</h3>";
    $mensaje .= "<h2>Acude inmediatamente a la biblioteca a hacer el retorno del libro</h2>";
    $mensaje .= "<img width='500' height='600' alt='RegresarLibro' src='cid:my-attach'>";
    $mensaje .= "</body></html>";

    enviarCorreo($destinatario, $mensaje, $tituloCorreo, $desde, $contraDesde, $setFrom, "../../files/bob_mafioso_regresa tu_libro.jpeg");
    echo "Correo enviado a ", $destinatario, "<br>";
  }

}
enviarEmailAtrasado();

function enviarEmailVenceHoy(){
  $modelo = new ModeloAutom();
  $desde = "entregas@andromedabiblioteca.com";
  $contraDesde = "Entregas1!";
  $setFrom = "ENTREGA DE LIBROS";
  $tituloCorreo = "TU ENTREGA VENCE HOY";
  $correo = array();
  $nombre = array();
  $tituloLib = array();
  $idUs = array();
  $idTit = array();

  $datos = $modelo->venceHoy();
  while($r = $datos->fetchObject()){
    $idUs[] = $r->id_solicitante;
    $idTit[] = $r->id_libro;
  }

  for ($i=0; $i < count($idUs); $i++) { 
    $datos = $modelo->traerDatos($idUs[$i]);
    while($r = $datos->fetchObject()){
      $nombre[] = $r->nombre;
      $correo[] = $r->Correo;
    }
  }
  
  for ($i=0; $i < count($idTit); $i++) { 
    $datos = $modelo->tituloLibro($idTit[$i]);
    while($r = $datos->fetchObject()){
      $tituloLib[] = $r->Titulo;
    }
  }

  for($i=0; $i<count($idUs); $i++){
    $nom = $nombre[$i];
    $lib = $tituloLib[$i];
    $destinatario = $correo[$i];
    $mensaje = "";
    $mensaje .= "<html><body>";
    $mensaje .= "<h1>HOLA! $nom</h1>";
    $mensaje .= "<h2>LA ENTREGA DE TU LIBRO VENCE HOY!</h2>";
    $mensaje .= "<h3>Solicitaste el prestamo de $lib, y aun no lo has devuelto</h3>";
    $mensaje .= "<h2>Acude a la biblioteca para hacer el retorno del libro</h2>";
    $mensaje .= "<img width='500' height='600' alt='RegresarLibro' src='cid:my-attach'>";
    $mensaje .= "</body></html>";

    enviarCorreo($destinatario, $mensaje, $tituloCorreo, $desde, $contraDesde, $setFrom, "../../files/bob_mafioso_regresa tu_libro.jpeg");
    echo "Correo enviado a ", $destinatario, "<br>";
  }
}

enviarEmailVenceHoy();