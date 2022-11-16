<?php

session_start();
require_once "../modelos/Modelo_Cuenta.php";
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try{
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = "smtp.andromedabiblioteca.com";
    $mail->SMTPAuth = true;
    $mail->Username = "password-recovery@andromedabiblioteca.com";
    $mail->Password = "PasswordRec1!";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
}catch(Exception $e){
  echo "Hubo un error: ", $mail->ErrorInfo;
}

$modelo = new ModeloCuenta();


switch ($_GET["op"]) {
  case 'actPss':
    $id = $_SESSION["id"];
    $contra = $_POST["contra"];
    $contEnc = encriptar($contra);
    $res = $modelo->actPss($contEnc, $id);

    if($res == true){
      echo "true";
    }else{
      echo "false";
    }

    break;

  case "grdDatos":

    $id = $_SESSION["id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];

    $res = $modelo->actDatos($nombre, $correo, $id);

    if($res == true){
      $_SESSION["nombre"] = $nombre;
      $_SESSION["Correo"] = $correo;
      echo "true";
    }else{
      echo "false";
    }
    break;

  case "verificarEmail":

    $email = $_POST["correo"];
    $datos = $modelo->verificarEmail($email);
    $id = "";

    while($res = $datos->fetchObject()){
      $id = $res->id;
    }
    if($id != ""){
      echo "error";
    }else{
      echo "true";
    }

    break;

  case "verificar":
    $nombre = $_SESSION["nombre"];
    $correo = $_SESSION["correo"];
    $id = $_SESSION["id"];
    $token = "";

    $datos = $modelo->traerTokenUs($id);
      while($res = $datos->fetchObject()){
      $token = $res->TokenUsuario;
    }
    $url = generarUrl($id, $token);

    try {
    $mail->setFrom("password-recovery@andromedabiblioteca.com", "Recuperacion de cuenta");
    $mail->addAddress($correo, $nombre);
  
    $mail->isHTML(true);
    $mail->Subject = "Verificación de Email";
  
    $message = "<html><body>";
    $message .= "<h1>HOLA! $nombre</h1>";
    $message .= "<h2>Para verificar tu correo, da click <a hrf='$url'>AQUI</a></h2>";
    $message .= "<h3>o ingresa al siguiente enlace: $url</h3>";
    $message .= "</body></html>";
  
    $mail->Body = $message;
  
    $mail->send();
    echo "exito";
    } catch (Exception $e) {
      echo "error";
    }
    break;

  case "prueba":
    echo generarUrl("68", "7d9d7b05eff0b5b2679c3f985b21487c");
    break;
}

function encriptar($clave)
{
    $options = ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3];
    $X = password_hash($clave, PASSWORD_ARGON2I, $options);
    return $X;
}

function generarToken(){
  $gen = md5(uniqid(mt_rand(), false));
  return $gen;
}

function generarUrl($id, $token){
  $url = "andromedabiblioteca.com/usuario/plantillas/verCor.php?op=$id&tk=$token";
  return $url;
}