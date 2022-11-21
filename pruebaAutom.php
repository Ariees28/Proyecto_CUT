<?php
require_once "conexion/Conexion.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class ModeloAutom{
  private $db;

  public function __construct()
  {
    $this->db = Conexion::conectar();
  }

  function traerDatos(){
    $sql = $this->db->query("SELECT Login from usuario;");

    return $sql;
  }

  function emailNoVerif(){
    $sql = $this->db->query("SELECT Login from usuario WHERE verificado = '0';");
    return $sql;
  }

}


$modelo = new ModeloAutom();
$datos = $modelo->traerDatos();

while($r = $datos->fetchObject()){
  echo "$r->Login<br>";
}

function enviarCorreo($correo, $nombre){
  $mail = new PHPMailer(true);
  try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = "smtp.hostinger.com";
    $mail->SMTPAuth = true;
    $mail->Username = "verificaciondecuentas@andromedabiblioteca.com";
    $mail->Password = "VerificacionCuentas1!";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->setFrom("verificaciondecuentas@andromedabiblioteca.com", "Verificar Email");
    $mail->addAddress($correo);
    $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
      );

    $mail->isHTML(true);
    $mail->Subject = "Verificacion de Email";

    $message = "<html><body>";
    $message .= "<h1>HOLA! $nombre</h1>";
    $message .= "<h2>TU EMAIL NO ESTÁ VERIFICADO</h2>";
    $message .= "</body></html>";

    $mail->Body = $message;

    $mail->send();
    echo "exito";
  } catch (Exception $e) {
    echo "error", $mail->ErrorInfo;
  }
}

function buscarEmail(){
  $modelo = new ModeloAutom();
  $datos = $modelo->emailNoVerif();
  while($r = $datos->fetchObject()){
    enviarCorreo($r->Correo, $r->nombre);
  }
}